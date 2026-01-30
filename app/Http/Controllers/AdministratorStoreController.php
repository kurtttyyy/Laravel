<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Interviewer;
use App\Models\OpenPosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdministratorStoreController extends Controller
{

    //STORE
    public function store_new_position(Request $request){
        Log::info($request);
        $attrs = $request->validate([
            'title' => 'required',
            'department' => 'required',
            'employment' => 'required',
            'collage_name' => 'required',
            'mode' => 'required',
            'description' => 'required',
            'responsibilities' => 'required',
            'requirements' => 'required',
            // 'min' => 'required',
            // 'max' => 'required',
            'level' => 'required',
            'location' => 'required',
            'skills' => 'required',
            'benefits' => 'required',
            'job_type' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'passionate' => 'required',
        ]);

        $store = OpenPosition::create([
            'title' => $attrs['title'],
            'department' => $attrs['department'],
            'employment' => $attrs['employment'],
            'work_mode' => $attrs['mode'],
            'collage_name' => $attrs['collage_name'],
            'job_description' => $attrs['description'],
            'responsibilities' => $attrs['responsibilities'],
            'requirements' => $attrs['requirements'],
            // 'min_salary' => $attrs['min'],
            // 'max_salary' => $attrs['max'],
            'experience_level' => $attrs['level'],
            'location' => $attrs['location'],
            'skills' => $attrs['skills'],
            'benifits' => $attrs['benefits'],
            'job_type' => $attrs['job_type'],
            'one' => $attrs['start_date'],
            'two' => $attrs['end_date'],
            'passionate' => $attrs['passionate'],
        ]);

        return redirect()->back()->with('success','Success Added Position');
    }

    public function store_interview(Request $request){
        Log::info($request);
        $attrs = $request->validate([
            'applicants_id' => 'required',
            'interview_type' => 'required',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'duration' => 'required',
            'interviewers' => 'required',
            'email_link' => 'required',
            'url' => 'nullable',
            'notes' => 'nullable',
        ]);

        $store = Interviewer::create([
            'applicant_id' => $attrs['applicants_id'],
            'interview_type' => $attrs['interview_type'],
            'date' => $attrs['date'],
            'time' => $attrs['time'],
            'duration' => $attrs['duration'],
            'interviewers' => $attrs['interviewers'],
            'email_link' => $attrs['email_link'],
            'url' => $attrs['url'],
            'notes' => $attrs['notes'],
        ]);

        return redirect()->back()->with('success','Success Added Interview');
    }

    public function store_star_ratings(Request $request){
        $attrs = $request->validate([
            'ratingId' => 'required',
            'rating' => 'required|string',
        ]);

        $review = Applicant::findOrFail($attrs['ratingId']);

        $review->update([
            'starRatings' => $attrs['rating'],
        ]);

        return redirect()->back()->with('success','Success Rating Store');
    }

    //UPDATE
    public function update_position(Request $request, $id){
        Log::info($request);
        $attrs = $request->validate([
            'title' => 'required',
            //'department' => 'required',
            'employment' => 'required',
            'collage_name' => 'required',
            //'mode' => 'required',
            'job_description' => 'required',
            'responsibilities' => 'required',
            'requirements' => 'required',
            // 'min' => 'required',
            // 'max' => 'required',
            'experience_level' => 'required',
            'location' => 'required',
            'skills' => 'required',
            //'benefits' => 'required',
            //'job_type' => 'required',
            'one' => 'required|date',
            'two' => 'required|date',
            'passionate' => 'required',
        ]);

        $open = OpenPosition::findOrFail($id);

        $open->update([
            'title' => $attrs['title'],
            //'department' => $attrs['department'],
            'employment' => $attrs['employment'],
            //'work_mode' => $attrs['mode'],
            'collage_name' => $attrs['collage_name'],
            'job_description' => $attrs['job_description'],
            'responsibilities' => $attrs['responsibilities'],
            'requirements' => $attrs['requirements'],
            // 'min_salary' => $attrs['min'],
            // 'max_salary' => $attrs['max'],
            'experience_level' => $attrs['experience_level'],
            'location' => $attrs['location'],
            'skills' => $attrs['skills'],
            //'benifits' => $attrs['benefits'],
            //'job_type' => $attrs['job_type'],
            'one' => $attrs['one'],
            'two' => $attrs['two'],
            'passionate' => $attrs['passionate'],
        ]);

        return redirect()->back()->with('success','Success Added Position');
    }

    public function update_application_status(Request $request){
        $attrs = $request->validate([
            'reviewId' => 'required',
            'status' => 'required|string',
        ]);

        $review = Applicant::findOrFail($attrs['reviewId']);

        $review->update([
            'application_status' => $attrs['status'],
        ]);

        return redirect()->back()->with('success','Success Update Application Status');
    }

    public function updated_interview(Request $request){
        Log::info($request);
        $attrs = $request->validate([
            'interviewId' => 'required',
            'applicantId' => 'required',
            'interview_type' => 'required',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i:s',
            'duration' => 'required',
            'interviewers' => 'required',
            'email_link' => 'required',
            'url' => 'nullable',
            'notes' => 'nullable',
        ]);

        $interview = Interviewer::findOrFail($attrs['interviewId']);

        $interview->update([
            'applicant_id' => $attrs['applicantId'],
            'interview_type' => $attrs['interview_type'],
            'date' => $attrs['date'],
            'time' => $attrs['time'],
            'duration' => $attrs['duration'],
            'interviewers' => $attrs['interviewers'],
            'email_link' => $attrs['email_link'],
            'url' => $attrs['url'],
            'notes' => $attrs['notes'],
        ]);

        return redirect()->back()->with('success','Success Added Interview');
    }


    //DELETE
    public function destroy_position($id){
        $delete = OpenPosition::findOrFail($id);

        $delete->delete();

        return redirect()->route('admin.adminPosition')->with('success','Successfully deleted Position');

    }


}
