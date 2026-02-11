<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeePageController extends Controller
{
    public function display_home(){
        $user = Auth::user();
        return view('employee.employeeHome', compact('user'));
    }

    public function display_leave(){
        return view('employee.employeeLeave');
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
        return view('employee.employeeDocument');
    }

    public function display_communication(){
        return view('employee.employeeCommunication');
    }
}
