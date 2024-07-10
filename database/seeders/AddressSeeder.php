<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $addresses = [
            [
                'user_id' => 1,
                'address_type_id' => 1,
                'address' => 'c3/33 Vườn Thơm',
                'ward' => 'Xã Bình Lợi',
                'district' => 'Huyện Bình Chánh',
                'province' => 'Hồ Chí Minh'
            ],
            [
                'user_id' => 1,
                'address_type_id' => 2,
                'address' => 'Lầu 2, 178E Thành Thái',
                'ward' => 'Phường 6',
                'district' => 'Quận 10',
                'province' => 'Hồ Chí Minh'
            ]
        ];
        try {
            foreach ($addresses as $address) {
                DB::table('addresses')->insert($address);
            }
        } catch (\Throwable $ex) {
            echo $ex;
        }
    }
}
