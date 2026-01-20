<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdministratorPageController extends Controller
{
    public function display_home(){
        return view('admin.adminHome');
    }

    public function display_employee(){
        return view('admin.adminEmployee');
    }

    public function display_documents(){
        return view('admin.adminEmployeeDocuments');
    }

    public function display_pd(){
        return view('admin.adminEmployeePD');
    }

    public function display_overview(){
        return view('admin.adminEmployeeOverview');
    }

    public function display_performance(){
        return view('admin.adminEmployeePerformance');
    }
}
