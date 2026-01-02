<?php

namespace App\Exceptions;

use Exception;

class BaseException extends Exception
{
    protected int $status = 400;
    protected array $errors = [];
    protected ?string $code = null;

    public function status(): int
    {
        return $this->status;
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function code(): ?string
    {
        return $this->code;
    }
}
