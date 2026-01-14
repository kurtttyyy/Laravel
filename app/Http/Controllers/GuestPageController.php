<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestPageController extends Controller
{
    public function display_application(){
        return view('guest.application');
    }

    public function display_steps(){
        return view('guest.applicationSteps');
    }

    public function display_index(){
        return view('guest.index');
    }

    public function display_job(){
        return view('guest.jobOpen');
    }
}
