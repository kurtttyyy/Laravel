<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\ApplicantDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ApplicantController extends Controller
{
    public function applicant_stores(Request $request){
        $attrs = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'education' => 'required|string',
            'field_study' => 'required|string',
            'position' => 'required|string',
            'experience_years' => 'required|string',
            'key_skills' => 'required|string',
            'documents' => 'required|array',
            'documents.*.file' => 'required|file|mimes:pdf,doc,docx|max:5120',
            'documents.*.type' => 'required',
        ]);

        $applicant_store = Applicant::create([
            'first_name' => $attrs['first_name'],
            'last_name' => $attrs['last_name'],
            'email' => $attrs['email'],
            'phone' => $attrs['phone'],
            'address' => $attrs['address'],
            'education_attainment' => $attrs['education'],
            'field_study' => $attrs['field_study'],
            'experience' => $attrs['experience_years'],
            'skills_n_expertise' => $attrs['key_skills'],
            'applied_position' => $attrs['position'],
        ]);


        DB::transaction(function () use ($request, $applicant_store, &$filePaths) {

            foreach ($request->documents as $doc) {

                $file = $doc['file'];
                $type = $doc['type'];

                if ($file->isValid()) {

                    $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();

                    $file->storeAs('uploads', $fileName, 'public');

                    ApplicantDocument::create([
                        'applicant_id' => $applicant_store->id,
                        'type'         => $type,
                        'filename'     => $file->getClientOriginalName(),
                        'filepath'     => 'uploads/' . $fileName,
                        'mime_type'    => $file->getMimeType(),
                        'size'         => $file->getSize(),
                    ]);

                    $filePaths[] = 'uploads/' . $fileName;
                }
            }
        });

        return redirect()->back()->with('success', 'Submitted successfully');
    }

    public function display_application(Request $request){
        $attrs = $request->validate([
            'email' => 'required|email',
        ]);

        if (!Applicant::where('email', $attrs['email'])->exists()) {
            return redirect('/');
        }

        $applicants = Applicant::where('email', $attrs['email'])->get();


        return view('guest.Application', compact('applicants'));
    }
}
