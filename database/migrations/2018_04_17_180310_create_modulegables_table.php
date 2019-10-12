<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulegablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modulegables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('module_id')->foreign('id')->on('modules')->comment('模块ID');
            $table->integer('modulegable_id')->foreign('id')->comment('对象ID');
            $table->char('modulegable_type', 20)->comment('对象：【topics：专题, apps：小程序】');
            $table->integer('sort')->default(0)->comment('排序');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['module_id', 'modulegable_id', 'sort', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('module_app');
    }
}
