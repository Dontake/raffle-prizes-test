<?php

namespace Database\Factories\User;

use App\Enums\User\UserRoleEnum;
use App\Models\User\UserRole;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UserRole>
 */
class UserRoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => UserRoleEnum::USER,
        ];
    }

    /**
     * Indicate that the model's role is sponsor.
     *
     * @return Factory
     */
    public function sponsor(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => UserRoleEnum::SPONSOR,
            ];
        });
    }
}
