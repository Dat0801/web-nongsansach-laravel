<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $orders = [
            ['user_id' => 1, 'employee_id' => 1, 'status' => 'Đã giao hàng']
        ];
        try {
            foreach ($orders as $order) {
                DB::table('orders')->insert($order);
            }
        } catch (\Throwable $ex) {
            echo $ex;
        }
    }
}
