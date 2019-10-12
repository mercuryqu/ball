<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->comment('名称');
            $table->string('icon', 1000)->comment('图标');
            $table->integer('parent_category_id')->comment('上级ID');
            $table->tinyInteger('level')->comment('级别');
            $table->integer('sort')->default(0)->comment('排序');
            $table->tinyInteger('status')->default(0)->comment('状态：【0：隐藏， 1：显示】');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['name', 'parent_category_id', 'level', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
