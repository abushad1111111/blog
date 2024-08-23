<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'requirements',
        'responsibilities',
        'company',
        'location',
        'salary_min',
        'salary_max',
        'employment_type',
        'experience_level',
        'education_level',
        'industry',
        'job_type',
        'posted_at',
        'expires_at',
        'application_deadline',
    ];
}
