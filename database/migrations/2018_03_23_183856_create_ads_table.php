<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->comment('名称');
            $table->string('instruction', 1000)->comment('描述');
            $table->tinyInteger('jump_type')->comment('跳转类型【0：关联小程序， 1：自定义】');
            $table->integer('app_id')->foreign('id')->on('apps')->nullable()->comment('小程序ID(jump_type为0时设置)');
            $table->string('image_url', 1000)->comment('图片URL');
            $table->string('jump_url', 1000)->nullable()->comment('跳转URL(jump_type为1时设置)');
            $table->tinyInteger('platform')->comment('平台：【0：PC， 1：Wap, 2:Api】');
            $table->integer('ad_position_id')->foreign('id')->on('ad_positions')->comment('广告位ID');
            $table->dateTime('start_at')->comment('开始时间');
            $table->dateTime('end_at')->comment('结束时间');
            $table->integer('sort')->default(0)->comment('排序');
            $table->tinyInteger('status')->comment('状态：【0：待审核， 1：正常， 2：禁用】');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['name', 'app_id', 'platform', 'ad_position_id', 'status', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads');
    }
}
