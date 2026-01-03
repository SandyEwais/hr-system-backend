<?php
namespace App\Services;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthService
{

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
}
