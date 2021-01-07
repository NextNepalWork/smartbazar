<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuperCustomerLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('super_customer_links', function (Blueprint $table) {
            $table->increments('id');
            $table->string('refer_link', '1000');
            $table->string('product_link', 1000);
            $table->string('token', 1000);
            $table->integer('product_id')->nullable();
            $table->integer('super_customer_id')->unsigned();
//            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('super_customer_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('super_customer_links');
    }
}
