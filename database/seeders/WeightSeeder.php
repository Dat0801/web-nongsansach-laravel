<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WeightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $weights = [
            ['weight_name' => 'Kg'],
            ['weight_name' => 'g']
        ];
        try {
            foreach ($weights as $weight) {
                DB::table('weights')->insert($weight);
            }
        } catch (\Throwable $ex) {
            echo $ex;
        }
    }
}
