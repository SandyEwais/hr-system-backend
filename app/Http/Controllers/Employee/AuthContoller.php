<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Auth\LoginRequest;
use App\Http\Resources\v1\Employee\LoginResource;

class AuthContoller extends Controller
{
    use ApiResponseTrait;

    public function login(LoginRequest $request, AuthService $service) 
    {
        try {
            $result = $service->login($request->validated(), 'employee');
            $data = [
                'user' => new LoginResource($result['user']),
                'token' => $result['token'],
            ];
            return self::successResponse($data, 'Logged in successfully');
        } catch (\Exception $e) {
            return self::errorResponse($e->getMessage(), 401);
        }
    }
}
