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
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function currentActionTaker()
    {
        return $this->belongsTo(User::class, 'current_action_taker_id');
    }

    public function attachments()
    {
        return $this->hasMany(RequestAttachment::class);
    }

    public function leaveRequest()
    {
        return $this->hasOne(LeaveRequest::class);
    }

    public function leaveResumption()
    {
        return $this->hasOne(LeaveResumption::class);
    }

    public function clearanceRequest()
    {
        return $this->hasOne(ClearanceRequest::class);
    }

    public function expenseClaimRequest()
    {
        return $this->hasOne(ExpenseClaimRequest::class);
    }

    public function missingPunchRequest()
    {
        return $this->hasOne(MissingPunchRequest::class);
    }

    public function excuseRequest()
    {
        return $this->hasOne(ExcuseRequest::class);
    }

}
