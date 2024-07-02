<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $order_details = [
            ['order_id' => 1, 'product_id' => 1, 'quantity' => 2, 'total' => 30000]
        ];
        try {
            foreach ($order_details as $order_detail) {
                DB::table('order_details')->insert($order_detail);
            }
        } catch (\Throwable $ex) {
            echo $ex;
        }
    }
}
