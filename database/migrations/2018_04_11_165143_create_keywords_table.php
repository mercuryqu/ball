<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeywordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keywords', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->unique()->comment('名称');
            $table->integer('sort')->default(0)->comment('排序');
            $table->integer('times')->default(0)->comment('次数');
            $table->tinyInteger('status')->comment('状态：【0：禁用， 1：正常】');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['name', 'sort', 'times', 'status', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keywords');
    }
}
