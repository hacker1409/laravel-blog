<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleZansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_zans', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id')->index('user_id')->nullable(false)->comment('用户id');
            $table->bigInteger('artitle_id')->index('artitle_id')->nullable(false)->comment('文章id');
            $table->enum('type', [1, 2, 3, 4])->default(1)->index('type')->comment('1点赞，2评论数，3关注数 4浏览数');
            $table->bigInteger('times')->default(0)->comment('次数');
            $table->enum('is_delete', [0, 1])->default(0)->comment('0正常，1已删除');
            $table->timestamp('create_time')->comment('创建时间');
            $table->timestamp('update_time')->comment('修改时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_zans');
    }
}
