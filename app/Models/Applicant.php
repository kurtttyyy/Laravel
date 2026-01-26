<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Applicant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'education_attainment',
        'field_study',
        'experience',
        'skills_n_expertise',
        'applied_position',
        'application_status',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Adjust 'user_id' if your column name differs
    }

    public function applicants(){
        return $this->belongsTo(ApplicantDocument::class, 'applicant_id', 'id');
    }
}
