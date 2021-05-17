<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('artitle_id')->index('artitle_id')->nullable(false)->comment('文章id');
            $table->enum('type', [1, 2])->default(1)->comment('1图片，2附件');
            $table->string('attachs')->nullable()->comment('附件信息');
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
        Schema::dropIfExists('article_attachments');
    }
}
