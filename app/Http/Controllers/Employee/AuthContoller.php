<?php

namespace App\Http\Controllers\Employee;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Auth\LoginRequest;
use Illuminate\Support\Facades\RateLimiter;
use App\Actions\Employee\CreateAccountAction;
use App\Http\Resources\v1\Employee\LoginResource;
use App\Http\Resources\v1\Employee\RegisterationResource;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Http\Requests\v1\Employee\Auth\RegisterStep1Request;
use App\Http\Requests\v1\Employee\Auth\RegisterStep2Request;
use App\Http\Requests\v1\Employee\Auth\RegisterStep3Request;
use App\Http\Requests\v1\Employee\Auth\RegisterStep4Request;
use App\Http\Requests\v1\Employee\Auth\RegisterStep5Request;

class AuthContoller extends Controller
{
    use ApiResponseTrait;

    public function login(LoginRequest $request, AuthService $service)
    {
        $result = $service->login($request->validated(), 'employee');
        RateLimiter::clear($request->throttleKey());
        $data = [
            'user' => new LoginResource($result['user']),
            'token' => $result['token'],
        ];
        return self::successResponse($data, 'Logged in successfully');
    }

    public function register(Request $request, CreateAccountAction $action)
    {
        $step = (int) $request->step;
        $validated = match ((int) $request->step) {
            1 => app(RegisterStep1Request::class)->validated(),
            2 => app(RegisterStep2Request::class)->validated(),
            3 => app(RegisterStep3Request::class)->validated(),
            4 => app(RegisterStep4Request::class)->validated(),
            5 => app(RegisterStep5Request::class)->validated(),
            default => throw new HttpException(400, 'Invalid registration step'),
        };
        $cacheKey = $this->resolveRegistrationKey($step, $validated);
        $validated['cache_key'] = $cacheKey;
        $result = $action->execute($step, $validated);
        
        if ($step === 5 && $result instanceof User) {
            $result = (new RegisterationResource($result->load('employeeProfile')))->toArray($request);
        } else {
            $result['cache_key'] = $validated['cache_key'];
        }
        return self::successResponse($result, 'Step completed successfully');
    }


    private function resolveRegistrationKey(int $step, array $data): string
    {
        if ($step === 1)
            return (string) Str::uuid();
        
        if (empty($data['cache_key'])) {
            throw new HttpException(400, 'Missing cache_key. Please restart registration.');
        }

        return $data['cache_key'];

    }
}
