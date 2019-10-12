<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('star')->comment('评分');
            $table->text('body')->comment('内容');
            $table->integer('app_id')->foreign('id')->on('apps')->comment('小程序ID');
            $table->integer('member_id')->foreign('id')->on('members')->comment('用户ID');
            $table->boolean('is_reply')->default(false)->comment('回复：【0：未回复， 1：已回复】');
            $table->tinyInteger('status')->default(0)->comment('状态：【0：待审核， 1：正常】');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['app_id', 'member_id', 'is_reply', 'status', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
