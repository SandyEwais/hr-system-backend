<?php

namespace App\Models;

use App\Enums\EmploymentType;
use Illuminate\Database\Eloquent\Model;

class EmployeeJobDetail extends Model
{
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
    protected $casts = [
        'employment_type' => EmploymentType::class,
        'joining_date' => 'date',
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

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function directManager()
    {
        return $this->belongsTo(User::class, 'direct_manager_id');
    }

}
