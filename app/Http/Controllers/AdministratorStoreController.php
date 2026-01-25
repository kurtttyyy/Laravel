<?php

namespace App\Http\Controllers;

use App\Models\OpenPosition;
use Illuminate\Http\Request;

class AdministratorStoreController extends Controller
{
    public function store_new_position(Request $request){
        $attrs = $request->validate([
            'title' => 'required',
            'department' => 'required',
            'employment' => 'required',
            'mode' => 'required',
            'job' => 'required',
            'responsibilities' => 'required',
            'requirements' => 'required',
            'min' => 'required',
            'max' => 'required',
            'level' => 'required',
            'location' => 'required',
            'skills' => 'required',
            'benifits' => 'required',
            'job_type' => 'required',
            'one' => 'required|date',
            'two' => 'required|date',
        ]);

        $store = OpenPosition::create([
            'title' => $attrs['title'],
            'department' => $attrs['department'],
            'employment' => $attrs['employment'],
            'work_mode' => $attrs['mode'],
            'job_description' => $attrs['job'],
            'responsibilities' => $attrs['responsibilities'],
            'requirements' => $attrs['requirements'],
            'min_salary' => $attrs['min'],
            'max_salary' => $attrs['max'],
            'experience_level' => $attrs['level'],
            'location' => $attrs['location'],
            'skills' => $attrs['skills'],
            'benifits' => $attrs['benifits'],
            'job_type' => $attrs['job_type'],
            'one' => $attrs['one'],
            'two' => $attrs['two'],
        ]);

        return redirect()->back()->with('success','Success Added Position');
    }
}
