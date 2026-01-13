<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('jobOpen');
});

Route::get('/index', function () {
    return view('jobOpen');
});

Route::get('/application', function () {
    return view('application');
});

Route::get('/jobOpen', function () {
    return view('jobOpen');
});