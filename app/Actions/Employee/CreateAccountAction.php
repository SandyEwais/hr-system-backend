<?php
namespace App\Actions\Employee;

use App\Services\PinService;
use App\Services\AuthService;

class CreateAccountAction
{
    public function __construct(
        protected AuthService $authService,
    ) {}

    public function execute(int $step, array $data)
    {
        return match ($step) {
            1 => $this->authService->storeBasicInfo($data),
            2 => $this->authService->storeUserInfo($data),
            3 => $this->authService->storeProjectInfo($data),
            4 => $this->authService->storePassword($data),
            5 => $this->authService->storePhoneAndDob($data),
            default => throw new \InvalidArgumentException('Invalid registration step'),
        };
    }
}