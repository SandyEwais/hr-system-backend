<?php

namespace App\Models;

use App\Enums\DocumentType;
use Illuminate\Database\Eloquent\Model;

class EmployeeDocument extends Model
{
    protected $casts = [
        'type' => DocumentType::class,
    ];
    protected $fillable = [
        'user_id',
        'type',
        'name',
        'path',
    ];

}
