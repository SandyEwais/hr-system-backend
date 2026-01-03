<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Actions\Auth\LoginAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Auth\LoginRequest;
use App\Http\Resources\v1\Admin\LoginResource;
use App\Services\AuthService;

class AuthContoller extends Controller
{
    use ApiResponseTrait;

    public function login(LoginRequest $request, AuthService $service) 
    {
        try {
            $result = $service->login($request->validated(), 'admin');
            $data = [
                'user' => new LoginResource($result['user']),
                'token' => $result['token'],
            ];
            return self::successResponse($data, 'HR Admin logged in successfully');
        } catch (\Exception $e) {
            return self::errorResponse($e->getMessage(), 401);
        }
    }
}
