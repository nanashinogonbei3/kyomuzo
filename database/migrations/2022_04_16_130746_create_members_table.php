<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('email')->comment('emailアドレス');
            $table->string('password')->comment('パスワード');         
            $table->string('first_name')->comment('なまえ');
            $table->string('last_name')->comment('氏名');
            $table->string('phone_number')->comment('電話番号');
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
        Schema::dropIfExists('members');
    }
}
