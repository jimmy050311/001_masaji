<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_point_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->comment('會員id');
            $table->bigInteger('admin_id')->nullable()->comment('管理員id');
            $table->string('ip')->comment('ip位置');
            $table->integer('before_point')->comment('更改前點數');
            $table->integer('balance')->comment('更改點數');
            $table->integer('after_point')->comment('更改後點數');
            $table->string('remark')->nullable()->comment('備註');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_point_logs');
    }
};
