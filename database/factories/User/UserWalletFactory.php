<?php

namespace Database\Factories\User;

use App\Models\User\UserWallet;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends Factory<UserWallet>
 */
class UserWalletFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'balance' => rand(0, 1000),
            'account' => Str::random(10),
        ];
    }
}
