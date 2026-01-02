<?php
namespace App\Enums;

enum EmploymentType: string
{
    case FULL_TIME   = 'full_time';
    case FIXED_TERM  = 'fixed_term';
    case CONTRACTOR  = 'contractor';
    case INTERN      = 'intern';
}