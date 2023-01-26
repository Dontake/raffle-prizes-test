<?php

namespace Database\Factories\User;

use App\Models\User\UserAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UserAddress>
 */
class UserAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'postcode' => $this->faker->postcode(),
            'country' => $this->faker->countryCode(),
            'city' => $this->faker->city(),
            'address' => $this->faker->streetAddress(),
        ];
    }
}
