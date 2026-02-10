<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'employee_id',
        'employement_date',
        'birthday',
        'account_number',
        'sex',
        'civil_status',
        'contact_number',
        'address',
        'department',
        'position',
        'classification',
    ];

    protected $casts = [
        'birthday' => 'date',
    ];

    protected $appends = [
        'formatted_birthday',
    ];

    public function getFormattedBirthdayAttribute()
    {
        return $this->birthday
            ? $this->birthday->format('F j, Y')
            : '';
    }


}
