<?php

namespace App\Models;

use App\Enums\ContractStatus;
use Illuminate\Database\Eloquent\Model;

class EmployeeFinancialDetail extends Model
{
    protected $casts = [
        'contract_status' => ContractStatus::class,
        'contract_start_date' => 'date',
        'basic_salary' => 'decimal:2',
    ];
    protected $fillable = [
        'user_id',
        'basic_salary',
        'bank_iban',
        'contract_start_date',
        'contract_period',
        'contract_status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
