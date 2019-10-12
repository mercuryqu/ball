<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppExamineLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_examine_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('app_id')->foreign('id')->on('apps')->comment('小程序ID');
            $table->text('reason')->comment('理由');
            $table->tinyInteger('status')->comment('状态：【0：未通过，1：通过，2：上架，3：下架 】');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_examine_logs');
    }
}
