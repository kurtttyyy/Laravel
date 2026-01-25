<?php

namespace App\Http\Controllers;

use App\Models\OpenPosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GuestPageController extends Controller
{
    public function display_application(){
        return view('guest.application');
    }

    public function display_steps(){
        return view('guest.applicationSteps');
    }

    public function display_index(){
        $open_position = OpenPosition::all();
        return view('guest.index', compact('open_position'));
    }

    public function display_job(){
        return view('guest.jobOpen');
    }
}
