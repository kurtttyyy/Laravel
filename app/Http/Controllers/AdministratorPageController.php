<?php

namespace App\Http\Controllers;

use App\Models\AttendanceUpload;
use App\Models\AttendanceRecord;
use App\Models\Applicant;
use App\Models\GuestLog;
use App\Models\Interviewer;
use App\Models\OpenPosition;
use App\Models\User;
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

    private function buildAttendanceView(Request $request, string $activeAttendanceTab = 'all'){
        $fromDate = $request->query('from_date');
        $selectedUploadId = $request->query('upload_id');

        $attendanceFiles = AttendanceUpload::query()
            ->when($fromDate, function ($query) use ($fromDate) {
                $query->whereDate('uploaded_at', '>=', $fromDate);
            })
            ->orderByDesc('uploaded_at')
            ->orderByDesc('id')
            ->get();

        if (!$selectedUploadId) {
            $selectedUploadId = optional($attendanceFiles->first())->id;
        }

        $records = collect();
        if ($selectedUploadId) {
            $records = AttendanceRecord::query()
                ->where('attendance_upload_id', $selectedUploadId)
                ->orderBy('employee_id')
                ->get();
        }

        $presentEmployees = $records->where('is_absent', false)->where('late_minutes', 0)->values();
        $absentEmployees = $records->where('is_absent', true)->values();
        $tardyEmployees = $records->where('late_minutes', '>', 0)->values();

        $presentCount = $presentEmployees->count();
        $absentCount = $absentEmployees->count();
        $tardyCount = $tardyEmployees->count();
        $totalCount = $records->count();

        return view('admin.adminAttendance', compact(
            'attendanceFiles',
            'fromDate',
            'selectedUploadId',
            'activeAttendanceTab',
            'presentEmployees',
            'absentEmployees',
            'tardyEmployees',
            'presentCount',
            'absentCount',
            'tardyCount',
            'totalCount'
        ));
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
