<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Auth;

class AuthService implements AuthInterface
{
    /**
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function login(string $email, string $password): bool
    {
        return Auth::attempt(['email' => $email, 'password' => $password]);
    }

    /**
     * @param int $userId
     * @return bool
     */
    public function logout(int $userId): bool
    {
        // TODO: Implement logout() method.
    }
}
