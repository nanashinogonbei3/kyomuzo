<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->Integer('product_id')->comment('商品ID');
	        $table->Integer('shop_id')->comment('店舗ID');
     	    $table->Integer('stock_quantity')->comment('在庫個数')->default(0);		
            $table->Date('sales_date')->comment('販売日')->nullable();
            $table->Date('production_date')->comment('製造年月日')->nullable();
            $table->Integer('member_id')->comment('メンバーID');
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
        Schema::dropIfExists('stocks');
    }
}
