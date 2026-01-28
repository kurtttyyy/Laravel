<?php

namespace App\Http\Controllers;

use App\Models\OpenPosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdministratorStoreController extends Controller
{
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

    public function update_position(Request $request, $id){
        Log::info($request);
        $attrs = $request->validate([
            'title' => 'required',
            //'department' => 'required',
            'employment' => 'required',
            'collage_name' => 'required',
            //'mode' => 'required',
            'description' => 'required',
            'responsibilities' => 'required',
            'requirements' => 'required',
            // 'min' => 'required',
            // 'max' => 'required',
            'level' => 'required',
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
            'job_description' => $attrs['description'],
            'responsibilities' => $attrs['responsibilities'],
            'requirements' => $attrs['requirements'],
            // 'min_salary' => $attrs['min'],
            // 'max_salary' => $attrs['max'],
            'experience_level' => $attrs['level'],
            'location' => $attrs['location'],
            'skills' => $attrs['skills'],
            //'benifits' => $attrs['benefits'],
            //'job_type' => $attrs['job_type'],
            'one' => $attrs['start_date'],
            'two' => $attrs['end_date'],
            'passionate' => $attrs['passionate'],
        ]);

        return redirect()->back()->with('success','Success Added Position');
    }

    public function destroy_position($id){
        $delete = OpenPosition::findOrFail($id);

        $delete->delete();

        return redirect()->route('admin.adminPosition')->with('success','Successfully deleted Position');

    }
}
