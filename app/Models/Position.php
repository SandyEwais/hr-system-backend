<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = [
        'title',
        'department_id',
    ];
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function jobDetails()
    {
        return $this->hasMany(EmployeeJobDetail::class);
    }

}
