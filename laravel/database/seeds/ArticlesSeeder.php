<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles')->insert([
            [
                'user_id' => 1,
                'name' => 'postgresql入门笔记(详细)',
                'summary' => 'postgresql入，有你一起',
                'type' => 1,
                'create_time' => date('Y-m-d H:i:s'),
                'update_time' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 1,
                'name' => 'php7新特性',
                'summary' => '多去了解一些新技术，有备无患',
                'type' => 1,
                'create_time' => date('Y-m-d H:i:s'),
                'update_time' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 1,
                'name' => 'redis主从高可用方',
                'summary' => '非常好的redis主从高可用方案',
                'type' => 1,
                'create_time' => date('Y-m-d H:i:s'),
                'update_time' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 1,
                'name' => 'php面试总结',
                'summary' => '2018PHP经典面试题汇总',
                'type' => 1,
                'create_time' => date('Y-m-d H:i:s'),
                'update_time' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 1,
                'name' => 'php--字符串',
                'summary' => '工作当中经常使用的字符串处理',
                'type' => 1,
                'create_time' => date('Y-m-d H:i:s'),
                'update_time' => date('Y-m-d H:i:s'),
            ]]);
    }
}
