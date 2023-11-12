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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('名稱');
            $table->string('account')->comment('帳號');
            $table->string('password')->comment('密碼');
            $table->string('email')->nullable()->comment('信箱');
            $table->string('refcode')->comment('推薦碼');
            $table->string('phone')->comment('手機');
            $table->tinyInteger('status')->comment('0=>停權,1=>開通');
            $table->tinyInteger('gender')->comment('1=>男性,2=>女性');
            $table->dateTime('birth')->nullable()->comment('生日');
            $table->integer('level_id')->comment('等級');
            $table->string('address')->nullable()->comment('地址');
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
        Schema::dropIfExists('users');
    }
};
