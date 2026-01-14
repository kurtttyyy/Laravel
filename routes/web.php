<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('applicationSteps');
});

Route::get('/index', function () {
    return view('applicationSteps');
});

Route::get('/application', function () {
    return view('application');
});

Route::get('/jobOpen', function () {
    return view('jobOpen');
});

Route::get('/ApplicationSteps', function () {
    return view('applicationSteps');
});