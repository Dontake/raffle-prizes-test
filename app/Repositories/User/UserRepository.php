<?php

namespace App\Repositories\User;

use App\Enums\User\UserRoleEnum;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Builder;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Get sponsor user id
     * @return int
     */
    public function getSponsorId(): int
    {
        return User::query()->select('id')->whereHas('role', function (Builder $query) {
            $query->where('name', UserRoleEnum::SPONSOR);
        })
            ->first()
            ->id;
    }
}
