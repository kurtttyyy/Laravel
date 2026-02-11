<?php

namespace App\Http\Controllers;

use App\Events\GuestLog;
use App\Models\Applicant;
use App\Models\OpenPosition;
use App\Models\User;
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
        $applicantEmail = session('applicant_email');
        $appliedPositionIds = collect();

        if ($applicantEmail) {
            $appliedPositionIds = Applicant::where('email', $applicantEmail)
                ->pluck('open_position_id');
        }

        $open_position = OpenPosition::when($appliedPositionIds->isNotEmpty(), function ($query) use ($appliedPositionIds) {
            $query->whereNotIn('id', $appliedPositionIds);
        })->get();
        $openCount = $open_position->count();
        $department = $open_position->groupBy('department')->count();
        $employee = User::where('role', 'Employee')->count();
        event(new GuestLog('Viewed'));
        return view('guest.index', compact('open_position','openCount','department','employee'));
    }

    public function job_open_landing(){
        $applicantEmail = session('applicant_email');
        $appliedPositionIds = collect();

        if ($applicantEmail) {
            $appliedPositionIds = Applicant::where('email', $applicantEmail)
                ->pluck('open_position_id');
        }

        $firstAvailableJob = OpenPosition::when($appliedPositionIds->isNotEmpty(), function ($query) use ($appliedPositionIds) {
            $query->whereNotIn('id', $appliedPositionIds);
        })->first();

        if (!$firstAvailableJob) {
            return redirect()->route('guest.index')
                ->with('error', 'No available job positions at the moment.');
        }

        return redirect()->route('guest.jobOpen', ['id' => $firstAvailableJob->id]);
    }

    public function display_job($id){
        $job = OpenPosition::findOrFail($id);

        $applicantEmail = session('applicant_email');
        $appliedPositionIds = collect();

        if ($applicantEmail) {
            $appliedPositionIds = Applicant::where('email', $applicantEmail)
                ->pluck('open_position_id');
        }

        if ($appliedPositionIds->contains($job->id)) {
            return redirect()->route('guest.index')
                ->with('error', 'You already applied for that position.');
        }

        $other = OpenPosition::where('id', '!=', $job->id)
            ->when($appliedPositionIds->isNotEmpty(), function ($query) use ($appliedPositionIds) {
                $query->whereNotIn('id', $appliedPositionIds);
            })
            ->get();

        $jobOpen = OpenPosition::when($appliedPositionIds->isNotEmpty(), function ($query) use ($appliedPositionIds) {
            $query->whereNotIn('id', $appliedPositionIds);
        })->get();

        return view('guest.jobOpen', compact('jobOpen','job','other'));
    }
}
