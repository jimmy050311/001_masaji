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
        Schema::create('user_level_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->comment('會員id');
            $table->bigInteger('admin_id')->nullable()->comment('管理員id');
            $table->string('ip')->comment('ip位置');
            $table->tinyInteger('type')->comment('1=>系統自動升級, 2=>管理員手動升級');
            $table->integer('before_level')->comment('升級前等級');
            $table->integer('after_level')->comment('升級後等級');
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
        Schema::dropIfExists('user_level_logs');
    }
};
