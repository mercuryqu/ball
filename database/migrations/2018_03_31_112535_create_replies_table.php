<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->increments('id');
            $table->text('body')->comment('内容');
            $table->integer('comment_id')->foreign('id')->on('comments')->comment('评论ID');
            $table->integer('user_id')->foreign('id')->on('users')->comment('管理员ID');
            $table->tinyInteger('status')->comment('状态：【0：隐藏， 1：正常】');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['comment_id', 'user_id', 'status', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('replies');
    }
}
