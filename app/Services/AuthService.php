<?php

namespace App\Services;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function __construct(private User $user)
    {
    }

    public function login(LoginRequest $credentials)
    {
        # check if user exists
        $user = $this->user->where('email', $credentials['email'])->first();

        if (!$user) {
            throw new Exception('User not found');
        }

        # check if password is correct
        if (Hash::check($credentials['password'], $user->password)) {
            throw new Exception('Password is incorrect');
        }

        Auth::login($user);
    }
}
