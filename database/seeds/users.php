<?php

use Illuminate\Database\Seeder;
use App\User;

class users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\ClassModel::create([
            "class" => '1'
        ]);

   
        User::create([
            "class_id"   => 1,
            "nis"        => '2103191001',
            "school"     => 'smkn 1 sby',
            "name"       => 'rizky putra ramadan',
            "class_code" => 'A',
            "img"        => '',
            "email"      => 'riskipatra5@gmail.com',
            "age"        => '18',
            "address"    => 'perum taman sidorejo n 18',
            "gender"     => 'l',
            "password"   => bcrypt('123456'),
            "api_token"  => bcrypt('riskipatra5@gmail.com'),
        ]);


    }
}
