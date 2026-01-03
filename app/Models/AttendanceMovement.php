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
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

}
