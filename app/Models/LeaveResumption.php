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
    protected $casts = [
        'resumption_date' => 'date'
    ];

    public function request()
    {
        return $this->belongsTo(Request::class);
    }

}
