<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->unique()->comment('名称');
            $table->string('slogan', 50)->nullable()->comment('口号');
            $table->string('keyword', 255)->nullable()->comment('关键词');
            $table->text('instruction')->nullable()->comment('简介');
            $table->integer('member_id')->foreign('id')->on('members')->comment('所属用户');
            $table->string('logo', 1000)->comment('Logo');
            $table->string('code', 1000)->comment('二维码');
            $table->tinyInteger('star')->default(0)->comment('评分');
            $table->integer('view_count')->default(0)->comment('阅读数');
            $table->boolean('is_recommended')->default(0)->comment('是否推荐：【0：否， 1：是】');
            $table->tinyInteger('status')->default(0)->comment('状态：【0：待审核， 1：正常, 2：未通过】');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['name', 'member_id', 'star', 'view_count', 'status', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apps');
    }
}
