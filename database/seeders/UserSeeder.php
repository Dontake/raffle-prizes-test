<?php

namespace Database\Seeders;

use App\Models\User\User;
use App\Models\User\UserAddress;
use App\Models\User\UserRole;
use App\Models\User\UserWallet;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $users = User::factory()->count(500)->create();

        $users->map(function ($user) {
            $user->id % 2
                ? UserRole::factory()->sponsor()->for($user)->create()
                : UserRole::factory()->for($user)->create();

            UserWallet::factory()->for($user)->create();
            UserAddress::factory()->for($user)->create();
       });
    }
}
