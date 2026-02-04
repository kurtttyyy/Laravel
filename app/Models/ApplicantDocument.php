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

    protected $casts = [
        'created_at' => 'date',
    ];

    protected $appends = [
        'formatted_created_at',
    ];

    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at
            ? $this->created_at->format('F j, Y')
            : '';
    }

    public function applicants(){
        return $this->belongsTo(Applicant::class, 'applicant_id');
    }
}
