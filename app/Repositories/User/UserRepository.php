<?php

namespace App\Repositories\User;

use App\Models\User\User;
use App\Models\User\UserRole;
use Illuminate\Database\Eloquent\Builder;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @return int
     */
    public function getSponsorId(): int
    {
        return User::whereHas('role', function (Builder $query) {
            $query->where('name', UserRole::NAME_SPONSOR);
        })
            ->first()
            ->getId();
    }
}
