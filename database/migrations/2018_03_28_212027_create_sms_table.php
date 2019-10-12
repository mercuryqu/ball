<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms', function (Blueprint $table) {
            $table->increments('id');
            $table->char('telephone', 20)->comment('手机号码');
            $table->string('body', 255)->comment('发送内容');
            $table->tinyInteger('type')->comment('类型【0：登录， 1：其他】');
            $table->string('code', 15)->nullable()->comment('验证码');
            $table->string('comment', 255)->nullable()->comment('备注');
            $table->tinyInteger('status')->comment('状态【0：已发送， 1：发送失败， 2：已使用】');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['telephone', 'type', 'code', 'status', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms');
    }
}
