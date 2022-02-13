<?php

namespace App\Repositories\Cache;

interface CacheAccountRepositoryInterface
{
    public function checkBalance(int $userId, float $amount): bool;
    public function decreaseBalance(int $userId, float $amount): bool|int;
    public function increaseBalance(int $userId, float $amount): bool|int;
}
