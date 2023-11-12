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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->comment('訂單id');
            $table->bigInteger('product_id')->comment('產品id');
            $table->bigInteger('category_id')->comment('類別id');
            $table->integer('type')->comment('1=>服務,2=>商品');
            $table->string('name')->comment('名稱');
            $table->string('number')->comment('產品編號');
            $table->integer('price')->comment('價格');
            $table->integer('amount')->comment('數量');
            $table->integer('minute')->nullable()->comment('分鐘');
            $table->string('image')->comment('圖片');
            $table->bigInteger('coupon_id')->nullable()->comment('優惠券id');
            $table->bigInteger('event_id')->nullable()->comment('活動id');
            $table->integer('coupon_discount')->default(0)->comment('優惠券折扣');
            $table->integer('event_discount')->default(0)->comment('活動折扣');
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
        Schema::dropIfExists('order_details');
    }
};
