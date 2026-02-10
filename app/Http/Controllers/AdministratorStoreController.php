<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\ApplicantDocument;
use App\Models\Education;
use App\Models\Employee;
use App\Models\Government;
use App\Models\Interviewer;
use App\Models\License;
use App\Models\OpenPosition;
use App\Models\Salary;
use App\Models\User;
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

    public function store_document(Request $request){
        Log::info($request);
        $attrs = $request->validate([
            'applicant_id' => 'required|exists:applicants,id',
            'documents' => 'required|file|mimes:pdf,doc,docx|max:5120',
        ]);

        $file = $request->file('documents');

        if (!$file || !$file->isValid()) {
            return back()->withErrors(['documents' => 'Invalid file upload.']);
        }

        $originalName = $file->getClientOriginalName();
        $mimeType     = $file->getMimeType();
        $size         = $file->getSize();

        $fileName = time() . '_' . $originalName;

        // Store file
        $filePath = $file->storeAs('uploads', $fileName, 'public');

        ApplicantDocument::create([
            'applicant_id' => $attrs['applicant_id'],
            'type'         => 'New File',
            'filename'     => $originalName,
            'filepath'     => $filePath, // already "uploads/filename"
            'mime_type'    => $mimeType,
            'size'         => $size,
        ]);

        return back()->with('success', 'Document uploaded successfully.');

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

        return redirect()->route('admin.adminPosition')->with('success','Success Added Position');
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

    public function update_employee($id){


        $open = User::findOrFail($id);

        $open->update([
            'status' => 'Approved',
        ]);

        return redirect()->back()->with('success','Employee can now login');
    }

    public function update_bio(Request $request){
        Log::info($request);
        $attrs = $request->validate([
            //User Model
            'user_id' => 'required|exists:users,id',
            'first' => 'required',
            'middle' => 'required',
            'last' => 'required',

            //Employee Model
            'employee_id' => 'required',
            'account_number' => 'required',
            'gender' => 'required',
            'civil_status' => 'required',
            'contact_number' => 'required',
            'birthday' => 'required|date',
            'address' => 'required',
            'employment_date' => 'required|date',
            'position' => 'required',
            'department' => 'required',
            'classification' => 'required',

            //Government Model
            'SSS' => 'required',
            'TIN' => 'required',
            'PhilHealth' => 'required',
            'MID' => 'required',
            'RTN' => 'required',

            //License Model
            'license' => 'required',
            'registration_number' => 'required',
            'registration_date' => 'required',
            'valid_until' => 'required',

            //Education Model
            'bachelor' => 'required',
            'master' => 'required',
            'doctorate' => 'required',

            //Salary Model
            'salary' => 'required',
            'rate_per_hour' => 'required',
            'cola' => 'required',
        ]);

        $user = User::findOrFail($attrs['user_id']);

        $user->update([
            //'' => $attrs[''],
            'first_name' => $attrs['first'],
            'middle_name' => $attrs['middle'],
            'last_name' => $attrs['last'],
        ]);

        Employee::updateOrCreate(
            // 1️⃣ Condition to find the record
            ['user_id' => $attrs['user_id']],

            // 2️⃣ Values to create or update
            [
                'user_id' => $attrs['user_id'],
                'employee_id' => $attrs['employee_id'],
                'employement_date' => $attrs['employment_date'],
                'birthday' => $attrs['birthday'],
                'account_number' => $attrs['account_number'],
                'sex' => $attrs['gender'],
                'civil_status' => $attrs['civil_status'],
                'contact_number' => $attrs['contact_number'],
                'address' => $attrs['address'],
                'department' => $attrs['department'],
                'position' => $attrs['position'],
                'classification' => $attrs['classification'],
            ]
        );

        Government::updateOrCreate(
            // 1️⃣ Condition to find the record
            ['user_id' => $attrs['user_id']],

            // 2️⃣ Values to create or update
            [
                'SSS' => $attrs['SSS'],
                'TIN' => $attrs['TIN'],
                'PhilHealth' => $attrs['PhilHealth'],
                'RTN' => $attrs['RTN'],
                'MID' => $attrs['MID'],
            ]
        );

        License::updateOrCreate(
            // 1️⃣ Condition to find the record
            ['user_id' => $attrs['user_id']],

            // 2️⃣ Values to create or update
            [
                'license' => $attrs['license'],
                'registration_number' => $attrs['registration_number'],
                'registration_date' => $attrs['registration_date'],
                'valid_until' => $attrs['valid_until'],
            ]
        );

        Education::updateOrCreate(
            // 1️⃣ Condition to find the record
            ['user_id' => $attrs['user_id']],

            // 2️⃣ Values to create or update
            [
                'bachelor' => $attrs['bachelor'],
                'master' => $attrs['master'],
                'doctorate' => $attrs['doctorate'],
            ]
        );

        Salary::updateOrCreate(
            // 1️⃣ Condition to find the record
            ['user_id' => $attrs['user_id']],

            // 2️⃣ Values to create or update
            [
                'salary' => $attrs['salary'],
                'rate_per_hour' => $attrs['rate_per_hour'],
                'cola' => $attrs['cola'],
            ]
        );

        return redirect()->back()->with('success', 'Save Successfully');
    }


    //DELETE
    public function destroy_position($id){
        $delete = OpenPosition::findOrFail($id);

        $delete->delete();

        return redirect()->route('admin.adminPosition')->with('success','Successfully deleted Position');

    }

    public function destroy_interview($id){
        $delete = Interviewer::where('applicant_id', $id)->first();
        $delete->delete();
        return redirect()->route('admin.adminPosition')->with('success','Successfully deleted Position');

    }

    public function destroy_employee($id){


        $open = User::findOrFail($id);

        $open->update([
            'status' => 'Not Approved',
        ]);

        return redirect()->back()->with('success','Employee not Approve');
    }


}
