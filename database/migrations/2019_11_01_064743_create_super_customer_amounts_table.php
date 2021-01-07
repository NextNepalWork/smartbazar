<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuperCustomerAmountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('super_customer_amounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('super_customer_id')->unsigned();
            $table->foreign('super_customer_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('status')->unsigned();
            $table->foreign('status')->references('order_status_id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
            $table->string('amount');
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
        Schema::dropIfExists('super_customer_amounts');
    }
}
