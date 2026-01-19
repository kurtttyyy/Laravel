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

    public function display_payslip(){
        return view('employee.employeePayslip');
    }

    public function display_document(){
        return view('employee.employeeDocument');
    }

    public function display_communication(){
        return view('employee.employeeCommunication');
    }
}
