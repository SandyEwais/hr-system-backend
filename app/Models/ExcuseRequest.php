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
    protected $casts = [
        'start_datetime' => 'datetime',
        'end_datetime' => 'datetime',
    ];

    public function request()
    {
        return $this->belongsTo(Request::class);
    }

}
