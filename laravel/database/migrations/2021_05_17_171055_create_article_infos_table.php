<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('artitle_id')->index('artitle_id')->nullable(false)->comment('文章id');
            $table->text('contents')->comment('文章内容');
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
        Schema::dropIfExists('article_infos');
    }
}
