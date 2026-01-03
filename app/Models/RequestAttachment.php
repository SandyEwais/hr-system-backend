<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestAttachment extends Model
{
    protected $fillable = [
        'request_id',
        'name',
        'path',
        'type',
    ];
    public function request()
    {
        return $this->belongsTo(Request::class);
    }

}
