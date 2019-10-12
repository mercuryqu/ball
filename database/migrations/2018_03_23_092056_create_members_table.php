<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->unique()->comment('名称');
            $table->string('username', 50)->nullable()->unique()->comment('用户名');
            $table->char('telephone', 20)->unique()->comment('手机号');
            $table->string('email', 100)->nullable()->unique()->comment('邮箱');
            $table->string('avatar', 200)->comment('头像');
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
        Schema::dropIfExists('members');
    }
}
