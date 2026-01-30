<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\GuestLog;
use App\Models\Interviewer;
use App\Models\OpenPosition;
use Illuminate\Http\Request;

class AdministratorPageController extends Controller
{

    public function display_home(){
        return view('admin.adminHome');
    }

    public function display_employee(){
        return view('admin.adminEmployee');
    }

    public function display_attendance(){
        return view('admin.adminAttendance');
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
        )->get();
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
        $interview = Interviewer::with('applicants')->get();

        $count_daily = Interviewer::whereDate('date', today())
                                    ->whereTime('time', '<', now())
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

    public function display_meeting(){
        return view('admin.adminMeeting');
    }

    public function display_position(){
        $openPosition = OpenPosition::all();
        $titles = OpenPosition::pluck('id');
        $countApplication = Applicant::whereIn('open_position_id', $titles)->count();
        $logs = GuestLog::count();
        $positionCounts = $openPosition->count();
        $applicantCounts = Applicant::count();
        return view('admin.adminPosition', compact('openPosition',
        'logs', 'positionCounts', 'applicantCounts','countApplication'));
    }

    public function display_show_position($id){
        $open = OpenPosition::findOrFail($id);
        $titles = OpenPosition::pluck('id');
        $countApplication = Applicant::whereIn('open_position_id', $titles)->count();
        return view('admin.adminShowPosition', compact('open','countApplication'));
    }

    public function display_overview(){
        return view('admin.adminEmployeeOverview');
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

