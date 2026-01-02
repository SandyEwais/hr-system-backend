<?php

namespace App\Models;

use App\Enums\EmploymentType;
use Illuminate\Database\Eloquent\Model;

class EmployeeJobDetail extends Model
{
    protected $casts = [
        'employment_type' => EmploymentType::class,
        'joining_date' => 'date',
    ];
    protected $fillable = [
        'user_id',
        'project_id',
        'department_id',
        'position_id',
        'location_id',
        'direct_manager_id',
        'business_unit',
        'employment_type',
        'joining_date',
    ];

}
