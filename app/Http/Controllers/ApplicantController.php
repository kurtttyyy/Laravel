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
public function applicant_store(Request $request)
{
    $request->validate([
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'email' => 'required|email',
        'phone' => 'required|string',
        'address' => 'required|string',
        'education' => 'required|string',
        'field_study' => 'required|string',
        'experience_years' => 'required|string',
        'key_skills' => 'required|string',
        'documents' => 'required|array',
        'documents.*.file' => 'required|file|mimes:pdf,doc,docx|max:5120',
        'documents.*.type' => 'required|string',
    ]);

    $applicant = Applicant::create([
        'first_name'           => $request->first_name,
        'last_name'            => $request->last_name,
        'email'                => $request->email,
        'phone'                => $request->phone,
        'address'              => $request->address,
        'education_attainment' => $request->education,
        'field_study'          => $request->field_study,
        'experience'           => $request->experience_years,
        'skills_n_expertise'   => $request->key_skills,
        'application_status'   => 'pending',
    ]);

    foreach ($request->documents as $doc) {
        $file = $doc['file'];

        $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('uploads', $fileName, 'public');

        ApplicantDocument::create([
            'applicant_id' => $applicant->id,
            'type'         => $doc['type'],
            'filename'     => $file->getClientOriginalName(),
            'filepath'     => 'uploads/' . $fileName,
            'mime_type'    => $file->getMimeType(),
            'size'         => $file->getSize(),
        ]);
    }

    return redirect()->back()->with('success', 'Submitted successfully');
}

}
