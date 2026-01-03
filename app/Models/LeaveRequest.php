<?php

namespace App\Models;

use App\Enums\LeaveType;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    protected $casts = [
        'leave_type' => LeaveType::class,
        'start_date' => 'date',
        'end_date' => 'date',
    ];
    protected $fillable = [
        'request_id',
        'leave_type',
        'start_date',
        'end_date',
        'duration_days',
        'comment',
    ];
    public function request()
    {
        return $this->belongsTo(Request::class);
    }

}
