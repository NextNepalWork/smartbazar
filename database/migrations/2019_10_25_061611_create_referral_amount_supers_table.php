<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferralAmountSupersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referral_amount_supers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('super_vendor_id')->unsigned();
            $table->foreign('super_vendor_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('referral_amount_supers');
    }
}
