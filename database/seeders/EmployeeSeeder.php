<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        /* 

        */
        $employees = [
            ['employee_name' => 'Nguyễn Văn An', 'employee_email' => 'nva2003@gmail.com', 'employee_phone' => '0897785658', 'employee_password' => Hash::make('Admin123*')]
        ];
        try {
            foreach ($employees as $employee) {
                DB::table('employees')->insert($employee);
            }
        } catch (\Throwable $ex) {
            echo $ex;
        }
    }
}
