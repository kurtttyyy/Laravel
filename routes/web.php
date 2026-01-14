<?php

use App\Http\Controllers\GuestPageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('guest.index');
});

Route::controller(GuestPageController::class)->group(function () {
    Route::get('/application', 'display_application')->name('guest.application');
    Route::get('/application/procedure', 'display_steps')->name('guest.applicationSteps');
    Route::get('/index', 'display_index')->name('guest.index');
    Route::get('/job/available', 'display_job')->name('guest.jobOpen');
});
