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
            $table->string('category_name')->comment('類別名稱');
            $table->integer('type')->comment('1=>服務,2=>商品');
            $table->string('name')->comment('名稱');
            $table->string('number')->comment('產品編號');
            $table->integer('price')->comment('價格');
            $table->integer('final_price')->comment('最終價格');
            $table->integer('amount')->comment('數量');
            $table->integer('minute')->nullable()->comment('分鐘');
            $table->string('image')->comment('圖片');
            $table->bigInteger('coupon_id')->nullable()->comment('優惠券id');
            $table->bigInteger('event_id')->nullable()->comment('活動id');
            $table->string('event_name')->nullable()->comment('活動名稱');
            $table->string('coupon_name')->nullable()->comment('優惠券名稱');
            $table->decimal('coupon_discount', 5, 2)->default(0)->comment('優惠券折扣');
            $table->decimal('event_discount', 5, 2)->default(0)->comment('活動折扣');
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
