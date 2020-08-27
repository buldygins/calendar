<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class ShiftSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 3; $i++) {
            $n = $i + 1;
            DB::table('shifts')->insert(['name' => $n . "-я смена",]);
        }
    }
}
