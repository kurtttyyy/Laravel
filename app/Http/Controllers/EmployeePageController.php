<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeePageController extends Controller
{
    public function display_home(){
        return view('employee.employeeHome');
    }

    public function display_leave(){
        return view('employee.employeeLeave');
    }

    public function display_profile(){
        return view('employee.employeeProfile');
    }
}
