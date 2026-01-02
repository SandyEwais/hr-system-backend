<?php

namespace App\Exceptions\Attendance;

use App\Exceptions\BaseException;

class AlreadyCheckedInException extends BaseException
{
    protected int $status = 409;
    protected ?string $code = 'ALREADY_CHECKED_IN';

    public function __construct()
    {
        parent::__construct('User has already checked in.');
    }
}
