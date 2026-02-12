<?php

namespace App\Http\Controllers;

use App\Models\AttendanceUpload;
use App\Models\AttendanceRecord;
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
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
            'document_name' => 'required|string|max:255',
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
            'type'         => $attrs['document_name'],
            'filename'     => $originalName,
            'filepath'     => $filePath, // already "uploads/filename"
            'mime_type'    => $mimeType,
            'size'         => $size,
        ]);

        return back()->with('success', 'Document uploaded successfully.');

    }

    public function store_attendance_excel(Request $request){
        $attrs = $request->validate([
            'excel_file' => 'required|file|mimes:xls,xlsx|max:10240',
        ]);

        $file = $request->file('excel_file');

        if (!$file || !$file->isValid()) {
            return back()->withErrors(['excel_file' => 'Invalid file upload.']);
        }

        $originalName = $file->getClientOriginalName();
        $fileName = time().'_'.$originalName;
        $filePath = $file->storeAs('attendance_excels', $fileName, 'public');

        $upload = AttendanceUpload::create([
            'original_name' => $originalName,
            'file_path' => $filePath,
            'file_size' => $file->getSize(),
            'status' => 'Processing',
            'uploaded_at' => now(),
        ]);

        try {
            $absolutePath = Storage::disk('public')->path($filePath);
            $rows = $this->extractRowsFromExcel($absolutePath, $file->getClientOriginalExtension());
            $records = $this->buildAttendanceRecords($rows, $upload->id);

            DB::transaction(function () use ($upload, $records) {
                AttendanceRecord::where('attendance_upload_id', $upload->id)->delete();

                if (!empty($records)) {
                    AttendanceRecord::insert($records);
                }

                $upload->update([
                    'status' => 'Processed',
                    'processed_rows' => count($records),
                ]);
            });

            return back()->with('success', 'Excel file uploaded and analyzed successfully.');
        } catch (\Throwable $e) {
            Log::error('Attendance excel parse failed', [
                'upload_id' => $upload->id,
                'error' => $e->getMessage(),
            ]);

            $upload->update([
                'status' => 'Failed',
                'processed_rows' => 0,
            ]);

            return back()->withErrors([
                'excel_file' => 'Upload saved but parsing failed. Use .xlsx format with employee ID and AM/PM time columns.',
            ]);
        }
    }

    private function extractRowsFromExcel(string $absolutePath, string $extension): array
    {
        $extension = strtolower($extension);

        if ($extension !== 'xlsx') {
            throw new \RuntimeException('Only .xlsx files are currently supported for attendance analysis.');
        }

        return $this->extractRowsFromXlsx($absolutePath);
    }

    private function extractRowsFromXlsx(string $absolutePath): array
    {
        $zip = new \ZipArchive();
        if ($zip->open($absolutePath) !== true) {
            throw new \RuntimeException('Unable to open xlsx file.');
        }

        $sharedStrings = [];
        $sharedStringsXml = $zip->getFromName('xl/sharedStrings.xml');
        if ($sharedStringsXml !== false) {
            $xml = simplexml_load_string($sharedStringsXml);
            if ($xml && isset($xml->si)) {
                foreach ($xml->si as $item) {
                    $sharedStrings[] = trim((string) $item->t);
                }
            }
        }

        $sheetXml = $zip->getFromName('xl/worksheets/sheet1.xml');
        if ($sheetXml === false) {
            $zip->close();
            throw new \RuntimeException('No worksheet found in xlsx.');
        }

        $sheet = simplexml_load_string($sheetXml);
        if (!$sheet || !isset($sheet->sheetData->row)) {
            $zip->close();
            throw new \RuntimeException('Invalid worksheet data.');
        }

        $rows = [];
        foreach ($sheet->sheetData->row as $row) {
            $rowData = [];
            foreach ($row->c as $cell) {
                $reference = (string) $cell['r'];
                $column = preg_replace('/\d+/', '', $reference);
                $type = (string) $cell['t'];
                $value = null;

                if ($type === 's') {
                    $index = (int) ($cell->v ?? 0);
                    $value = $sharedStrings[$index] ?? null;
                } elseif ($type === 'inlineStr') {
                    $value = trim((string) ($cell->is->t ?? ''));
                } else {
                    $value = isset($cell->v) ? trim((string) $cell->v) : null;
                }

                if ($column !== '' && $value !== null && $value !== '') {
                    $rowData[$column] = $value;
                }
            }

            if (!empty($rowData)) {
                $rows[] = $rowData;
            }
        }

        $zip->close();

        if (count($rows) < 2) {
            return [];
        }

        $headerRow = array_shift($rows);
        $headers = [];
        foreach ($headerRow as $column => $headerText) {
            $headers[$column] = $this->normalizeHeader((string) $headerText);
        }

        $mapped = [];
        foreach ($rows as $row) {
            $item = [];
            foreach ($headers as $column => $header) {
                if ($header === '') {
                    continue;
                }
                $item[$header] = $row[$column] ?? null;
            }

            if (!empty(array_filter($item, fn ($value) => $value !== null && $value !== ''))) {
                $mapped[] = $item;
            }
        }

        return $mapped;
    }

    private function buildAttendanceRecords(array $rows, int $uploadId): array
    {
        $records = [];
        $now = now();

        foreach ($rows as $row) {
            $employeeId = $this->pickValue($row, [
                'employee_id', 'employeeid', 'id_no', 'idno', 'emp_id', 'empid',
            ]);

            if (!$employeeId) {
                continue;
            }

            $attendanceDateRaw = $this->pickValue($row, ['date', 'attendance_date']);
            $morningInRaw = $this->pickValue($row, ['morning_in', 'am_in', 'time_in_am', 'morning_time_in', 'in_am']);
            $morningOutRaw = $this->pickValue($row, ['morning_out', 'am_out', 'time_out_am', 'morning_time_out', 'out_am']);
            $afternoonInRaw = $this->pickValue($row, ['afternoon_in', 'pm_in', 'time_in_pm', 'afternoon_time_in', 'in_pm']);
            $afternoonOutRaw = $this->pickValue($row, ['afternoon_out', 'pm_out', 'time_out_pm', 'afternoon_time_out', 'out_pm']);

            $attendanceDate = $this->normalizeDate($attendanceDateRaw);
            $morningIn = $this->normalizeTime($morningInRaw);
            $morningOut = $this->normalizeTime($morningOutRaw);
            $afternoonIn = $this->normalizeTime($afternoonInRaw);
            $afternoonOut = $this->normalizeTime($afternoonOutRaw);

            $missing = [];
            if (!$morningIn) {
                $missing[] = 'morning_in';
            }
            if (!$morningOut) {
                $missing[] = 'morning_out';
            }
            if (!$afternoonIn) {
                $missing[] = 'afternoon_in';
            }
            if (!$afternoonOut) {
                $missing[] = 'afternoon_out';
            }

            $lateMinutes = $this->calculateLateMinutes($morningIn, $afternoonIn);
            $isAbsent = !empty($missing);
            $isTardy = $lateMinutes > 0;

            $records[] = [
                'attendance_upload_id' => $uploadId,
                'employee_id' => (string) $employeeId,
                'attendance_date' => $attendanceDate,
                'morning_in' => $morningIn,
                'morning_out' => $morningOut,
                'afternoon_in' => $afternoonIn,
                'afternoon_out' => $afternoonOut,
                'late_minutes' => $lateMinutes,
                'missing_time_logs' => !empty($missing) ? json_encode($missing) : null,
                'is_absent' => $isAbsent,
                'is_tardy' => $isTardy,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        return $records;
    }

    private function pickValue(array $row, array $keys): ?string
    {
        foreach ($keys as $key) {
            if (array_key_exists($key, $row) && $row[$key] !== null && $row[$key] !== '') {
                return (string) $row[$key];
            }
        }

        return null;
    }

    private function normalizeHeader(string $value): string
    {
        $normalized = strtolower(trim($value));
        $normalized = str_replace(['(', ')', '.', '-', '/'], ' ', $normalized);
        $normalized = preg_replace('/\s+/', '_', $normalized);

        return $normalized;
    }

    private function normalizeDate(?string $value): ?string
    {
        if (!$value) {
            return null;
        }

        if (is_numeric($value)) {
            $serial = (float) $value;
            $datePart = (int) floor($serial);
            if ($datePart > 0) {
                return Carbon::create(1899, 12, 30)->addDays($datePart)->toDateString();
            }
        }

        $formats = ['Y-m-d', 'm/d/Y', 'd/m/Y', 'm-d-Y', 'd-m-Y'];
        foreach ($formats as $format) {
            try {
                return Carbon::createFromFormat($format, trim($value))->toDateString();
            } catch (\Throwable $e) {
            }
        }

        try {
            return Carbon::parse($value)->toDateString();
        } catch (\Throwable $e) {
            return null;
        }
    }

    private function normalizeTime(?string $value): ?string
    {
        if (!$value) {
            return null;
        }

        if (is_numeric($value)) {
            $numeric = (float) $value;
            $fraction = $numeric > 1 ? $numeric - floor($numeric) : $numeric;
            if ($fraction >= 0 && $fraction < 1) {
                $seconds = (int) round($fraction * 86400);
                $hours = intdiv($seconds, 3600);
                $minutes = intdiv($seconds % 3600, 60);
                return sprintf('%02d:%02d:00', $hours, $minutes);
            }
        }

        $formats = ['H:i', 'H:i:s', 'g:i A', 'g:iA', 'h:i A', 'h:iA'];
        foreach ($formats as $format) {
            try {
                return Carbon::createFromFormat($format, trim($value))->format('H:i:s');
            } catch (\Throwable $e) {
            }
        }

        try {
            return Carbon::parse($value)->format('H:i:s');
        } catch (\Throwable $e) {
            return null;
        }
    }

    private function calculateLateMinutes(?string $morningIn, ?string $afternoonIn): int
    {
        $late = 0;

        if ($morningIn) {
            $morningActual = Carbon::createFromFormat('H:i:s', $morningIn);
            $morningExpected = Carbon::createFromFormat('H:i:s', '08:00:00');
            if ($morningActual->greaterThan($morningExpected)) {
                $late += $morningExpected->diffInMinutes($morningActual);
            }
        }

        if ($afternoonIn) {
            $afternoonActual = Carbon::createFromFormat('H:i:s', $afternoonIn);
            $afternoonExpected = Carbon::createFromFormat('H:i:s', '13:00:00');
            if ($afternoonActual->greaterThan($afternoonExpected)) {
                $late += $afternoonExpected->diffInMinutes($afternoonActual);
            }
        }

        return $late;
    }

    //UPDATE
    public function update_position(Request $request, $id){
        Log::info($request);
        $attrs = $request->validate([
            'title' => 'required',
            'department' => 'required',
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
            'department' => $attrs['department'],
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
            'time' => 'required|date_format:H:i,H:i:s',
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

    public function update_general_profile(Request $request){
        $attrs = $request->validate([
            'user_id' => 'required|exists:users,id',
            'first' => 'required|string|max:255',
            'middle' => 'nullable|string|max:255',
            'last' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email,'.$request->input('user_id'),
            'employee_id' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:50',
            'contact_number' => 'nullable|string|max:255',
            'birthday' => 'nullable|date',
            'position' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'barangay' => 'nullable|string|max:255',
            'municipality' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:255',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_relationship' => 'nullable|string|max:255',
            'emergency_contact_number' => 'nullable|string|max:255',
            'SSS' => 'nullable|string|max:255',
            'TIN' => 'nullable|string|max:255',
            'PhilHealth' => 'nullable|string|max:255',
            'MID' => 'nullable|string|max:255',
            'RTN' => 'nullable|string|max:255',
        ]);

        $user = User::findOrFail($attrs['user_id']);

        $userPayload = [
            'first_name' => $attrs['first'],
            'middle_name' => $attrs['middle'] ?? null,
            'last_name' => $attrs['last'],
        ];

        if (!empty($attrs['email'])) {
            $userPayload['email'] = $attrs['email'];
        }

        $user->update($userPayload);

        $addressParts = array_filter([
            $attrs['barangay'] ?? null,
            $attrs['municipality'] ?? null,
            $attrs['province'] ?? null,
        ], function ($value) {
            return filled($value);
        });

        Employee::updateOrCreate(
            ['user_id' => $attrs['user_id']],
            [
                'employee_id' => $attrs['employee_id'] ?? null,
                'account_number' => $attrs['account_number'] ?? null,
                'sex' => $attrs['gender'] ?? null,
                'contact_number' => $attrs['contact_number'] ?? null,
                'birthday' => $attrs['birthday'] ?? null,
                'position' => $attrs['position'] ?? null,
                'department' => $attrs['department'] ?? null,
                'address' => count($addressParts) ? implode(', ', $addressParts) : null,
                'emergency_contact_name' => $attrs['emergency_contact_name'] ?? null,
                'emergency_contact_relationship' => $attrs['emergency_contact_relationship'] ?? null,
                'emergency_contact_number' => $attrs['emergency_contact_number'] ?? null,
            ]
        );

        Government::updateOrCreate(
            ['user_id' => $attrs['user_id']],
            [
                'SSS' => $attrs['SSS'] ?? null,
                'TIN' => $attrs['TIN'] ?? null,
                'PhilHealth' => $attrs['PhilHealth'] ?? null,
                'MID' => $attrs['MID'] ?? null,
                'RTN' => $attrs['RTN'] ?? null,
            ]
        );

        return redirect()->back()->with('success', 'Profile updated successfully');
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
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_relationship' => 'nullable|string|max:255',
            'emergency_contact_number' => 'nullable|string|max:255',

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
                'emergency_contact_name' => $attrs['emergency_contact_name'] ?? null,
                'emergency_contact_relationship' => $attrs['emergency_contact_relationship'] ?? null,
                'emergency_contact_number' => $attrs['emergency_contact_number'] ?? null,
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

    public function update_attendance_status($id, Request $request){
        try {
            $attendanceFile = AttendanceUpload::findOrFail($id);
            
            $attrs = $request->validate([
                'status' => 'required|string'
            ]);

            $attendanceFile->update([
                'status' => $attrs['status']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Status updated successfully',
                'status' => $attrs['status']
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating attendance status: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error updating status'
            ], 500);
        }
    }

    public function delete_attendance_file($id){
        try {
            $attendanceFile = AttendanceUpload::findOrFail($id);
            
            // Delete the physical file if it exists
            if ($attendanceFile->file_path && Storage::disk('public')->exists($attendanceFile->file_path)) {
                Storage::disk('public')->delete($attendanceFile->file_path);
            }

            // Delete the database record
            $attendanceFile->delete();

            return response()->json([
                'success' => true,
                'message' => 'File deleted successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting attendance file: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error deleting file'
            ], 500);
        }
    }


}
