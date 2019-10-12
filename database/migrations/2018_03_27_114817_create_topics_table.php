<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('banner', 1000)->comment('banner图');
            $table->string('title', 150)->comment('标题');
            $table->text('body')->comment('内容');
            $table->text('style')->comment('样式');
            $table->tinyInteger('status')->comment('状态：【0：禁用， 1：正常】');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['title', 'status', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topics');
    }
}
