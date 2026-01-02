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

}
