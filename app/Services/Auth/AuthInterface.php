<?php

namespace App\Services\Auth;

interface AuthInterface
{
    /**
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function login(string $email, string $password): bool;

    /**
     * @param int $userId
     * @return bool
     */
    public function logout(int $userId): bool;
}
