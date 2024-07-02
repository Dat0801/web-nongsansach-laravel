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
            ['product_id' => 1, 'image_path' => 'traiCay/chuoiGia/chuoiGia-1.jpg'],
            ['product_id' => 1, 'image_path' => 'traiCay/chuoiGia/chuoiGia-2.jpg'],
            ['product_id' => 1, 'image_path' => 'traiCay/chuoiGia/chuoiGia-3.jpg'],
            ['product_id' => 2, 'image_path' => 'traiCay/duaHauDo/duaHauDo-1.jpg'],
            ['product_id' => 2, 'image_path' => 'traiCay/duaHauDo/duaHauDo-2.jpg'],
            ['product_id' => 2, 'image_path' => 'traiCay/duaHauDo/duaHauDo-3.jpg'],
            ['product_id' => 2, 'image_path' => 'traiCay/duaHauDo/duaHauDo-4.jpg'],
            ['product_id' => 3, 'image_path' => 'traiCay/duaLuoi/duaLuoi-1.jpg'],
            ['product_id' => 3, 'image_path' => 'traiCay/duaLuoi/duaLuoi-2.jpg'],
            ['product_id' => 4, 'image_path' => 'traiCay/camSanh/camSanh-1.jpg'],
            ['product_id' => 4, 'image_path' => 'traiCay/camSanh/camSanh-2.jpg'],
            ['product_id' => 4, 'image_path' => 'traiCay/camSanh/camSanh-3.jpg'],
            ['product_id' => 4, 'image_path' => 'traiCay/camSanh/camSanh-4.jpg'],
            ['product_id' => 5, 'image_path' => 'traiCay/oiTranChau/oiTranChau-1.jpg'],
            ['product_id' => 5, 'image_path' => 'traiCay/oiTranChau/oiTranChau-2.jpg'],
            ['product_id' => 5, 'image_path' => 'traiCay/oiTranChau/oiTranChau-3'],
            ['product_id' => 6, 'image_path' => 'traiCay/boSap/boSap-1.jpg'],
            ['product_id' => 6, 'image_path' => 'traiCay/boSap/boSap-2.jpg'],
            ['product_id' => 7, 'image_path' => 'rau/caiBeXanh/caiBeXanh-1.jpg'],
            ['product_id' => 7, 'image_path' => 'rau/caiBeXanh/caiBeXanh-2.jpg'],
            ['product_id' => 8, 'image_path' => 'rau/caiNgot/caiNgot-1.jpg'],
            ['product_id' => 8, 'image_path' => 'rau/caiNgot/caiNgot-2.jpg'],
            ['product_id' => 9, 'image_path' => 'rau/caiThia/caiThia-1.jpg'],
            ['product_id' => 9, 'image_path' => 'rau/caiThia/caiThia-2.jpg'],
            ['product_id' => 9, 'image_path' => 'rau/caiThia/caiThia-3.jpg']
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
