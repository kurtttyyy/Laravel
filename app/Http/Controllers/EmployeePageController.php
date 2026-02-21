<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\ApplicantDocument;
use App\Models\User;
use App\Models\LeaveApplication;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeePageController extends Controller
{
    public function display_home(){
        $user = Auth::user();
        return view('employee.employeeHome', compact('user'));
    }

    public function display_leave(){
        $user = Auth::user();
        $selectedMonth = trim((string) request()->query('month', now()->format('Y-m')));
        try {
            $monthCursor = Carbon::createFromFormat('Y-m', $selectedMonth)->startOfMonth();
        } catch (\Throwable $e) {
            $monthCursor = now()->startOfMonth();
            $selectedMonth = $monthCursor->format('Y-m');
        }

        $employeeDisplayName = $this->formatEmployeeDisplayName(
            $user?->first_name,
            $user?->middle_name,
            $user?->last_name
        );

        $isTeaching = strcasecmp((string) ($user?->employee?->job_type ?? ''), 'Teaching') === 0;
        $joinDate = null;
        if ($isTeaching && !empty($user?->applicant?->date_hired)) {
            $joinDate = Carbon::parse($user->applicant->date_hired);
        } elseif (!empty($user?->employee?->employement_date)) {
            $joinDate = Carbon::parse($user->employee->employement_date);
        } elseif (!empty($user?->applicant?->date_hired)) {
            $joinDate = Carbon::parse($user->applicant->date_hired);
        }
        $resetCycleMonths = $isTeaching ? 10 : 12;

        $defaultLeaveAllowances = [
            'Study Leave' => 5,
            'Emergency Leave' => 3,
            'Maternity Leave' => 105,
            'Paternity Leave' => 7,
            'Bereavement Leave' => 5,
            'Service Incentive Leave' => 5,
        ];

        $beginningVacationBalance = 0.0;
        $beginningSickBalance = 0.0;
        $totalEarnedDays = $this->calculateMonthlyEarnedLeaveDays(
            $joinDate,
            $monthCursor,
            $resetCycleMonths
        );
        $earnedRangeLabel = $this->buildEarnedRangeLabel($joinDate, $monthCursor, $resetCycleMonths);
        $monthStart = $monthCursor->copy()->startOfMonth();
        $monthEnd = $monthCursor->copy()->endOfMonth();
        $monthApplications = LeaveApplication::query()
            ->where('user_id', $user?->id)
            ->where(function ($query) use ($monthCursor) {
                $query
                    ->where(function ($filingDateQuery) use ($monthCursor) {
                        $filingDateQuery
                            ->whereNotNull('filing_date')
                            ->whereYear('filing_date', $monthCursor->year)
                            ->whereMonth('filing_date', $monthCursor->month);
                    })
                    ->orWhere(function ($createdAtQuery) use ($monthCursor) {
                        $createdAtQuery
                            ->whereNull('filing_date')
                            ->whereYear('created_at', $monthCursor->year)
                            ->whereMonth('created_at', $monthCursor->month);
                    });
            })
            ->orderByDesc('created_at')
            ->get();

        $approvedMonthApplications = $monthApplications
            ->filter(function ($application) {
                return strcasecmp((string) ($application->status ?? ''), 'Approved') === 0;
            })
            ->values();
        $pendingMonthApplications = $monthApplications
            ->filter(function ($application) {
                $status = trim((string) ($application->status ?? ''));
                return $status === '' || strcasecmp($status, 'Pending') === 0;
            })
            ->values();

        $mapApplicationToRecord = function ($application) use ($employeeDisplayName) {
            $leaveType = (string) ($application->leave_type ?: 'Leave');
            $leaveTypeNormalized = strtolower(trim($leaveType));
            $baseDate = $application->filing_date
                ? Carbon::parse($application->filing_date)->startOfDay()
                : Carbon::parse($application->created_at)->startOfDay();
            $days = (float) ($application->number_of_working_days ?? 0);
            if ($days <= 0) {
                $days = max(
                    (float) ($application->days_with_pay ?? 0),
                    (float) ($application->applied_total ?? 0)
                );
            }
            $rangeDays = max((int) ceil($days), 1);

            $reasonText = $application->inclusive_dates ?: '-';
            if (str_contains($leaveTypeNormalized, 'official business')) {
                $reasonText = 'Business Trip';
            } elseif (str_contains($leaveTypeNormalized, 'annual leave')) {
                $reasonText = 'Personal vacation';
            } elseif (str_contains($leaveTypeNormalized, 'sick leave')) {
                $reasonText = 'Not fit for work due to health reasons';
            }

            $statusText = trim((string) ($application->status ?? ''));
            if ($statusText === '') {
                $statusText = 'Pending';
            }

            return [
                'employee_name' => $application->employee_name ?: $employeeDisplayName,
                'leave_type' => $leaveType,
                'start_date_carbon' => $baseDate->copy(),
                'end_date_carbon' => $baseDate->copy()->addDays($rangeDays - 1),
                'days' => $days,
                'reason' => $reasonText,
                'status' => $statusText,
            ];
        };

        $monthRequestRecords = $monthApplications
            ->map($mapApplicationToRecord)
            ->values();

        $employeeMonthRecords = $approvedMonthApplications
            ->map($mapApplicationToRecord)
            ->values();

        $latestLeaveApplication = LeaveApplication::query()
            ->where('user_id', $user?->id)
            ->whereDate('created_at', '<=', $monthEnd->toDateString())
            ->orderByDesc('created_at')
            ->first();

        if ($latestLeaveApplication) {
            $beginningVacationBalance = (float) ($latestLeaveApplication->ending_vacation ?? 0);
            $beginningSickBalance = (float) ($latestLeaveApplication->ending_sick ?? 0);
        }

        $hasExistingMonthApplication = LeaveApplication::query()
            ->where('user_id', $user?->id)
            ->whereBetween('created_at', [$monthStart->toDateTimeString(), $monthEnd->toDateTimeString()])
            ->exists();

        $equalHalfEarnedDays = round($totalEarnedDays / 2, 1);
        $formEarnedVacation = $hasExistingMonthApplication ? 0.0 : $equalHalfEarnedDays;
        $formEarnedSick = $hasExistingMonthApplication ? 0.0 : $equalHalfEarnedDays;
        $formEarnedTotal = round($formEarnedVacation + $formEarnedSick, 1);

        $monthlyLeaveAllowances = collect($defaultLeaveAllowances)
            ->mapWithKeys(fn ($value, $leaveType) => [$leaveType => max(0, (int) $value)])
            ->all();
        $monthlyLeaveAllowances['Annual Leave'] = $equalHalfEarnedDays;
        $monthlyLeaveAllowances['Sick Leave'] = $equalHalfEarnedDays;

        $employeeLeaveUsageByType = $employeeMonthRecords
            ->groupBy(fn ($record) => (string) ($record['leave_type'] ?? 'Leave'))
            ->map(fn ($records) => (int) $records->sum('days'));

        $annualLimit = (float) ($monthlyLeaveAllowances['Annual Leave'] ?? 0);
        $annualUsed = (float) ($employeeLeaveUsageByType->get('Annual Leave', 0));
        $sickLimit = (float) ($monthlyLeaveAllowances['Sick Leave'] ?? 0);
        $sickUsed = (float) ($employeeLeaveUsageByType->get('Sick Leave', 0));
        $personalLimit = (int) ($monthlyLeaveAllowances['Personal Leave'] ?? 0);
        $personalUsed = (int) ($employeeLeaveUsageByType->get('Personal Leave', 0));
        $totalDaysUsed = (float) $employeeMonthRecords->sum('days');

        $vacationCardAvailable = max($annualLimit - $annualUsed, 0);
        $sickCardAvailable = max($sickLimit - $sickUsed, 0);
        $totalDaysUsedCard = $totalDaysUsed;

        $monthAppliedTotal = round((float) $approvedMonthApplications->sum('applied_total'), 1);
        $monthOfficialWithPayTotal = round((float) $approvedMonthApplications
            ->filter(function ($application) {
                $leaveType = strtolower(trim((string) ($application->leave_type ?? '')));

                return str_contains($leaveType, 'official business')
                    || str_contains($leaveType, 'official time')
                    || str_starts_with($leaveType, 'others');
            })
            ->sum('days_with_pay'), 1);
        $monthUsageTotal = round($monthAppliedTotal + $monthOfficialWithPayTotal, 1);
        $pendingLeaveDays = round((float) $pendingMonthApplications->sum(function ($application) {
            return (float) ($application->number_of_working_days ?? 0);
        }), 1);

        if ($latestLeaveApplication) {
            $annualLimit = round((float) ($latestLeaveApplication->beginning_vacation ?? 0) + (float) ($latestLeaveApplication->earned_vacation ?? 0), 1);
            $annualUsed = round((float) ($latestLeaveApplication->applied_vacation ?? 0), 1);
            $sickLimit = round((float) ($latestLeaveApplication->beginning_sick ?? 0) + (float) ($latestLeaveApplication->earned_sick ?? 0), 1);
            $sickUsed = round((float) ($latestLeaveApplication->applied_sick ?? 0), 1);
            $vacationCardAvailable = round((float) ($latestLeaveApplication->ending_vacation ?? 0), 1);
            $sickCardAvailable = round((float) ($latestLeaveApplication->ending_sick ?? 0), 1);
            $fallbackUsedDays = (float) ($latestLeaveApplication->applied_total ?? $totalDaysUsed);
            $totalDaysUsedCard = round($monthUsageTotal > 0 ? $monthUsageTotal : $fallbackUsedDays, 1);
        }

        return view('employee.employeeLeave', compact(
            'selectedMonth',
            'employeeDisplayName',
            'monthRequestRecords',
            'employeeMonthRecords',
            'pendingMonthApplications',
            'pendingLeaveDays',
            'annualLimit',
            'annualUsed',
            'sickLimit',
            'sickUsed',
            'personalLimit',
            'personalUsed',
            'totalDaysUsed',
            'vacationCardAvailable',
            'sickCardAvailable',
            'totalDaysUsedCard',
            'beginningVacationBalance',
            'beginningSickBalance',
            'earnedRangeLabel',
            'totalEarnedDays',
            'formEarnedVacation',
            'formEarnedSick',
            'formEarnedTotal'
        ));
    }

    public function display_profile(){
        $user = Auth::user();
        $emp = User::with([
            'employee',
            'applicant',
            'education',
            'license',
            'salary',
            'government',
        ])->where('id', $user->id)->first();

        return view('employee.employeeProfile', compact('emp'));
    }

    public function display_payslip(){
        return view('employee.employeePayslip');
    }

    public function display_document(){
        $user_id = Auth::id();
        $applicant = Applicant::where('user_id', $user_id)
                                ->where('application_status','Hired')
                                ->first();

        $documents = collect();
        $latestDocument = null;
        if ($applicant) {
            $documents = ApplicantDocument::where('applicant_id', $applicant->id)
                ->latest('created_at')
                ->get();
            $latestDocument = $documents->first();
        }

        return view('employee.employeeDocument', compact('documents', 'latestDocument'));
    }

    public function display_communication(){
        $admins = User::query()
            ->whereIn('role', ['admin', 'Admin'])
            ->orderBy('first_name')
            ->get();

        return view('employee.employeeCommunication', compact('admins'));
    }

    private function formatEmployeeDisplayName($firstName, $middleName, $lastName): ?string
    {
        $first = trim((string) ($firstName ?? ''));
        $middle = trim((string) ($middleName ?? ''));
        $last = trim((string) ($lastName ?? ''));

        $firstMiddle = trim(implode(' ', array_filter([$first, $middle], fn ($part) => $part !== '')));

        if ($last !== '' && $firstMiddle !== '') {
            return "{$last}, {$firstMiddle}";
        }
        if ($last !== '') {
            return $last;
        }
        if ($firstMiddle !== '') {
            return $firstMiddle;
        }

        return null;
    }

    private function getSharedLeaveRecords()
    {
        return collect([
            [
                'employee_name' => 'Santos, Maria L.',
                'department' => 'Faculty',
                'leave_type' => 'Sick Leave',
                'start_date' => '2026-02-12',
                'end_date' => '2026-02-12',
                'status' => 'Approved',
                'reason' => 'Flu and medical check-up',
            ],
            [
                'employee_name' => 'Reyes, John Paulo A.',
                'department' => 'Admin',
                'leave_type' => 'Annual Leave',
                'start_date' => '2026-02-10',
                'end_date' => '2026-02-14',
                'status' => 'Approved',
                'reason' => 'Family vacation',
            ],
            [
                'employee_name' => 'Dela Cruz, Anna P.',
                'department' => 'Faculty',
                'leave_type' => 'Study Leave',
                'start_date' => '2026-02-17',
                'end_date' => '2026-02-18',
                'status' => 'Pending',
                'reason' => 'Graduate exam preparation',
            ],
            [
                'employee_name' => 'Garcia, Miguel R.',
                'department' => 'Registrar',
                'leave_type' => 'Emergency Leave',
                'start_date' => '2026-02-08',
                'end_date' => '2026-02-08',
                'status' => 'Approved',
                'reason' => 'Immediate family concern',
            ],
            [
                'employee_name' => 'Lopez, Carla M.',
                'department' => 'Faculty',
                'leave_type' => 'Maternity Leave',
                'start_date' => '2026-01-20',
                'end_date' => '2026-02-20',
                'status' => 'Approved',
                'reason' => 'Maternity recovery',
            ],
            [
                'employee_name' => 'Torres, Noel B.',
                'department' => 'Guidance',
                'leave_type' => 'Paternity Leave',
                'start_date' => '2026-02-05',
                'end_date' => '2026-02-11',
                'status' => 'Approved',
                'reason' => 'Child birth support',
            ],
            [
                'employee_name' => 'Nolasco, Irene T.',
                'department' => 'HR',
                'leave_type' => 'Personal Leave',
                'start_date' => '2026-02-22',
                'end_date' => '2026-02-22',
                'status' => 'Declined',
                'reason' => 'Personal errand',
            ],
        ])->map(function ($record) {
            $start = Carbon::parse($record['start_date'])->startOfDay();
            $end = Carbon::parse($record['end_date'])->startOfDay();
            $days = $end->gte($start) ? ($start->diffInDays($end) + 1) : 1;
            $record['days'] = $days;
            $record['start_date_carbon'] = $start;
            $record['end_date_carbon'] = $end;
            return $record;
        });
    }

    private function calculateMonthlyEarnedLeaveDays(?Carbon $joinDate, Carbon $monthCursor, ?int $resetCycleMonths = null): int
    {
        if (!$joinDate) {
            return 0;
        }

        $joinMonthStart = $joinDate->copy()->startOfMonth();
        $selectedMonthEnd = $monthCursor->copy()->endOfMonth();
        $todayEnd = now()->endOfDay();
        $accrualCutoff = $selectedMonthEnd->lte($todayEnd) ? $selectedMonthEnd : $todayEnd;

        if ($accrualCutoff->lt($joinDate)) {
            return 0;
        }

        $months = $joinMonthStart->diffInMonths($accrualCutoff->copy()->startOfMonth());

        if ($accrualCutoff->isSameDay($accrualCutoff->copy()->endOfMonth())) {
            $months++;
        }

        $months = max(0, $months);

        if (!is_null($resetCycleMonths) && $resetCycleMonths > 0 && $months > 0) {
            $months = (($months - 1) % $resetCycleMonths) + 1;
        }

        return $months;
    }

    private function calculateCompletedMonthsUntilCutoff(?Carbon $joinDate, Carbon $monthCursor): int
    {
        if (!$joinDate) {
            return 0;
        }

        $joinMonthStart = $joinDate->copy()->startOfMonth();
        $selectedMonthEnd = $monthCursor->copy()->endOfMonth();
        $todayEnd = now()->endOfDay();
        $accrualCutoff = $selectedMonthEnd->lte($todayEnd) ? $selectedMonthEnd : $todayEnd;

        if ($accrualCutoff->lt($joinDate)) {
            return 0;
        }

        $months = $joinMonthStart->diffInMonths($accrualCutoff->copy()->startOfMonth());
        if ($accrualCutoff->isSameDay($accrualCutoff->copy()->endOfMonth())) {
            $months++;
        }

        return max(0, $months);
    }

    private function buildEarnedRangeLabel(?Carbon $joinDate, Carbon $monthCursor, int $resetCycleMonths): string
    {
        if (!$joinDate || $resetCycleMonths <= 0) {
            return '-';
        }

        $completedMonths = $this->calculateCompletedMonthsUntilCutoff($joinDate, $monthCursor);
        if ($completedMonths <= 0) {
            return '-';
        }

        $joinMonthStart = $joinDate->copy()->startOfMonth();
        $monthsInCurrentCycle = (($completedMonths - 1) % $resetCycleMonths) + 1;
        $completedCycleMonths = $completedMonths - $monthsInCurrentCycle;

        $rangeStart = $joinMonthStart->copy()->addMonths($completedCycleMonths)->startOfMonth();
        $rangeEnd = $rangeStart->copy()->addMonths($monthsInCurrentCycle - 1)->startOfMonth();

        if ($rangeStart->year === $rangeEnd->year) {
            if ($rangeStart->format('M') === $rangeEnd->format('M')) {
                return $rangeStart->format('M').', '.$rangeStart->year;
            }

            return $rangeStart->format('M').'-'.$rangeEnd->format('M').', '.$rangeStart->year;
        }

        return $rangeStart->format('M Y').' - '.$rangeEnd->format('M Y');
    }

}
