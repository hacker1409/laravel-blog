<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'user_name' => '懒虫123',
            'nick_name' => '猫咪q',
            'passwd' => md5('tmwen'),
            'email' => 'lyhacker_wtm@163.com',
            'avator' => 'http://laravel-test.com/images/header.png',
            'phone' => 13798316171,
            'create_time' => date('Y-m-d H:i:s'),
            'update_time' => date('Y-m-d H:i:s'),
        ]);
    }
}
