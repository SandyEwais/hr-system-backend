<?php
namespace App\Enums;

enum ProjectStatus: string
{
    case ACTIVE    = 'active';
    case INACTIVE  = 'inactive';
    case COMPLETED = 'completed';
}
