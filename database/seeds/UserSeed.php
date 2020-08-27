<?php

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('ru_RU');
        DB::table('users')->insert([
            'name' => $faker->name,
            'email' => 'test@test',
            'password' => Hash::make('1234'),
            'company_id' => rand(1, 3)
        ]);
        for ($i = 0; $i < 6; $i++) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => Hash::make('1234'),
                'company_id' => rand(1, 3)
            ]);
        }
    }
}
