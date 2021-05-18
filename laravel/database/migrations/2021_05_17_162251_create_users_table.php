<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_name', '128')->nullable(false)->comment('用户名称');
            $table->string('nick_name', '128')->nullable()->comment('用户昵称');
            $table->char('passwd', '128')->nullable(false)->comment('加密后密码');
            $table->string('email', '64')->nullable()->comment('邮箱');
            $table->string('avator')->nullable()->comment('头像url');
            $table->char('phone', 11)->nullable(false)->comment('电话');
            $table->enum('is_auth', [0, 1])->default(1)->comment('是否启用,0不启用，1启用');
            $table->string('remark')->nullable()->default('这个人很懒, 什么也没留下')->comment('备注');
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
        Schema::dropIfExists('users');
    }
}
