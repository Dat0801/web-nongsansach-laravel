<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $images = [
            ['product_id' => 1, 'image_name' => 'chuoiGia-1.jpg', 'is_primary' => 1],
            ['product_id' => 1, 'image_name' => 'chuoiGia-2.jpg'],
            ['product_id' => 1, 'image_name' => 'chuoiGia-3.jpg'],
            ['product_id' => 2, 'image_name' => 'duaHauDo-1.jpg', 'is_primary' => 1],
            ['product_id' => 2, 'image_name' => 'duaHauDo-2.jpg'],
            ['product_id' => 2, 'image_name' => 'duaHauDo-3.jpg'],
            ['product_id' => 2, 'image_name' => 'duaHauDo-4.jpg'],
            ['product_id' => 3, 'image_name' => 'duaLuoi-1.jpg', 'is_primary' => 1],
            ['product_id' => 3, 'image_name' => 'duaLuoi-2.jpg'],
            ['product_id' => 4, 'image_name' => 'camSanh-1.jpg', 'is_primary' => 1],
            ['product_id' => 4, 'image_name' => 'camSanh-2.jpg'],
            ['product_id' => 4, 'image_name' => 'camSanh-3.jpg'],
            ['product_id' => 4, 'image_name' => 'camSanh-4.jpg'],
            ['product_id' => 5, 'image_name' => 'oiTranChau-1.jpg', 'is_primary' => 1],
            ['product_id' => 5, 'image_name' => 'oiTranChau-2.jpg'],
            ['product_id' => 5, 'image_name' => 'oiTranChau-3.jpg'],
            ['product_id' => 6, 'image_name' => 'boSap-1.jpg', 'is_primary' => 1],
            ['product_id' => 6, 'image_name' => 'boSap-2.jpg'],
            ['product_id' => 7, 'image_name' => 'caiBeXanh-1.jpg', 'is_primary' => 1],
            ['product_id' => 7, 'image_name' => 'caiBeXanh-2.jpg'],
            ['product_id' => 8, 'image_name' => 'caiNgot-1.jpg', 'is_primary' => 1],
            ['product_id' => 8, 'image_name' => 'caiNgot-2.jpg'],
            ['product_id' => 9, 'image_name' => 'caiThia-1.jpg', 'is_primary' => 1],
            ['product_id' => 9, 'image_name' => 'caiThia-2.jpg'],
            ['product_id' => 9, 'image_name' => 'caiThia-3.jpg']
        ];
        try {
            foreach ($images as $image) {
                DB::table('images')->insert($image);
            }
        } catch (\Throwable $ex) {
            echo $ex;
        }
    }
}
