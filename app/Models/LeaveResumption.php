<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveResumption extends Model
{
    protected $fillable = [
        'request_id',
        'resumption_date',
        'comment',
    ];

}
