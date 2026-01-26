<?php

namespace App\Http\Controllers;

use App\Events\GuestLog;
use App\Models\OpenPosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GuestPageController extends Controller
{
    public function display_application(){
        return view('guest.Application', [
                    'applicants' => collect(), // avoid undefined variable
                ]);
    }

    public function display_non_teaching($id){
        $openPosition = OpenPosition::findOrFail($id);
        return view('guest.applicationNonTeachingSteps', compact('openPosition'));
    }

    public function display_teaching(){
        return view('guest.applicationTeachingSteps');
    }

    public function display_index(){
        $open_position = OpenPosition::all();
        event(new GuestLog('Viewed'));
        return view('guest.index', compact('open_position'));
    }

    public function display_job($id){
        $job = OpenPosition::find($id);
        $jobOpen = OpenPosition::where('department', $job->department)->get();

        return view('guest.jobOpen', compact('jobOpen'));
    }
}
