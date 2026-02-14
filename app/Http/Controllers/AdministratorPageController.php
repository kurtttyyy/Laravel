<?php

namespace App\Http\Controllers;

use App\Models\AttendanceUpload;
use App\Models\AttendanceRecord;
use App\Models\Applicant;
use App\Models\Employee;
use App\Models\GuestLog;
use App\Models\Interviewer;
use App\Models\OpenPosition;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class AdministratorPageController extends Controller
{

    public function display_home(){
        $employee = User::where('role', 'Employee')
                        ->where('status', 'Pending')
                        ->latest()
                        ->get();
        $accept = User::with([
            'employee',
            'applicant',
            'applicant.position:id,department',
        ])->where('role', 'Employee')
                        ->where('status','Approved')
                        ->latest()
                        ->get();
        
        // Get department overview
        $departments = User::with('employee')
                        ->where('role', 'Employee')
                        ->where('status', 'Approved')
                        ->get()
                        ->groupBy(function($user) {
                            return $user->employee->department ?? 'Unassigned';
                        })
                        ->map(function($group) {
                            return [
                                'name' => $group->first()->employee->department ?? 'Unassigned',
                                'count' => $group->count()
                            ];
                        })
                        ->values();
        
        return view('admin.adminHome', compact('employee','accept','departments'));
    }

    public function display_employee(){
        $employee = User::with([
            'applicant',
            'applicant.documents' => function ($query) {
                $query->select([
                    'id',
                    'applicant_id',
                    'filename',
                    'filepath',
                    'type',
                    'mime_type',
                    'size',
                    'created_at',
                ])->orderByDesc('created_at');
            },
            'applicant.position:id,title,department,employment,collage_name,work_mode,job_description,responsibilities,requirements,experience_level,location,skills,benifits,job_type,one,two,passionate',
            'employee',
            'education',
            'government',
            'salary',
            'license',
            ])->where('role','Employee')->get();

        Log::info($employee);
        return view('admin.adminEmployee', compact('employee'));
    }

    public function display_attendance(Request $request){
        return $this->buildAttendanceView($request, 'all');
    }

    public function display_attendance_present(Request $request){
        return $this->buildAttendanceView($request, 'present');
    }

    public function display_attendance_absent(Request $request){
        return $this->buildAttendanceView($request, 'absent');
    }

    public function display_attendance_tardiness(Request $request){
        return $this->buildAttendanceView($request, 'tardiness');
    }

    public function display_attendance_total_employee(Request $request){
        return $this->buildAttendanceView($request, 'total_employee');
    }

    private function buildAttendanceView(Request $request, string $activeAttendanceTab = 'all'){// activeAttendanceTab can be 'all', 'present', 'absent', 'tardiness', 'total_employee'
        $fromDate = $request->query('from_date');
        $toDate = $request->query('to_date');
        $selectedUploadId = $request->query('upload_id');
        $normalizedFromDate = $this->normalizeFilterDate($fromDate);
        $normalizedToDate = $this->normalizeFilterDate($toDate);
        $selectedJobType = $this->normalizeJobType($request->query('job_type'));
        $allowedJobTypes = ['Teaching', 'Non-Teaching'];
        if ($selectedJobType && !in_array($selectedJobType, $allowedJobTypes, true)) {
            $selectedJobType = null;
        }

        $hasDateFilter = (bool) ($normalizedFromDate || $normalizedToDate);
        $exactDateFilter = null;
        $rangeStartDate = null;
        $rangeEndDate = null;

        if ($normalizedFromDate && $normalizedToDate) {
            if ($normalizedFromDate === $normalizedToDate) {
                $exactDateFilter = $normalizedFromDate;
            } elseif ($normalizedFromDate < $normalizedToDate) {
                $rangeStartDate = $normalizedFromDate;
                $rangeEndDate = $normalizedToDate;
            } else {
                $rangeStartDate = $normalizedToDate;
                $rangeEndDate = $normalizedFromDate;
            }
        } elseif ($normalizedFromDate) {
            $exactDateFilter = $normalizedFromDate;
        } elseif ($normalizedToDate) {
            $exactDateFilter = $normalizedToDate;
        }

        $attendanceFiles = AttendanceUpload::query()
            ->when($hasDateFilter, function ($query) use ($exactDateFilter, $rangeStartDate, $rangeEndDate) {
                $query->whereHas('records', function ($recordsQuery) use ($exactDateFilter, $rangeStartDate, $rangeEndDate) {
                    if ($exactDateFilter) {
                        $recordsQuery->whereDate('attendance_date', $exactDateFilter);
                    } elseif ($rangeStartDate && $rangeEndDate) {
                        $recordsQuery->whereDate('attendance_date', '>=', $rangeStartDate)
                            ->whereDate('attendance_date', '<=', $rangeEndDate);
                    }
                });
            })
            ->orderByDesc('uploaded_at')
            ->orderByDesc('id')
            ->get();

        if (!$selectedUploadId && !$hasDateFilter) {
            $selectedUploadId = optional(
                $attendanceFiles->firstWhere('status', 'Processed') ?? $attendanceFiles->first()
            )->id;
        }

        $records = collect();
        if ($hasDateFilter) {
            $recordsQuery = AttendanceRecord::query();
            if ($exactDateFilter) {
                $recordsQuery->whereDate('attendance_date', $exactDateFilter);
            } elseif ($rangeStartDate && $rangeEndDate) {
                $recordsQuery->whereDate('attendance_date', '>=', $rangeStartDate)
                    ->whereDate('attendance_date', '<=', $rangeEndDate);
            }

            $records = $recordsQuery
                ->orderByDesc('attendance_date')
                ->orderBy('employee_id')
                ->get();
        } elseif ($selectedUploadId) {
            $records = AttendanceRecord::query()
                ->where('attendance_upload_id', $selectedUploadId)
                ->orderBy('employee_id')
                ->get();
        }

        $employeesWithJobType = Employee::query()
            ->select(['employee_id', 'job_type'])
            ->whereNotNull('employee_id')
            ->orderBy('employee_id')
            ->get();

        $employeeJobTypeMap = $employeesWithJobType
            ->mapWithKeys(function ($employee) {
                $employeeId = $this->normalizeEmployeeId($employee->employee_id);
                if ($employeeId === '') {
                    return [];
                }

                $jobTypeFromEmployee = $this->normalizeJobType($employee->job_type);

                return [$employeeId => $jobTypeFromEmployee];
            });
        $employeeDepartmentMap = Employee::query()
            ->select(['employee_id', 'department'])
            ->whereNotNull('employee_id')
            ->orderBy('employee_id')
            ->get()
            ->mapWithKeys(function ($employee) {
                $employeeId = $this->normalizeEmployeeId($employee->employee_id);
                if ($employeeId === '') {
                    return [];
                }

                return [$employeeId => $employee->department ? (string) $employee->department : null];
            });

        $jobTypeOptions = collect($allowedJobTypes);

        $isSundayNoClassDate = $exactDateFilter ? $this->isSundayDate($exactDateFilter) : false;
        $isHolidayDate = $exactDateFilter ? $this->isHolidayDate($exactDateFilter) : false;
        $shouldAutoPresentHolidayDate = $isHolidayDate && !$isSundayNoClassDate;

        // No-class Sundays are excluded from attendance counting.
        if ($isSundayNoClassDate) {
            $records = collect();
        } elseif ($shouldAutoPresentHolidayDate) {
            if ($exactDateFilter) {
                $this->persistHolidayAttendanceForDate($exactDateFilter, $employeeJobTypeMap);
                $records = $this->getAttendanceRecordsByDate($exactDateFilter);
            } else {
                $records = $this->buildHolidayPresentEmployees($fromDate, $selectedJobType, $employeeJobTypeMap);
            }
        }

        if ($selectedJobType) {
            $records = $records
                ->filter(function ($row) use ($employeeJobTypeMap, $selectedJobType) {
                    $employeeId = $this->normalizeEmployeeId($row->employee_id);
                    $employeeJobType = $this->normalizeJobType($employeeJobTypeMap->get($employeeId));
                    return $employeeJobType === $selectedJobType;
                })
                ->values();
        }

        $records = $records->map(function ($row) use ($employeeJobTypeMap, $employeeDepartmentMap) {
            $employeeId = $this->normalizeEmployeeId($row->employee_id);
            $rowJobType = $this->normalizeJobType($employeeJobTypeMap->get($employeeId));
            $rowDepartment = $employeeDepartmentMap->get($employeeId);
            $computedLateMinutes = $this->calculateLateMinutesFromInTimes($row);
            $isWithinPresentWindow = $this->isPresentByTimeWindow($row);
            $isTardyByRule = !$row->is_absent && !$isWithinPresentWindow && $computedLateMinutes > 0;

            if (method_exists($row, 'setAttribute')) {
                $row->setAttribute('job_type', $rowJobType);
                $row->setAttribute('department', $row->department ?? $rowDepartment);
                $row->setAttribute('computed_late_minutes', $computedLateMinutes);
                $row->setAttribute('is_tardy_by_rule', $isTardyByRule);
                $row->setAttribute('is_holiday_present', (bool) ($row->is_holiday_present ?? false));
            } else {
                $row->job_type = $rowJobType;
                $row->department = $row->department ?? $rowDepartment;
                $row->computed_late_minutes = $computedLateMinutes;
                $row->is_tardy_by_rule = $isTardyByRule;
                $row->is_holiday_present = (bool) ($row->is_holiday_present ?? false);
            }
            return $row;
        });

        // Enforce exact row-level filtering by normalized job type.
        if ($selectedJobType) {
            $records = $records
                ->filter(fn ($row) => $this->normalizeJobType($row->job_type) === $selectedJobType)
                ->values();
        }

        // Business rule: if an employee has any attendance record for the day, count as present.
        $presentEmployees = $records->values();
        $absentEmployees = collect();
        if (!$shouldAutoPresentHolidayDate && !$isSundayNoClassDate) {
            if ($exactDateFilter) {
                $absentEmployees = $this->buildMissingEmployeeAbsences($records, $exactDateFilter, $selectedJobType, $employeeJobTypeMap)
                    ->values();
            } elseif ($rangeStartDate && $rangeEndDate) {
                $absentEmployees = $this->buildMissingEmployeeAbsencesForRange($records, $rangeStartDate, $rangeEndDate, $selectedJobType, $employeeJobTypeMap)
                    ->values();
            } else {
                $absentEmployees = $this->buildMissingEmployeeAbsences($records, $fromDate, $selectedJobType, $employeeJobTypeMap)
                    ->values();
            }
        }
        $tardyEmployees = $records
            ->filter(fn ($row) => (bool) ($row->is_tardy_by_rule ?? false))
            ->map(function ($row) {
                // Keep Blade compatibility by showing the computed late minutes in the existing column.
                $row->late_minutes = (int) ($row->computed_late_minutes ?? 0);
                return $row;
            })
            ->values();
        $allEmployees = $records
            ->map(function ($row) {
                $row->late_minutes = (int) ($row->computed_late_minutes ?? 0);
                return $row;
            })
            ->values();

        $presentCount = $presentEmployees->count();
        $absentCount = $absentEmployees->count();
        $tardyCount = $tardyEmployees->count();
        $totalCount = $records->count();

        return view('admin.adminAttendance', compact(
            'attendanceFiles',
            'fromDate',
            'toDate',
            'selectedUploadId',
            'selectedJobType',
            'jobTypeOptions',
            'activeAttendanceTab',
            'presentEmployees',
            'absentEmployees',
            'tardyEmployees',
            'allEmployees',
            'presentCount',
            'absentCount',
            'tardyCount',
            'totalCount'
        ));
    }

    private function isSundayDate(?string $fromDate): bool
    {
        if (!$fromDate) {
            return false;
        }

        try {
            $date = Carbon::parse($fromDate)->startOfDay();
        } catch (\Throwable $e) {
            return false;
        }

        return $date->isSunday();
    }

    private function isHolidayDate(?string $fromDate): bool
    {
        if (!$fromDate) {
            return false;
        }

        try {
            $date = Carbon::parse($fromDate)->startOfDay();
        } catch (\Throwable $e) {
            return false;
        }

        if ($this->isUsPublicHoliday($date)) {
            return true;
        }

        if ($this->isChineseNewYearDate($date)) {
            return true;
        }

        return false;
    }

    private function isUsPublicHoliday(Carbon $date): bool
    {
        try {
            $response = Http::timeout(6)
                ->acceptJson()
                ->get("https://date.nager.at/api/v3/PublicHolidays/{$date->year}/US");

            if (!$response->ok()) {
                return false;
            }

            $holidays = $response->json();
            if (!is_array($holidays)) {
                return false;
            }

            $targetDate = $date->toDateString();
            foreach ($holidays as $holiday) {
                if (($holiday['date'] ?? null) === $targetDate) {
                    return true;
                }
            }
        } catch (\Throwable $e) {
            return false;
        }

        return false;
    }

    private function isChineseNewYearDate(Carbon $date): bool
    {
        $chineseNewYearByYear = [
            2024 => '2024-02-10',
            2025 => '2025-01-29',
            2026 => '2026-02-17',
            2027 => '2027-02-06',
            2028 => '2028-01-26',
            2029 => '2029-02-13',
            2030 => '2030-02-03',
            2031 => '2031-01-23',
            2032 => '2032-02-11',
            2033 => '2033-01-31',
            2034 => '2034-02-19',
            2035 => '2035-02-08',
        ];

        $target = $chineseNewYearByYear[$date->year] ?? null;
        return $target === $date->toDateString();
    }

    private function buildHolidayPresentEmployees(?string $fromDate, ?string $selectedJobType = null, $employeeJobTypeMap = null)
    {
        $attendanceDate = null;
        if ($fromDate) {
            try {
                $attendanceDate = Carbon::parse($fromDate)->startOfDay();
            } catch (\Throwable $e) {
                $attendanceDate = null;
            }
        }

        // Use the Admin Employee master list as source of truth.
        $employees = User::query()
            ->with('employee')
            ->where('role', 'Employee')
            ->whereHas('employee', function ($query) {
                $query->whereNotNull('employee_id')
                    ->where('employee_id', '!=', '');
            })
            ->orderBy('id')
            ->get();

        if ($selectedJobType && $employeeJobTypeMap) {
            $employees = $employees
                ->filter(function ($user) use ($employeeJobTypeMap, $selectedJobType) {
                    $employeeId = $this->normalizeEmployeeId($user->employee?->employee_id);
                    $employeeJobType = $this->normalizeJobType($employeeJobTypeMap->get($employeeId));
                    return $employeeJobType === $selectedJobType;
                })
                ->values();
        }

        return $employees
            ->map(function ($user) use ($attendanceDate, $employeeJobTypeMap) {
                $employeeProfile = $user->employee;
                $name = trim(implode(' ', array_filter([
                    $user->first_name,
                    $user->middle_name,
                    $user->last_name,
                ])));
                $employeeId = $this->normalizeEmployeeId($employeeProfile?->employee_id);
                $jobType = $this->normalizeJobType($employeeJobTypeMap?->get($employeeId));

                return (object) [
                    'employee_id' => (string) ($employeeProfile?->employee_id ?? ''),
                    'employee_name' => $name !== '' ? $name : null,
                    'job_type' => $jobType,
                    'main_gate' => null,
                    'attendance_date' => $attendanceDate,
                    'morning_in' => null,
                    'morning_out' => null,
                    'afternoon_in' => null,
                    'afternoon_out' => null,
                    'late_minutes' => 0,
                    'computed_late_minutes' => 0,
                    'missing_time_logs' => [],
                    'is_absent' => false,
                    'is_tardy_by_rule' => false,
                    'is_holiday_present' => true,
                ];
            })
            ->values();
    }

    private function getAttendanceRecordsByDate(string $date)  // Retrieves attendance records for a specific date, ensuring uniqueness by normalized employee ID and sorted by employee ID for consistent display.
    {
        return AttendanceRecord::query()
            ->whereDate('attendance_date', $date)
            ->orderByDesc('id')
            ->get()
            ->unique(function ($row) {
                return $this->normalizeEmployeeId($row->employee_id);
            })
            ->sortBy('employee_id')
            ->values();
    }

    private function persistHolidayAttendanceForDate(string $date, $employeeJobTypeMap = null): void // For a given date, creates a synthetic AttendanceUpload record if not already exists, and inserts AttendanceRecord entries for all employees without existing records on that date, marking them as present for the holiday. This ensures that holiday attendance is consistently represented in the system, even if the holiday is auto-detected after the fact.
    {
        $holidayUpload = AttendanceUpload::query()->firstOrCreate(
            ['original_name' => "System Holiday Attendance {$date}"],
            [
                'file_path' => "attendance_excels/system_holiday_{$date}.txt",
                'file_size' => 0,
                'status' => 'Processed',
                'processed_rows' => 0,
                'uploaded_at' => Carbon::parse($date)->endOfDay(),
            ]
        );

        $existingEmployeeIds = AttendanceRecord::query()
            ->whereDate('attendance_date', $date)
            ->pluck('employee_id')
            ->map(fn ($id) => $this->normalizeEmployeeId($id))
            ->filter()
            ->values()
            ->all();

        $employees = User::query()
            ->with('employee')
            ->where('role', 'Employee')
            ->whereHas('employee', function ($query) {
                $query->whereNotNull('employee_id')
                    ->where('employee_id', '!=', '');
            })
            ->orderBy('id')
            ->get();

        $hasEmployeeNameColumn = Schema::hasColumn('attendance_records', 'employee_name');
        $hasDepartmentColumn = Schema::hasColumn('attendance_records', 'department');
        $hasMainGateColumn = Schema::hasColumn('attendance_records', 'main_gate');
        $hasJobTypeColumn = Schema::hasColumn('attendance_records', 'job_type');
        $now = now();
        $recordsToInsert = [];

        foreach ($employees as $user) {
            $employeeId = $this->normalizeEmployeeId($user->employee?->employee_id);
            if ($employeeId === '' || in_array($employeeId, $existingEmployeeIds, true)) {
                continue;
            }

            $name = trim(implode(' ', array_filter([
                $user->first_name,
                $user->middle_name,
                $user->last_name,
            ])));

            $record = [
                'attendance_upload_id' => $holidayUpload->id,
                'employee_id' => (string) $employeeId,
                'attendance_date' => $date,
                'morning_in' => null,
                'morning_out' => null,
                'afternoon_in' => null,
                'afternoon_out' => null,
                'late_minutes' => 0,
                'missing_time_logs' => json_encode([]),
                'is_absent' => false,
                'is_tardy' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ];

            if ($hasEmployeeNameColumn) {
                $record['employee_name'] = $name !== '' ? $name : null;
            }
            if ($hasDepartmentColumn) {
                $record['department'] = $user->employee?->department ?: null;
            }
            if ($hasMainGateColumn) {
                $record['main_gate'] = 'Holiday - No Class';
            }
            if ($hasJobTypeColumn) {
                $record['job_type'] = $this->normalizeJobType($employeeJobTypeMap?->get($employeeId));
            }

            $recordsToInsert[] = $record;
        }

        if (!empty($recordsToInsert)) {
            AttendanceRecord::insert($recordsToInsert);
        }

        $holidayUpload->update([
            'status' => 'Processed',
            'processed_rows' => AttendanceRecord::query()
                ->where('attendance_upload_id', $holidayUpload->id)
                ->count(),
        ]);
    }

    private function isPresentByTimeWindow($row): bool
    {
        return $this->isTimeWithinRange($row->morning_in, '03:00:00', '08:15:00')
            && $this->isTimeWithinRange($row->morning_out, '11:55:00', '12:45:00')
            && $this->isTimeWithinRange($row->afternoon_in, '12:45:00', '13:15:00')
            && $this->isTimeWithinRange($row->afternoon_out, '17:00:00', '20:00:00');
    }

    private function isTimeWithinRange(?string $time, string $start, string $end): bool
    {
        if (!$time) {
            return false;
        }

        try {
            $timeValue = Carbon::createFromFormat('H:i:s', $time)->format('H:i:s');
            return $timeValue >= $start && $timeValue <= $end;
        } catch (\Throwable $e) {
            return false;
        }
    }

    private function calculateLateMinutesFromInTimes($row): int
    {
        $late = 0;

        if ($row->morning_in) {
            try {
                $morningActual = Carbon::createFromFormat('H:i:s', $row->morning_in);
                $morningExpected = Carbon::createFromFormat('H:i:s', '08:00:00');
                $morningGraceEnd = Carbon::createFromFormat('H:i:s', '08:15:00');
                if ($morningActual->greaterThan($morningGraceEnd)) {
                    $late += $morningExpected->diffInMinutes($morningActual);
                }
            } catch (\Throwable $e) {
            }
        }

        if ($row->afternoon_in) {
            try {
                $afternoonActual = Carbon::createFromFormat('H:i:s', $row->afternoon_in);
                $afternoonExpected = Carbon::createFromFormat('H:i:s', '13:00:00');
                $afternoonGraceEnd = Carbon::createFromFormat('H:i:s', '13:15:00');
                if ($afternoonActual->greaterThan($afternoonGraceEnd)) {
                    $late += $afternoonExpected->diffInMinutes($afternoonActual);
                }
            } catch (\Throwable $e) {
            }
        }

        return $late;
    }

    private function buildMissingEmployeeAbsences($records, ?string $fromDate, ?string $selectedJobType = null, $employeeJobTypeMap = null)
    {
        $recordedEmployeeIds = $records
            ->pluck('employee_id')
            ->map(fn ($id) => $this->normalizeEmployeeId($id))
            ->filter()
            ->values()
            ->all();

        $employees = Employee::query()
            ->with('user:id,first_name,middle_name,last_name,role,status')
            ->whereNotNull('employee_id')
            ->where('employee_id', '!=', '')
            ->orderBy('employee_id')
            ->get();

        if ($selectedJobType && $employeeJobTypeMap) {
            $employees = $employees
                ->filter(function ($employee) use ($employeeJobTypeMap, $selectedJobType) {
                    $employeeId = $this->normalizeEmployeeId($employee->employee_id);
                    $employeeJobType = $this->normalizeJobType($employeeJobTypeMap->get($employeeId));
                    return $employeeJobType === $selectedJobType;
                })
                ->values();
        }

        $attendanceDate = null;
        if ($fromDate) {
            try {
                $attendanceDate = Carbon::parse($fromDate)->startOfDay();
            } catch (\Throwable $e) {
                $attendanceDate = null;
            }
        }

        return $employees
            ->reject(function ($employee) use ($recordedEmployeeIds) {
                $employeeId = $this->normalizeEmployeeId($employee->employee_id);
                return in_array($employeeId, $recordedEmployeeIds, true);
            })
            ->map(function ($employee) use ($attendanceDate, $employeeJobTypeMap) {
                $user = $employee->user;
                $name = trim(implode(' ', array_filter([
                    $user?->first_name,
                    $user?->middle_name,
                    $user?->last_name,
                ])));
                $employeeId = $this->normalizeEmployeeId($employee->employee_id);
                $jobType = $this->normalizeJobType($employeeJobTypeMap?->get($employeeId));

                return (object) [
                    'employee_id' => (string) $employee->employee_id,
                    'employee_name' => $name !== '' ? $name : null,
                    'job_type' => $jobType,
                    'main_gate' => null,
                    'attendance_date' => $attendanceDate,
                    'morning_in' => null,
                    'morning_out' => null,
                    'afternoon_in' => null,
                    'afternoon_out' => null,
                    'late_minutes' => 0,
                    'computed_late_minutes' => 0,
                    'missing_time_logs' => ['morning_in', 'morning_out', 'afternoon_in', 'afternoon_out'],
                    'is_absent' => true,
                    'is_tardy_by_rule' => false,
                ];
            })
            ->values();
    }

    private function buildMissingEmployeeAbsencesForRange($records, string $startDate, string $endDate, ?string $selectedJobType = null, $employeeJobTypeMap = null)
    {
        $recordedEmployeeIds = $records
            ->pluck('employee_id')
            ->map(fn ($id) => $this->normalizeEmployeeId($id))
            ->filter()
            ->values()
            ->all();

        $employees = Employee::query()
            ->with('user:id,first_name,middle_name,last_name,role,status')
            ->whereHas('user', function ($query) {
                $query->where('role', 'Employee')
                    ->where('status', 'Approved');
            })
            ->orderBy('employee_id')
            ->get();

        if ($selectedJobType && $employeeJobTypeMap) {
            $employees = $employees
                ->filter(function ($employee) use ($employeeJobTypeMap, $selectedJobType) {
                    $employeeId = $this->normalizeEmployeeId($employee->employee_id);
                    $employeeJobType = $this->normalizeJobType($employeeJobTypeMap->get($employeeId));
                    return $employeeJobType === $selectedJobType;
                })
                ->values();
        }

        return $employees
            ->reject(function ($employee) use ($recordedEmployeeIds) {
                $employeeId = $this->normalizeEmployeeId($employee->employee_id);
                return in_array($employeeId, $recordedEmployeeIds, true);
            })
            ->map(function ($employee) use ($employeeJobTypeMap) {
                $user = $employee->user;
                $name = trim(implode(' ', array_filter([
                    $user?->first_name,
                    $user?->middle_name,
                    $user?->last_name,
                ])));
                $employeeId = $this->normalizeEmployeeId($employee->employee_id);
                $jobType = $this->normalizeJobType($employeeJobTypeMap?->get($employeeId));

                return (object) [
                    'employee_id' => (string) $employee->employee_id,
                    'employee_name' => $name !== '' ? $name : null,
                    'job_type' => $jobType,
                    'main_gate' => null,
                    'attendance_date' => null,
                    'morning_in' => null,
                    'morning_out' => null,
                    'afternoon_in' => null,
                    'afternoon_out' => null,
                    'late_minutes' => 0,
                    'computed_late_minutes' => 0,
                    'missing_time_logs' => ['morning_in', 'morning_out', 'afternoon_in', 'afternoon_out'],
                    'is_absent' => true,
                    'is_tardy_by_rule' => false,
                ];
            })
            ->values();
    }

    private function expandRecordsForDateRange(
        $records,
        string $startDate,
        string $endDate,
        ?string $selectedJobType = null,
        $employeeJobTypeMap = null,
        $employeeDepartmentMap = null
    ) {
        $existingByEmployeeDate = collect($records)
            ->filter(function ($row) {
                return !empty($row->employee_id) && !empty($row->attendance_date);
            })
            ->sortByDesc('id')
            ->reduce(function ($carry, $row) {
                $employeeId = $this->normalizeEmployeeId($row->employee_id);
                if ($employeeId === '') {
                    return $carry;
                }

                $date = optional($row->attendance_date)->format('Y-m-d');
                if (!$date) {
                    try {
                        $date = Carbon::parse($row->attendance_date)->toDateString();
                    } catch (\Throwable $e) {
                        $date = null;
                    }
                }

                if (!$date) {
                    return $carry;
                }

                $key = $employeeId.'|'.$date;
                if (!$carry->has($key)) {
                    $carry->put($key, $row);
                }

                return $carry;
            }, collect());

        $employees = Employee::query()
            ->with('user:id,first_name,middle_name,last_name,role,status')
            ->whereHas('user', function ($query) {
                $query->where('role', 'Employee')
                    ->where('status', 'Approved');
            })
            ->orderBy('employee_id')
            ->get();

        if ($selectedJobType && $employeeJobTypeMap) {
            $employees = $employees
                ->filter(function ($employee) use ($employeeJobTypeMap, $selectedJobType) {
                    $employeeId = $this->normalizeEmployeeId($employee->employee_id);
                    $employeeJobType = $this->normalizeJobType($employeeJobTypeMap->get($employeeId));
                    return $employeeJobType === $selectedJobType;
                })
                ->values();
        }

        $expanded = collect();
        $current = Carbon::parse($startDate)->startOfDay();
        $last = Carbon::parse($endDate)->startOfDay();

        while ($current->lte($last)) {
            $date = $current->toDateString();

            foreach ($employees as $employee) {
                $employeeId = $this->normalizeEmployeeId($employee->employee_id);
                if ($employeeId === '') {
                    continue;
                }

                $key = $employeeId.'|'.$date;
                $existing = $existingByEmployeeDate->get($key);

                if ($existing) {
                    $expanded->push($existing);
                    continue;
                }

                $user = $employee->user;
                $name = trim(implode(' ', array_filter([
                    $user?->first_name,
                    $user?->middle_name,
                    $user?->last_name,
                ])));

                $expanded->push((object) [
                    'employee_id' => (string) $employee->employee_id,
                    'employee_name' => $name !== '' ? $name : null,
                    'department' => $employeeDepartmentMap?->get($employeeId),
                    'job_type' => $this->normalizeJobType($employeeJobTypeMap?->get($employeeId)),
                    'main_gate' => null,
                    'attendance_date' => Carbon::parse($date)->startOfDay(),
                    'morning_in' => null,
                    'morning_out' => null,
                    'afternoon_in' => null,
                    'afternoon_out' => null,
                    'late_minutes' => 0,
                    'computed_late_minutes' => 0,
                    'missing_time_logs' => ['morning_in', 'morning_out', 'afternoon_in', 'afternoon_out'],
                    'is_absent' => true,
                    'is_tardy_by_rule' => false,
                    'is_holiday_present' => false,
                ]);
            }

            $current->addDay();
        }

        return $expanded
            ->sortBy(function ($row) {
                $date = optional($row->attendance_date)->format('Y-m-d') ?? '';
                return $date.'|'.$this->normalizeEmployeeId($row->employee_id);
            })
            ->values();
    }

    private function normalizeJobType($value): ?string // Normalizes various user inputs for job type into consistent values used in the system. Returns null for empty or unrecognized inputs.
    {
        $normalized = strtolower(trim((string) $value));
        if ($normalized === '') {
            return null;
        }

        if (in_array($normalized, ['teaching', 't'], true)) {
            return 'Teaching';
        }

        if (in_array($normalized, ['non-teaching', 'non teaching', 'nonteaching', 'nt'], true)) {
            return 'Non-Teaching';
        }

        return ucwords($normalized);
    }

    private function normalizeEmployeeId($value): string
    {
        $normalized = trim((string) $value);
        if ($normalized === '') {
            return '';
        }

        // Excel often exports numeric IDs as "123.0"; map these back to the base ID.
        if (preg_match('/^(\d+)\.0+$/', $normalized, $matches)) {
            return $matches[1];
        }

        return $normalized;
    }

    private function normalizeFilterDate(?string $fromDate): ?string
    {
        if (!$fromDate) {
            return null;
        }

        try {
            return Carbon::parse($fromDate)->toDateString();
        } catch (\Throwable $e) {
            return null;
        }
    }

    public function display_leave(){
        return view('admin.adminLeaveManagement');
    }

    public function display_reports(){
        return view('admin.adminReports');
    }

    public function display_compare(){
        return view('admin.compareCode');
    }

    public function display_applicant(){
        $applicant = Applicant::with(
            'position:id,title,department,employment,collage_name,work_mode,job_description,responsibilities,requirements,experience_level,location,skills,benifits,job_type,one,two,passionate'
        )->latest('created_at')->get();
        $count_applicant = Applicant::count();
        $count_under_review = $applicant->where('application_status','Under Review')->count();
        $count_final_interview = $applicant
            ->whereIn('application_status', ['Initial Interview', 'Final Interview'])
            ->count();
        $hired = Applicant::where('application_status', 'Hired')->whereMonth('created_at', now()->month)
                                        ->whereYear('created_at', now()->year)
                                        ->count();

        return view('admin.adminApplicant', compact('applicant', 'hired',
                                            'count_applicant','count_under_review'
                                            ,'count_final_interview'));
    }

    public function display_applicant_ID($id){
        $app = Applicant::with(
            'documents:id,filename,applicant_id',
            'position:id,title,department,employment,collage_name,work_mode,job_description,responsibilities,requirements,experience_level,location,skills,benifits,job_type,one,two,passionate'
            )->findOrFail($id);

        return response()->json([
            'id' => $app->id,
            'name' => $app->first_name.' '.$app->last_name,
            'email' => $app->email,
            'title' => $app->position->title,
            'status' => $app->application_status,
            'location' => $app->address,
            'one' => $app->created_at->format('F d, Y'),
            'passionate' => $app->position->passionate,
            'work_position' => $app->work_position,
            'work_employer' => $app->work_employer,
            'work_location' => $app->work_location,
            'work_duration' => $app->work_duration,
            'university_name' => $app->university_name,
            'university_address' => $app->university_address,
            'university_year' => $app->year_complete,
            'skills' => $app->skills_n_expertise,
            'number' => $app->phone,
            'star' => $app->starRatings,
            'documents' => $app->documents->map(function ($doc) {
                return [
                    'id' => $doc->id,
                    'name' => $doc->filename,
                    'type' => $doc->type,
                ];
            }),
        ]);
    }

    public function display_edit_position($id){
        $open = OpenPosition::findOrFail($id);
        return view('admin.adminEditPosition', compact('open'));
    }

    public function display_interview(){/////sync interview status to applicant status if interview is completed
        $this->syncFinishedInterviewApplicantStatuses();

        $allInterviews = Interviewer::with(['applicant.position'])
            ->whereHas('applicant')
            ->orderBy('date')
            ->orderBy('time')
            ->get();

        // Show all scheduled interviews in the list; card state is handled in the view.
        $interview = $allInterviews->values();
        $upcomingInterviews = $allInterviews
            ->filter(function ($item) {
                $start = \Carbon\Carbon::parse($item->date->format('Y-m-d').' '.$item->time);
                $end = (clone $start)->addMinutes($this->durationToMinutes($item->duration));
                return now()->lt($end);
            })
            ->values();
        $completedInterviews = $allInterviews
            ->filter(function ($item) {
                $start = \Carbon\Carbon::parse($item->date->format('Y-m-d').' '.$item->time);
                $end = (clone $start)->addMinutes($this->durationToMinutes($item->duration));
                return now()->gte($end);
            })
            ->values();

        $count_daily = $allInterviews
            ->filter(function ($item) {
                $start = \Carbon\Carbon::parse($item->date->format('Y-m-d').' '.$item->time);
                $end = (clone $start)->addMinutes($this->durationToMinutes($item->duration));
                return $end->isToday() && now()->gte($end);
            })
            ->count();
        $count_month = $allInterviews
            ->filter(function ($item) {
                $start = \Carbon\Carbon::parse($item->date->format('Y-m-d').' '.$item->time);
                $end = (clone $start)->addMinutes($this->durationToMinutes($item->duration));
                return $end->isCurrentMonth() && $end->isCurrentYear() && now()->gte($end);
            })
            ->count();
        $count_year = $allInterviews
            ->filter(function ($item) {
                $start = \Carbon\Carbon::parse($item->date->format('Y-m-d').' '.$item->time);
                $end = (clone $start)->addMinutes($this->durationToMinutes($item->duration));
                return $end->isCurrentYear() && now()->gte($end);
            })
            ->count();
        $count_upcoming = $allInterviews
            ->filter(function ($item) {
                $start = \Carbon\Carbon::parse($item->date->format('Y-m-d').' '.$item->time);
                return now()->lt($start);
            })
            ->count();
        return view('admin.adminInterview', compact(
            'interview',
            'upcomingInterviews',
            'completedInterviews',
            'count_daily',
            'count_month',
            'count_year',
            'count_upcoming'
        ));
    }

    private function syncFinishedInterviewApplicantStatuses(): void
    {
        $allInterviews = Interviewer::query()
            ->select(['applicant_id', 'date', 'time', 'duration'])
            ->whereNotNull('applicant_id')
            ->get();

        if ($allInterviews->isEmpty()) {
            return;
        }

        $latestByApplicant = $allInterviews
            ->groupBy('applicant_id')
            ->map(function ($items) {
                return $items->sortBy(function ($item) {
                    $start = Carbon::parse($item->date->format('Y-m-d').' '.$item->time);
                    $end = (clone $start)->addMinutes($this->durationToMinutes($item->duration));
                    return $end->timestamp;
                })->last();
            })
            ->filter();

        $completedApplicantIds = $latestByApplicant
            ->filter(function ($item) {
                $start = Carbon::parse($item->date->format('Y-m-d').' '.$item->time);
                $end = (clone $start)->addMinutes($this->durationToMinutes($item->duration));
                return now()->gte($end);
            })
            ->keys()
            ->values()
            ->all();

        if (empty($completedApplicantIds)) {
            return;
        }

        Applicant::query()
            ->whereIn('id', $completedApplicantIds)
            ->whereIn('application_status', ['Initial Interview', 'Final Interview'])
            ->update(['application_status' => 'Completed']);
    }

    private function durationToMinutes(?string $duration): int
    {
        if (!$duration) {
            return 0;
        }

        if (preg_match('/(\d+)/', $duration, $matches)) {
            return (int) $matches[1];
        }

        return 0;
    }

    public function display_interview_ID($id){
        $app = Interviewer::with([
            'applicant:id,first_name,last_name,open_position_id',
            'applicant.position:id,title,department,employment,collage_name,work_mode,job_description,responsibilities,requirements,experience_level,location,skills,benifits,job_type,one,two,passionate'
        ])->where('applicant_id', $id)->firstOrFail();


        return response()->json([
            'id' => $app->id,
            'name' => $app->applicant->first_name.' '.$app->applicant->last_name,
            'email' => $app->email_link,
            'title' => $app->applicant->position->title,
            'status' => $app->application_status,
            'applicant_id' => $app->applicant_id,
            'interview_type' => $app->interview_type,
            'date' => $app->date->format('Y-m-d'),
            'time' => \Carbon\Carbon::parse($app->time)->format('H:i'),
            'duration' => $app->duration,
            'interviewers' => $app->interviewers,
            'email_link' => $app->email_link,
            'url' => $app->url,
            'notes' => $app->notes,
        ]);
    }

    public function display_meeting(){
        return view('admin.adminMeeting');
    }

    public function display_calendar(){
        return view('admin.adminCalendar');
    }

    public function display_position(){
        $openPosition = OpenPosition::withCount('applicants')->get();
        $openPositions = OpenPosition::all();
        $countApplication = Applicant::groupBy('open_position_id')->count();
        $logs = GuestLog::count();
        $positionCounts = $openPositions->count();
        $applicantCounts = Applicant::count();
        return view('admin.adminPosition', compact('openPosition',
        'logs', 'positionCounts', 'applicantCounts','countApplication'));
    }

    public function display_show_position($id){
        $open = OpenPosition::findOrFail($id);
        $titles = OpenPosition::pluck('id');
        $admin = User::admins()->get();
        $countApplication = Applicant::whereIn('open_position_id', $titles)->count();
        return view('admin.adminShowPosition', compact('open','countApplication','admin'));
    }

    public function display_overview(){
        return view('admin.adminEmployeeOverview');
    }

    public function employee_documents($id){
        $employee = User::with([
            'applicant.documents' => function ($query) {
                $query->select([
                    'id',
                    'applicant_id',
                    'filename',
                    'filepath',
                    'type',
                    'mime_type',
                    'size',
                    'created_at',
                ])->orderByDesc('created_at');
            },
        ])->where('role', 'Employee')->findOrFail($id);

        $documents = $employee->applicant?->documents?->values() ?? collect();

        return response()->json([
            'documents' => $documents,
        ]);
    }

    //Personal Detail
    public function display_documents(){
        return view('admin.PersonalDetail.adminEmployeeDocuments');
    }

    public function display_pd(){
        return view('admin.PersonalDetail.adminEmployeePD');
    }

    public function display_personal_detail_overview(){
        return view('admin.PersonalDetail.adminEmployeeOverview');
    }

    public function display_performance(){
        return view('admin.PersonalDetail.adminEmployeePerformance');
    }

    public function display_edit(){
        return view('admin.PersonalDetail.editProfile');
    }

    public function display_create_position(){
        return view('admin.adminCreatePosition');
    }

}
