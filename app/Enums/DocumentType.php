<?php
namespace App\Enums;

enum DocumentType: string
{
    case CV       = 'cv';
    case DEGREE   = 'degree';
    case ID       = 'id';
    case CONTRACT = 'contract';
    case OTHER    = 'other';
}
