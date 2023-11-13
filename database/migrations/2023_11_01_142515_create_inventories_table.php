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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->comment('產品id');
            $table->bigInteger('admin_id')->nullable()->comment('管理員id');
            $table->string('number')->comment('異動單號');
            $table->tinyInteger('type')->comment('1=>進貨, 2=>入倉, 3=>出倉, 4=>銷售, 99=>退單');
            $table->integer('before_quantity')->comment('異動前數量');
            $table->integer('quantity')->comment('異動數量');
            $table->integer('after_quantity')->comment('異動後數量');
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
        Schema::dropIfExists('inventories');
    }
};
