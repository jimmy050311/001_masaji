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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('名稱');
            $table->string('account')->comment('帳號');
            $table->string('password')->comment('密碼');
            $table->string('phone')->comment('電話');
            $table->string('email')->comment('信箱');
            $table->integer('verify_id')->comment('權限id');
            $table->tinyInteger('status')->comment('0=>停權, 1=>開通');
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
        Schema::dropIfExists('admins');
    }
};
