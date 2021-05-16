<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('titles')->insert([
            'title' => '1这是我的标题-' . Str::random(10),
            'sub_title' => '子标题-' . Str::random(5),
            'contents' => '  1. 索引是什么？<br/></n>
		 	  对数据库来说，索引的作用就是给‘数据’加目录, 方便我们快速查询。
	 2.索引算法
			设有N条随机记录，不用索引，平均查找N/2次，那么用了索引之后呢？
			tree(二叉树)索引    log2N
			hash(哈希)索引　　1
	3.优缺点
			优点：加快了查询的速度(select)
			缺点：降低了增删改的速度(update/delete/insert)，索引占用表空间，增加了表的文件大小
	4.索引类型
		普通索引：仅仅是加快了查询速度
		唯一索引：行上的值不能重复
		主键索引：不能重复
		主键索引和唯一索引的区别：主键必唯一，但是唯一索引不一定是主键；
		一张表上只能有一个主键，但是可以有一个或多个唯一索引
		全文索引：fulltext index',
            'user_id' => 8,
            'key_words' => '关键字',
            'thumbs' => json_encode(['http://laravel-test.com/images/header.png']),
            'attachments' => json_encode(['http://laravel-test.com/images/header.png']),
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
