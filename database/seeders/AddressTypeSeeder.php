<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $address_types = [
            ['address_type_name' => 'Nhà riêng'],
            ['address_type_name' => 'Văn phòng']
        ];
        try {
            foreach ($address_types as $address_type) {
                DB::table('address_types')->insert($address_type);
            }
        } catch (\Throwable $ex) {
            echo $ex;
        }
    }
}
