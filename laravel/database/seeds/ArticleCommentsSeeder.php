<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleCommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('article_comments')->insert([
            'user_id' => 1,
            'article_id' => 1,
            'contents' => '这是一个很好的个人博客网站，运用了很多技术栈，值得学习',
            'create_time' => date('Y-m-d H:i:s'),
        ]);
    }
}
