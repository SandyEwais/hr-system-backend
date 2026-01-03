<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpenseClaimItem extends Model
{
    protected $fillable = [
        'expense_claim_request_id',
        'description',
        'amount',
    ];
    public function expenseClaimRequest()
    {
        return $this->belongsTo(ExpenseClaimRequest::class);
    }

}
