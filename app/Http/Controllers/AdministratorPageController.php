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
use Illuminate\Support\Facades\Log;

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

    private function buildAttendanceView(Request $request, string $activeAttendanceTab = 'all'){
        $fromDate = $request->query('from_date');
        $selectedUploadId = $request->query('upload_id');
        $selectedJobType = $this->normalizeJobType($request->query('job_type'));
        $allowedJobTypes = ['Teaching', 'Non-Teaching'];
        if ($selectedJobType && !in_array($selectedJobType, $allowedJobTypes, true)) {
            $selectedJobType = null;
        }

        $attendanceFiles = AttendanceUpload::query()
            ->when($fromDate, function ($query) use ($fromDate) {
                $query->whereDate('uploaded_at', '>=', $fromDate);
            })
            ->orderByDesc('uploaded_at')
            ->orderByDesc('id')
            ->get();

        if (!$selectedUploadId) {
            $selectedUploadId = optional(
                $attendanceFiles->firstWhere('status', 'Processed') ?? $attendanceFiles->first()
            )->id;
        }

        $records = collect();
        if ($selectedUploadId) {
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

        $jobTypeOptions = collect($allowedJobTypes);

        if ($selectedJobType) {
            $records = $records
                ->filter(function ($row) use ($employeeJobTypeMap, $selectedJobType) {
                    $employeeId = $this->normalizeEmployeeId($row->employee_id);
                    $employeeJobType = $this->normalizeJobType($employeeJobTypeMap->get($employeeId));
                    return $employeeJobType === $selectedJobType;
                })
                ->values();
        }

        $records = $records->map(function ($row) use ($employeeJobTypeMap) {
            $employeeId = $this->normalizeEmployeeId($row->employee_id);
            $rowJobType = $this->normalizeJobType($employeeJobTypeMap->get($employeeId));
            $computedLateMinutes = $this->calculateLateMinutesFromInTimes($row);
            $isWithinPresentWindow = $this->isPresentByTimeWindow($row);
            $isTardyByRule = !$row->is_absent && !$isWithinPresentWindow && $computedLateMinutes > 0;

            $row->setAttribute('job_type', $rowJobType);
            $row->setAttribute('computed_late_minutes', $computedLateMinutes);
            $row->setAttribute('is_tardy_by_rule', $isTardyByRule);
            return $row;
        });

        // Enforce exact row-level filtering by normalized job type.
        if ($selectedJobType) {
            $records = $records
                ->filter(fn ($row) => $this->normalizeJobType($row->job_type) === $selectedJobType)
                ->values();
        }

        $presentEmployees = $records
            ->filter(fn ($row) => !$row->is_absent)
            ->values();
        $absentEmployees = $records->where('is_absent', true)->values();
        $missingEmployeeAbsences = $this->buildMissingEmployeeAbsences($records, $fromDate, $selectedJobType, $employeeJobTypeMap);
        $absentEmployees = $absentEmployees
            ->concat($missingEmployeeAbsences)
            ->values();
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

    private function normalizeJobType($value): ?string
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
        $count_final_interview = $applicant->where('application_status','Final Interview')->count();
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

    public function display_interview(){
        $allInterviews = Interviewer::with('applicant')
            ->orderBy('date')
            ->orderBy('time')
            ->get();

        $interview = $allInterviews
            ->filter(function ($item) {
                $start = \Carbon\Carbon::parse($item->date->format('Y-m-d').' '.$item->time);
                $end = (clone $start)->addMinutes($this->durationToMinutes($item->duration));
                return now()->lte($end);
            })
            ->values();

        $count_daily = $allInterviews
            ->filter(function ($item) {
                if (!$item->date->isToday()) {
                    return false;
                }

                $start = \Carbon\Carbon::parse($item->date->format('Y-m-d').' '.$item->time);
                $end = (clone $start)->addMinutes($this->durationToMinutes($item->duration));
                return now()->gte($end);
            })
            ->count();
        $count_month = Interviewer::whereMonth('date', now()->month)
                                    ->whereYear('date', now()->year)
                                    ->whereDate('date', '<', today())
                                    ->count();
        $count_year = Interviewer::whereYear('date', now()->year)
                                    ->whereDate('date', '<', today())
                                    ->count();
        $count_upcoming = Interviewer::whereDate('date', today())
                                    ->whereTime('time', '>', now())
                                    ->count();
        return view('admin.adminInterview', compact('interview','count_daily','count_month',
                                                    'count_year','count_upcoming'));
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
