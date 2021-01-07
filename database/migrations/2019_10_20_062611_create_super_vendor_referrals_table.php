<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuperVendorReferralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('super_vendor_referrals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('referral_id')->unsigned();
            $table->boolean('status')->default('0');
            $table->foreign('referral_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('super_vendor_referrals');
    }
}
