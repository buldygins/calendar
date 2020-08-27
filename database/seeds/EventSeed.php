<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class EventSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('ru_RU');
        for ($i = 0; $i < 6; $i++) {
            DB::table('events')->insert([
                'name' => $faker->word,
                'cost' => rand(10, 1000),
                'type' => $faker->word,
                'company_id' => rand(1, 3),
                'date' => \Illuminate\Support\Carbon::now()->addDay($i)->format("Y-m-d"),
                'shift_id' => ($i % 3) + 1,
                'user_id' => rand(1, 6),
            ]);
        }
    }
}
