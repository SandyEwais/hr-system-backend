<?php
namespace App\Enums;

enum RequestType: string
{
    case LEAVE           = 'leave';
    case LEAVE_RESUME    = 'leave_resumption';
    case EXPENSE         = 'expense';
    case EXCUSE          = 'excuse';
    case CLEARANCE       = 'clearance';
    case MISSING_PUNCH   = 'missing_punch';
}
