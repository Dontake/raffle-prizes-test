<?php

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    /**
     * Get sponsor user id
     * @return int
     */
    public function getSponsorId(): int;
}
