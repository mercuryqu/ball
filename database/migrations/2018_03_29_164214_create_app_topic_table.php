<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppTopicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_topic', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('app_id')->foreign('id')->on('apps')->comment('小程序ID');
            $table->integer('topic_id')->foreign('id')->on('topics')->comment('专题ID');
            $table->integer('sort')->default(0)->comment('排序');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['app_id', 'topic_id', 'sort', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_topic');
    }
}
