<?php

use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\EmployeePageController;
use App\Http\Controllers\GuestPageController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterLoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('guest.index');
});

Route::controller(PageController::class)->group(function () {
    Route::get('/login', 'display_login')->name('login_display');
    Route::get('/register', 'display_register')->name('register');
});

Route::controller(GuestPageController::class)->group(function () {
    Route::get('/application', 'display_application')->name('guest.application');
    Route::get('/application/procedure', 'display_steps')->name('guest.applicationSteps');
    Route::get('/index', 'display_index')->name('guest.index');
    Route::get('/job/available', 'display_job')->name('guest.jobOpen');
});

Route::controller(ApplicantController::class)->group(function () {
    Route::post('applicant/store', 'applicant_stores')->name('applicant.store');
});

Route::controller(RegisterLoginController::class)->group(function () {
    Route::post('register/store', 'register_store')->name('register.store');
    Route::post('login', 'login_store')->name('login');
});

Route::controller(EmployeePageController::class)->group(function () {
    Route::get('employee/dashboard', 'display_home')->name('employee.employeeHome');
    Route::get('employee/leave', 'display_leave')->name('employee.employeeLeave');
    Route::get('employee/profile', 'display_profile')->name('employee.employeeProfile');
    Route::get('employee/communication', 'display_communication')->name('employee.employeeCommunication');
    Route::get('employee/document', 'display_document')->name('employee.employeeDocument');
    Route::get('employee/payslip', 'display_payslip')->name('employee.employeePayslip');
});


