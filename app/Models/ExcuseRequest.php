<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExcuseRequest extends Model
{
    protected $fillable = [
        'request_id',
        'start_datetime',
        'end_datetime',
        'duration_minutes',
        'comment',
    ];

}
