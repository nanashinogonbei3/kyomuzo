<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('shop_name')->comment('店舗名');
            $table->string('phone_number')->comment('電話番号');
            $table->double('latitude')->comment('緯度');
            $table->double('longitude')->comment('経度');
            $table->string('postal_code')->comment('郵便番号');
            $table->string('address1')->comment('都道府県');
            $table->string('address2')->comment('市区名');
            $table->string('address3')->comment('町名');
            $table->string('address4')->comment('番地');
            $table->string('address5')->comment('建物名');
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
        Schema::dropIfExists('shops');
    }
}
