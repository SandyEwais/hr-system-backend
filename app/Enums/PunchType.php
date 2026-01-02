<?php
namespace App\Enums;

enum PunchType: string
{
    case CHECK_IN  = 'check_in';
    case CHECK_OUT = 'check_out';
}
