<?php

namespace Database\Seeders;

use Faker\Provider\Lorem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->where('name', 'like', 'fake%')->delete();
        DB::table('user_addresses')->where('address', 'like', 'fake%')->delete();
        DB::table('user_cash_accounts')->where('account', 'like', 'fake%')->delete();
        DB::table('user_roles')->whereNotNull('id')->delete();

        $this->insertUser();
        $this->insertSponsor();
    }

    private function insertUser()
    {
        $userId = DB::table('users')->insertGetId([
            'name' => 'Fake Jon Smith',
            'email' => 'test@email.com',
            'email_verified_at' => now(),
            'password' => Hash::make(123456),
            'remember_token' => Str::random(10),
        ]);

        $this->insertUserAddress($userId);
        $this->insertUserCashAccount($userId);
        $this->insertUserRole($userId, 'user');
    }

    private function insertSponsor()
    {
        $userId = DB::table('users')->insertGetId([
            'name' => 'Fake Ebenezer Scrooge',
            'email' => 'sponsor@email.com',
            'email_verified_at' => now(),
            'password' => Hash::make(123456),
            'remember_token' => Str::random(10),
        ]);

        $this->insertUserAddress($userId);
        $this->insertUserCashAccount($userId, 100000);
        $this->insertUserRole($userId, 'sponsor');
    }

    private function insertUserAddress(int $userId)
    {
        DB::table('user_addresses')->insert([
            'user_id' => $userId,
            'postcode' => 10000,
            'country' => 'ČR',
            'town' => 'Prague',
            'address' => 'Fake ' . Lorem::words(3, 'true')
        ]);
    }

    private function insertUserCashAccount(int $userId, float $balance = 0)
    {
        DB::table('user_cash_accounts')->insert([
            'user_id' => $userId,
            'account' => 'fake' . Str::random(10),
            'balance' => $balance
        ]);
    }

    private function insertUserRole(int $userId, string $role)
    {
        DB::table('user_roles')->insert([
            'user_id' => $userId,
            'name' => $role
        ]);
    }
}
