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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('number')->comment('訂單編號');
            $table->bigInteger('user_id')->comment('會員id');
            $table->integer('level_id')->comment('等級id');
            $table->integer('total')->comment('小計');
            $table->integer('extra_discount')->comment('額外折扣');
            $table->integer('total_discount')->comment('總折扣');
            $table->integer('amount')->comment('購買數量');
            $table->integer('final_total')->comment('最終金額');
            $table->tinyInteger('status')->comment('0=>未付款, 1=>已付款, 99=>已退貨');
            $table->string('remark')->nullable()->comment('備註');
            $table->dateTime('paid_at')->nullable()->comment('付款時間');
            $table->dateTime('refund_at')->nullable()->comment('退款時間');
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
        Schema::dropIfExists('orders');
    }
};
