<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $categories = [
            ['category_name' => 'Rau'],
            ['category_name' => 'Củ'],
            ['category_name' => 'Nấm'],
            ['category_name' => 'Trái cây']
        ];
        try {
            foreach ($categories as $category) {
                DB::table('categories')->insert($category);
            }
        } catch (\Throwable $ex) {
            echo $ex;
        }
    }
}
