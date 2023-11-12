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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('名稱');
            $table->integer('type')->default(1)->comment('1=>種類(目前只有類別一種)');
            $table->string('code')->comment('代碼');
            $table->decimal('discount', 3, 2)->comment('折扣');
            $table->string('desc')->comment('簡述');
            $table->tinyInteger('status')->comment('0=>下架, 1=>上架');
            $table->dateTime('start_date')->comment('開始時間');
            $table->dateTime('end_date')->comment('結束時間');
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
        Schema::dropIfExists('coupons');
    }
};
