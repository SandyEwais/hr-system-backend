<?php
namespace App\Enums;

enum MovementType: string
{
    case CHECK_IN   = 'check_in';
    case CHECK_OUT  = 'check_out';
    case BREAK_IN   = 'break_in';
    case BREAK_OUT  = 'break_out';
    case PREPARATION = 'preparation';
}
