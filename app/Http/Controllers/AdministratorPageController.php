<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\GuestLog;
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
        return view('admin.adminApplicant');
    }

    public function display_edit_position(){
        return view('admin.adminEditPosition');
    }

    public function display_interview(){
        return view('admin.adminInterview');
    }

    public function display_meeting(){
        return view('admin.adminMeeting');
    }

    public function display_position(){
        $openPosition = OpenPosition::all();
        $titles = OpenPosition::pluck('title');
        $countApplication = Applicant::whereIn('applied_position', $titles)->count();
        $logs = GuestLog::count();
        $positionCounts = $openPosition->count();
        $applicantCounts = Applicant::count();
        return view('admin.adminPosition', compact('openPosition',
        'logs', 'positionCounts', 'applicantCounts','countApplication'));
    }

    public function display_show_position(){
        return view('admin.adminShowPosition');
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

