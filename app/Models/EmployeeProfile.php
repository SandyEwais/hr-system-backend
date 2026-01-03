<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeProfile extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'gender',
        'nationality',
        'marital_status',
        'date_of_birth',
        'personal_email',
        'contact_number',
        'building_number',
        'street_name',
        'district',
        'city',
    ];
    protected $casts = [
        'date_of_birth' => 'date',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
