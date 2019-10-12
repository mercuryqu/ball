<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->unique()->comment('名称');
            $table->tinyInteger('type')->comment('类型：【0：专题模块， 1：侧滑模块，2：专题加侧滑模块， 3：点跳模块】');
            $table->integer('sort')->default(0)->comment('排序');
            $table->tinyInteger('status')->comment('状态：【0：禁用， 1：正常】');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['name', 'type', 'sort', 'status', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modules');
    }
}
