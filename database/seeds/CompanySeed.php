<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use \Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CompanySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('ru_RU');
        for ($i = 0; $i < 3; $i++) {
            DB::table('companies')->insert([
                'name' => $faker->company,
            ]);
        }
    }
}
