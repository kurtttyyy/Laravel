<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicantDocument extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'applicant_id',
        'filename',
        'filepath',
        'size',
        'mime_type',
        'type',
    ];

    public function applicants(){
        return $this->belongsTo(Applicant::class, 'applicant_id');
    }
}
