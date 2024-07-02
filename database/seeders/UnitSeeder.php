<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $units = [
            ['unit_name' => 'Túi'],
            ['unit_name' => 'Trái'],
            ['unit_name' => 'Bó'],  
            ['unit_name' => 'Hộp']
        ];
        try {
            foreach ($units as $unit) {
                DB::table('units')->insert($unit);
            }
        } catch (\Throwable $ex) {
            echo $ex;
        }
    }
}
