<?php

namespace App\Models;

use App\Enums\MovementType;
use Illuminate\Database\Eloquent\Model;

class AttendanceMovement extends Model
{
    protected $casts = [
        'movement_type' => MovementType::class,
        'date' => 'date',
        'time' => 'datetime:H:i',
    ];
    protected $fillable = [
        'user_id',
        'project_id',
        'department_id',
        'location_id',
        'date',
        'time',
        'movement_type',
    ];

}
