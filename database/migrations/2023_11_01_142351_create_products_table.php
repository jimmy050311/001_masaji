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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('名稱');
            $table->string('image')->comment('照片');
            $table->string('number')->comment('產品編號');
            $table->integer('type')->comment('1=>服務, 2=>商品');
            $table->integer('category_id')->comment('類別id');
            $table->longText('spec')->nullable()->comment('規格');
            $table->longText('desc')->nullable()->comment('簡述');
            $table->longText('introduction')->nullable()->comment('介紹');
            $table->integer('amount')->default(0)->comment('數量');
            $table->integer('low_amount')->nullable()->comment('最低水位');
            $table->integer('minute')->nullable()->comment('時間');
            $table->integer('price')->comment('價格');
            $table->tinyInteger('status')->comment('1=>上架,2=>下架');
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
        Schema::dropIfExists('products');
    }
};
