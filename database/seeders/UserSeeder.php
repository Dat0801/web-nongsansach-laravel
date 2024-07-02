<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users = [
            ['name' => 'Nguyễn Từ Thành Đạt', 'email' => 'nguyentuthanhdat0801@gmail.com', 'password' => Hash::make('Dat123456789*'), 'phone_number' => '0839123478']
        ];
        try {
            foreach ($users as $user) {
                DB::table('users')->insert($user);
            }
        } catch (\Throwable $ex) {
            echo $ex;
        }
    }
}
