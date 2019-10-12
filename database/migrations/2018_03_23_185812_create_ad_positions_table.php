<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_positions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->comment('名称');
            $table->string('position', 30)->comment('位置标识');
            $table->tinyInteger('platform')->comment('平台：【0：PC， 1：Wap, 2:Api】');
            $table->tinyInteger('status')->comment('状态：【0：禁用， 1：正常】');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['name', 'position', 'status', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ad_positions');
    }
}
