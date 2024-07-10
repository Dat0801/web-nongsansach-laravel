<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $products = [
            ['category_id' => 4, 'unit_id' => 1, 'weight_id' => 2, 'product_name' => 'Chuối già Nam Mỹ', 'product_quantity' => 500, 'product_price' => 15000, 'product_stock' => 20],
            ['category_id' => 4, 'unit_id' => 2, 'weight_id' => 1, 'product_name' => 'Dưa hấu đỏ', 'product_quantity' => 2, 'product_price' => 31200, 'product_stock' => 15],
            ['category_id' => 4, 'unit_id' => 2, 'weight_id' => 1, 'product_name' => 'Dưa lưới', 'product_quantity' => 1.3, 'product_price' => 60000, 'product_stock' => 27],
            ['category_id' => 4, 'unit_id' => 1, 'weight_id' => 1, 'product_name' => 'Cam sành', 'product_quantity' => 2, 'product_price' => 30000, 'product_stock' => 23],
            ['category_id' => 4, 'unit_id' => 1, 'weight_id' => 2, 'product_name' => 'Ổi Trân Châu', 'product_quantity' => 500, 'product_price' => 9000, 'product_stock' => 6],
            ['category_id' => 4, 'unit_id' => 1, 'weight_id' => 1, 'product_name' => 'Bơ Sáp', 'product_quantity' => 1, 'product_price' => 20400, 'product_stock' => 10],
            ['category_id' => 1, 'unit_id' => 3, 'weight_id' => 2, 'product_name' => 'Cải bẹ xanh', 'product_quantity' => 400, 'product_price' => 9000, 'product_stock' => 9],
            ['category_id' => 1, 'unit_id' => 3, 'weight_id' => 2, 'product_name' => 'Cải ngọt', 'product_quantity' => 400, 'product_price' => 9600, 'product_stock' => 16],
            ['category_id' => 1, 'unit_id' => 3, 'weight_id' => 2, 'product_name' => 'Cải thìa', 'product_quantity' => 500, 'product_price' => 12000, 'product_stock' => 11],
            ['category_id' => 1, 'unit_id' => 3, 'weight_id' => 2, 'product_name' => 'Cải bẹ dún', 'product_quantity' => 400, 'product_price' => 12000, 'product_stock' => 9],
            ['category_id' => 1, 'unit_id' => 3, 'weight_id' => 2, 'product_name' => 'Rau dền', 'product_quantity' => 400, 'product_price' => 9600, 'product_stock' => 27],
            ['category_id' => 1, 'unit_id' => 3, 'weight_id' => 2, 'product_name' => 'Rau lang', 'product_quantity' => 400, 'product_price' => 9000, 'product_stock' => 14],
            ['category_id' => 2, 'unit_id' => 1, 'weight_id' => 1, 'product_name' => 'Khoai lang Nhật', 'product_quantity' => 1, 'product_price' => 9000, 'product_stock' => 7],
            ['category_id' => 2, 'unit_id' => 1, 'weight_id' => 2, 'product_name' => 'Bí đỏ hồ lô', 'product_quantity' => 500, 'product_price' => 9000, 'product_stock' => 12],
            ['category_id' => 2, 'unit_id' => 1, 'weight_id' => 2, 'product_name' => 'Bí xanh', 'product_quantity' => 500, 'product_price' => 14400, 'product_stock' => 5],
            ['category_id' => 2, 'unit_id' => 1, 'weight_id' => 2, 'product_name' => 'Cà rốt', 'product_quantity' => 500, 'product_price' => 9000, 'product_stock' => 9],
            ['category_id' => 2, 'unit_id' => 1, 'weight_id' => 2, 'product_name' => 'Khoai tây', 'product_quantity' => 500, 'product_price' => 15600, 'product_stock' => 15],
            ['category_id' => 2, 'unit_id' => 1, 'weight_id' => 2, 'product_name' => 'Củ cải trắng', 'product_quantity' => 500, 'product_price' => 9000, 'product_stock' => 10],
            ['category_id' => 3, 'unit_id' => 4, 'weight_id' => 2, 'product_name' => 'Nấm bào ngư trắng', 'product_quantity' => 300, 'product_price' => 18000, 'product_stock' => 5],
            ['category_id' => 3, 'unit_id' => 4, 'weight_id' => 2, 'product_name' => 'Nấm đùi gà', 'product_quantity' => 200, 'product_price' => 36000, 'product_stock' => 5],
            ['category_id' => 3, 'unit_id' => 4, 'weight_id' => 2, 'product_name' => 'Nấm rơm', 'product_quantity' => 150, 'product_price' => 36000, 'product_stock' => 10],
            ['category_id' => 4, 'unit_id' => 1, 'weight_id' => 2, 'product_name' => 'Chanh dây', 'product_quantity' => 500, 'product_price' => 15000, 'product_stock' => 20],
            ['category_id' => 4, 'unit_id' => 1, 'weight_id' => 2, 'product_name' => 'Cóc lớn', 'product_quantity' => 500, 'product_price' => 15000, 'product_stock' => 20],
            ['category_id' => 4, 'unit_id' => 1, 'weight_id' => 2, 'product_name' => 'Thanh long', 'product_quantity' => 500, 'product_price' => 15000, 'product_stock' => 20],
            ['category_id' => 4, 'unit_id' => 2, 'weight_id' => 1, 'product_name' => 'Đu đủ vàng', 'product_quantity' => 1, 'product_price' => 15000, 'product_stock' => 20],
            ['category_id' => 2, 'unit_id' => 1, 'weight_id' => 2, 'product_name' => 'Cà chua', 'product_quantity' => 500, 'product_price' => 15000, 'product_stock' => 20],
            ['category_id' => 1, 'unit_id' => 1, 'weight_id' => 2, 'product_name' => 'Dưa leo', 'product_quantity' => 500, 'product_price' => 15000, 'product_stock' => 20],
            ['category_id' => 1, 'unit_id' => 3, 'weight_id' => 2, 'product_name' => 'Hẹ lá', 'product_quantity' => 500, 'product_price' => 15000, 'product_stock' => 20],
            ['category_id' => 3, 'unit_id' => 4, 'weight_id' => 2, 'product_name' => 'Nấm tuyết', 'product_quantity' => 500, 'product_price' => 15000, 'product_stock' => 20],
            ['category_id' => 1, 'unit_id' => 3, 'weight_id' => 2, 'product_name' => 'Rau diếp cá', 'product_quantity' => 500, 'product_price' => 15000, 'product_stock' => 20],
            ['category_id' => 1, 'unit_id' => 3, 'weight_id' => 2, 'product_name' => 'Rau cần ta', 'product_quantity' => 500, 'product_price' => 15000, 'product_stock' => 20],
        ];
        try {
            foreach ($products as $product) {
                DB::table('products')->insert($product);
            }
        } catch (\Throwable $ex) {
            echo $ex;
        }
    }
}
