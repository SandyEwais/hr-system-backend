<?php

namespace App\Models;

use App\Enums\RequestType;
use App\Enums\RequestStatus;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    
    protected $casts = [
        'request_type' => RequestType::class,
        'status' => RequestStatus::class,
    ];
    protected $fillable = [
        'user_id',
        'request_type',
        'status',
        'current_action_taker_id',
    ];

}
