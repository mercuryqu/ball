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
            $table->increments('id');
            $table->string('name', 30)->comment('名称');
            $table->string('username', 50)->comment('用户名');
            $table->string('avatar', 200)->comment('头像');
            $table->char('telephone', 20)->comment('手机号');
            $table->string('email')->unique()->comment('邮箱');
            $table->string('password')->comment('密码');
            $table->rememberToken();
            $table->tinyInteger('status')->comment('状态：【0：待审核， 1：正常， 2：禁用】');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['name', 'username', 'telephone', 'email', 'status', 'created_at']);
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
