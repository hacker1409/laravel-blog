<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->index('user_id')->nullable(false)->comment('用户id');
            $table->string('name', '128')->nullable()->comment('文章名称');
            $table->string('summary', '512')->nullable()->comment('概要');
            $table->enum('type', [1])->default(1)->index('type')->comment('文章类型');
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
        Schema::dropIfExists('articles');
    }
}
