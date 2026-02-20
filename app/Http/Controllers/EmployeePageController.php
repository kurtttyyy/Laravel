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

        $leaveRecords = $this->getSharedLeaveRecords();
        $approvedRecords = $leaveRecords
            ->filter(fn ($record) => strtolower((string) ($record['status'] ?? '')) === 'approved')
            ->values();

        $employeeApprovedRecords = $approvedRecords
            ->filter(function ($record) use ($employeeDisplayName, $user) {
                $recordName = strtolower(trim((string) ($record['employee_name'] ?? '')));
                $targetName = strtolower(trim((string) ($employeeDisplayName ?? '')));

                if ($recordName !== '' && $targetName !== '' && $recordName === $targetName) {
                    return true;
                }

                $rawName = strtolower(trim(implode(' ', array_filter([
                    $user?->first_name,
                    $user?->middle_name,
                    $user?->last_name,
                ]))));

                return $rawName !== '' && $recordName !== '' && str_contains($recordName, $rawName);
            })
            ->values();

        $employeeMonthRecords = $employeeApprovedRecords
            ->filter(function ($record) use ($monthCursor) {
                $start = $record['start_date_carbon'];
                $end = $record['end_date_carbon'];
                return $start->format('Y-m') === $monthCursor->format('Y-m')
                    || $end->format('Y-m') === $monthCursor->format('Y-m')
                    || ($start->lt($monthCursor->copy()->startOfMonth()) && $end->gt($monthCursor->copy()->endOfMonth()));
            })
            ->values();

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

        $monthAppliedTotal = (float) LeaveApplication::query()
            ->where('user_id', $user?->id)
            ->whereBetween('created_at', [$monthStart->toDateTimeString(), $monthEnd->toDateTimeString()])
            ->sum('applied_total');

        if ($latestLeaveApplication) {
            $annualLimit = round((float) ($latestLeaveApplication->beginning_vacation ?? 0) + (float) ($latestLeaveApplication->earned_vacation ?? 0), 1);
            $annualUsed = round((float) ($latestLeaveApplication->applied_vacation ?? 0), 1);
            $sickLimit = round((float) ($latestLeaveApplication->beginning_sick ?? 0) + (float) ($latestLeaveApplication->earned_sick ?? 0), 1);
            $sickUsed = round((float) ($latestLeaveApplication->applied_sick ?? 0), 1);
            $vacationCardAvailable = round((float) ($latestLeaveApplication->ending_vacation ?? 0), 1);
            $sickCardAvailable = round((float) ($latestLeaveApplication->ending_sick ?? 0), 1);
            $totalDaysUsedCard = round($monthAppliedTotal > 0 ? $monthAppliedTotal : (float) ($latestLeaveApplication->applied_total ?? $totalDaysUsed), 1);
        }

        return view('employee.employeeLeave', compact(
            'selectedMonth',
            'employeeDisplayName',
            'employeeMonthRecords',
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
                                ->where('application_status','Hired')->first();
        $documents = ApplicantDocument::where('applicant_id', $applicant->id)->get();
        return view('employee.employeeDocument', compact('documents'));
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

