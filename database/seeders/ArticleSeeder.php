<?php

namespace Database\Seeders;

use Faker\Provider\Lorem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles')->where('name', 'like', 'fake%')->delete();

        for ($i = 0; $i <= 10; $i++) {
            DB::table('articles')->insertGetId([
                'name' => Lorem::words(3, 'true'),
                'description' => Lorem::words(5, 'true'),
                'count' => rand(1, 10),
            ]);
        }
    }
}
