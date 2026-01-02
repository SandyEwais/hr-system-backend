<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClearanceRequest extends Model
{
    protected $fillable = [
        'request_id',
        'clearance_type',
        'start_date',
        'end_date',
    ];

}
