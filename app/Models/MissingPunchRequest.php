<?php

namespace App\Models;

use App\Enums\PunchType;
use Illuminate\Database\Eloquent\Model;

class MissingPunchRequest extends Model
{
    protected $casts = [
        'punch_type' => PunchType::class,
        'missed_date' => 'date',
        'missed_time' => 'datetime:H:i',
    ];
    protected $fillable = [
        'request_id',
        'punch_type',
        'missed_date',
        'missed_time',
        'reason',
        'comment',
    ];
    public function request()
    {
        return $this->belongsTo(Request::class);
    }

}
