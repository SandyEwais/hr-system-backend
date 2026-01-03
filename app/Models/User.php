<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;
    protected $guard_name = 'api';


    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'phone',
        'pin_hash',
        'voice_biometric_id',
        'face_biometric_id',
        'fingerprint_biometric_id',
        'email_verified_at',
        'phone_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'phone_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    public function otps(): HasMany
    {
        return $this->hasMany(Otp::class);
    }
    public function employeeProfile()
    {
        return $this->hasOne(EmployeeProfile::class);
    }

    public function jobDetails()
    {
        return $this->hasOne(EmployeeJobDetail::class);
    }

    public function financialDetails()
    {
        return $this->hasOne(EmployeeFinancialDetail::class);
    }

    public function documents()
    {
        return $this->hasMany(EmployeeDocument::class);
    }

    public function attendanceMovements()
    {
        return $this->hasMany(AttendanceMovement::class);
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }
    
    public function managedEmployees()
    {
        return $this->hasMany(EmployeeJobDetail::class, 'direct_manager_id');
    }
}
