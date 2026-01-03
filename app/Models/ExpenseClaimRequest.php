<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpenseClaimRequest extends Model
{
    protected $fillable = [
        'request_id',
        'title',
        'total_amount',
        'comment',
    ];

    public function request()
    {
        return $this->belongsTo(Request::class);
    }

    public function items()
    {
        return $this->hasMany(ExpenseClaimItem::class);
    }
}
