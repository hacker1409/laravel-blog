<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artitles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 64)->comment('文章标题');
            $table->string('sub_title', 128)->comment('文章子标题');
            $table->bigInteger('user_id')->comment('发表者id');
            $table->text('contents')->comment('文章内容');
            $table->string('key_words', 128)->comment('关键字');
            $table->text('thumbs')->comment('缩略图地址');
            $table->text('attachments')->comment('附件地址');
            $table->tinyInteger('is_delete')->default(0)->comment('是否删除0默认，1删除');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('titles');
    }
}
