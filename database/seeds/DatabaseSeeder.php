<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ShiftSeed::class);
        $this->call(UserSeed::class);
        $this->call(CompanySeed::class);
        $this->call(EventSeed::class);
    }
}
