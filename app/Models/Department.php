<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name',
    ];
    public function positions()
    {
        return $this->hasMany(Position::class);
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
