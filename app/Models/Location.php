<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'name',
        'project_id',
        'latitude',
        'longitude',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function jobDetails()
    {
        return $this->hasMany(EmployeeJobDetail::class);
    }

    public function attendanceMovements()
    {
        return $this->hasMany(AttendanceMovement::class);
    }
}
