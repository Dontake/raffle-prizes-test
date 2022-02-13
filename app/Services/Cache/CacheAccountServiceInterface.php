<?php

namespace App\Services\Cache;

interface CacheAccountServiceInterface
{
    public function increaseBalance(int $userId, float $amount): bool;
}
