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
        Schema::create('tracks', function (Blueprint $table) {
            $table->id();
            $table->string('city')->comment('城市');
            $table->string('country')->comment('國家');
            $table->string('hostname')->comment('');
            $table->string('ip')->comment('ip');
            $table->string('loc')->comment('經緯度');
            $table->string('org')->comment('地址');
            $table->string('region')->comment('地區');
            $table->string('timezone')->comment('時區');
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
        Schema::dropIfExists('tracks');
    }
};
