<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id')->index('user_id')->nullable(false)->comment('用户id');;
            $table->bigInteger('article_id')->index('article_id')->nullable(false)->comment('文章id');
            $table->text('contents')->nullable(false)->comment('评论内容');
            $table->enum('is_delete', [0, 1])->default(0)->comment('0正常，1已删除');
            $table->timestamp('create_time')->comment('创建时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_comments');
    }
}
