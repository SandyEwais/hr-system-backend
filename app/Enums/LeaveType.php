<?php
namespace App\Enums;

enum LeaveType: string
{
    case ANNUAL    = 'annual';
    case SICK      = 'sick';
    case UNPAID    = 'unpaid';
    case EMERGENCY = 'emergency';
    case MATERNITY = 'maternity';
}
