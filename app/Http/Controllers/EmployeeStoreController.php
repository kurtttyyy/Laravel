<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\ApplicantDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EmployeeStoreController extends Controller
{
    public function upload_store(Request $request){
        Log::info($request->all());
        $attrs = $request->validate([
            'document_name' => 'required|string|max:255',
            'uploadFile' => 'required|file|mimes:pdf,xlsx,doc,docx|max:5120',
        ]);

        $user = Auth::id();

        $applicant = Applicant::where('user_id', $user)
                                    ->where('application_status', 'Hired')->first();

        if (!$applicant) {
            return redirect()->back()->with('error', 'No hired applicant record found.');
        }

        $file = $request->file('uploadFile');

        if (!$file || !$file->isValid()) {
            return back()->withErrors(['uploadFile' => 'Invalid file upload.']);
        }

        $originalName = $file->getClientOriginalName();
        $mimeType     = $file->getMimeType();
        $size         = $file->getSize();

        $fileName = time() . '_' . $originalName;

        // Store file
        $filePath = $file->storeAs('uploads', $fileName, 'public');

        ApplicantDocument::create([
            'applicant_id' => $applicant->id,
            'type'         => $attrs['document_name'],
            'filename'     => $originalName,
            'filepath'     => $filePath, // already "uploads/filename"
            'mime_type'    => $mimeType,
            'size'         => $size,
        ]);

        return back()->with('success', 'Document uploaded successfully.');
    }
}
