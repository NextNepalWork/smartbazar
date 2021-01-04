<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuperCustomerWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('super_customer_wallets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('super_customer_id')->unsigned();
            $table->foreign('super_customer_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('total_amount')->nullable();
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
        Schema::dropIfExists('super_customer_wallets');
    }
}
