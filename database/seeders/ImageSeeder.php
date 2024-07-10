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
            ['product_id' => 9, 'image_name' => 'caiThia-3.jpg'],
            ['product_id' => 10, 'image_name' => 'caiBeDun-1.jpg', 'is_primary' => 1],
            ['product_id' => 10, 'image_name' => 'caiBeDun-2.jpg'],
            ['product_id' => 11, 'image_name' => 'rauDen-1.jpg', 'is_primary' => 1],
            ['product_id' => 11, 'image_name' => 'rauDen-2.jpg'],
            ['product_id' => 11, 'image_name' => 'rauDen-3.jpg'],
            ['product_id' => 12, 'image_name' => 'rauLang-1.jpg', 'is_primary' => 1],
            ['product_id' => 12, 'image_name' => 'rauLang-2.jpg'],
            ['product_id' => 13, 'image_name' => 'khoaiLangNhat-1.jpg', 'is_primary' => 1],
            ['product_id' => 13, 'image_name' => 'khoaiLangNhat-2.jpg'],
            ['product_id' => 14, 'image_name' => 'biDoHoLo-1.jpg', 'is_primary' => 1],
            ['product_id' => 14, 'image_name' => 'biDoHoLo-2.jpg'],
            ['product_id' => 15, 'image_name' => 'biXanh-1.jpg', 'is_primary' => 1],
            ['product_id' => 15, 'image_name' => 'biXanh-2.jpg'],
            ['product_id' => 16, 'image_name' => 'caRot-1.jpg', 'is_primary' => 1],
            ['product_id' => 16, 'image_name' => 'caRot-2.jpg'],
            ['product_id' => 17, 'image_name' => 'khoaiTay-1.jpg', 'is_primary' => 1],
            ['product_id' => 17, 'image_name' => 'khoaiTay-2.jpg'],
            ['product_id' => 17, 'image_name' => 'khoaiTay-3.jpg'],
            ['product_id' => 18, 'image_name' => 'cuCaiTrang-1.jpg', 'is_primary' => 1],
            ['product_id' => 18, 'image_name' => 'cuCaiTrang-2.jpg'],
            ['product_id' => 19, 'image_name' => 'namBaoNguTrang-1.jpg', 'is_primary' => 1],
            ['product_id' => 19, 'image_name' => 'namBaoNguTrang-2.jpg'],
            ['product_id' => 20, 'image_name' => 'namDuiGa-1.jpg', 'is_primary' => 1],
            ['product_id' => 20, 'image_name' => 'namDuiGa-2.jpg'],
            ['product_id' => 21, 'image_name' => 'namRom-1.jpg', 'is_primary' => 1],
            ['product_id' => 21, 'image_name' => 'namRom-2.jpg'],
            ['product_id' => 22, 'image_name' => 'chanhDay-1.jpg', 'is_primary' => 1],
            ['product_id' => 22, 'image_name' => 'chanhDay-2.jpg'],
            ['product_id' => 23, 'image_name' => 'cocLon-1.jpg', 'is_primary' => 1],
            ['product_id' => 23, 'image_name' => 'cocLon-2.jpg'],
            ['product_id' => 24, 'image_name' => 'thanhLong-1.jpg', 'is_primary' => 1],
            ['product_id' => 24, 'image_name' => 'thanhLong-2.jpg'],
            ['product_id' => 24, 'image_name' => 'thanhLong-3.jpg'],
            ['product_id' => 25, 'image_name' => 'duDuVang-1.jpg', 'is_primary' => 1],
            ['product_id' => 25, 'image_name' => 'duDuVang-2.jpg'],
            ['product_id' => 26, 'image_name' => 'caChua-1.jpg', 'is_primary' => 1],
            ['product_id' => 26, 'image_name' => 'caChua-2.jpg'],
            ['product_id' => 27, 'image_name' => 'duaLeo-1.jpg', 'is_primary' => 1],
            ['product_id' => 27, 'image_name' => 'duaLeo-2.jpg'],
            ['product_id' => 27, 'image_name' => 'duaLeo-3.jpg'],
            ['product_id' => 28, 'image_name' => 'heLa-1.jpg', 'is_primary' => 1],
            ['product_id' => 28, 'image_name' => 'heLa-2.jpg'],
            ['product_id' => 29, 'image_name' => 'namTuyet-1.jpg', 'is_primary' => 1],
            ['product_id' => 29, 'image_name' => 'namTuyet-2.jpg'],
            ['product_id' => 30, 'image_name' => 'rauDiepCa-1.jpg', 'is_primary' => 1],
            ['product_id' => 30, 'image_name' => 'rauDiepCa-2.jpg'],
            ['product_id' => 30, 'image_name' => 'rauDiepCa-3.jpg'],
            ['product_id' => 31, 'image_name' => 'rauCanTa-1.jpg', 'is_primary' => 1],
            ['product_id' => 31, 'image_name' => 'rauCanTa-2.jpg'],
            ['product_id' => 31, 'image_name' => 'rauCanTa-3.jpg'],
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
