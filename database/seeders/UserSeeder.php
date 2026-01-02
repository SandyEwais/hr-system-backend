<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::updateOrCreate(
            [
                'email' => 'admin@company.com',
            ],
            [
                'username' => 'admin',
                'password' => Hash::make('password'),
                'phone' => '01000000000',
                'email_verified_at' => now(),
                'phone_verified_at' => now(),
            ]
        );
        if(!$user->hasRole('admin')){
            $user->assignRole('admin');
        }
    }
}
