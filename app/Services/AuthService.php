<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthService
{
    private const TTL = 3600 * 24; // 24 hours
    public function login(array $data, string $role)
    {
        $user = User::where('email', $data['email'])->first();
        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw new UnauthorizedHttpException('', 'Invalid credentials');
        }
        if ($user->roles()->first()->name !== $role) {
            throw new UnauthorizedHttpException('', 'Unauthorized for this action');
        }
        $token = $user->createToken($role . '-token')->plainTextToken;
        return [
            'user' => $user,
            'token' => $token,
        ];
    }
    public function storeBasicInfo(array $data)
    {
        $this->cacheStep($data['cache_key'], 1, [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'gender' => $data['gender'],
        ]);

        return ['status' => 'step_1_saved'];
    }

    public function storeUserInfo(array $data)
    {
        $this->cacheStep($data['cache_key'], 2, [
            'username' => $data['username'],
            'email' => $data['email'],
        ]);

        return ['status' => 'step_2_saved'];
    }

    public function storeProjectInfo(array $data)
    {
        $this->cacheStep($data['cache_key'], 3, [
            'nationality' => $data['nationality'],
            'project_id' => $data['project_id'],
        ]);

        return ['status' => 'step_3_saved'];
    }

    public function storePassword(array $data)
    {
        $key = $data['cache_key'];

        Cache::put("registration:{$key}:password", [
            'password' => Hash::make($data['password'])
        ], self::TTL);

        return ['status' => 'password_setup_complete'];
    }
    public function storePhoneAndDob(array $data)
    {
        $this->cacheStep($data['cache_key'], 4, [
            'phone' => $data['phone'],
            'date_of_birth' => $data['date_of_birth'],
        ]);
        return $this->finalizeRegistration($data);
    }

    private function cacheStep(string $key, int $step, array $data): void
    {
        Cache::put("registration:{$key}:step{$step}", $data, self::TTL);
    }

    private function finalizeRegistration(array $data): User
    {
        $key = $data['cache_key'];
        $steps = [];
        for ($i = 1; $i <= 4; $i++) {
            $steps[$i] = Cache::get("registration:{$key}:step{$i}");
            if (!$steps[$i]) {
                throw new \LogicException('Registration data is incomplete.');
            }
        }
        $passwordData = Cache::get("registration:{$key}:password");
        if ($passwordData === null) {
            throw new \LogicException('PIN (password) is missing. Complete step 4 first.');
        }
        $allData = array_merge(
            $steps[1], // name, gender
            $steps[2], // username, email
            $steps[3], // nationality, project_id
            $steps[4], // phone, dob
            $passwordData
        );
        
        $user = $this->createAccount($allData);
        for ($i = 1; $i <= 4; $i++) {
            Cache::forget("registration:{$key}:step{$i}");
        }
        Cache::forget("registration:{$key}:password");

        return $user->load('employeeProfile');
    }

    private function createAccount(array $data)
    {
        return DB::transaction(function () use ($data) {
            $user = User::create(Arr::only($data, [
                'username', 'email', 'password', 'phone'
            ]));

            $user->employeeProfile()->create(Arr::only($data, [
                'first_name', 'last_name', 'gender', 'nationality', 'date_of_birth'
            ]));

            return $user;
        });
    }
}
