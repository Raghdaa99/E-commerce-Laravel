<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number');
//            $table->integer('quantity');
            $table->double('total_price');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('company_name');
            $table->string('zip_code');
            $table->string('email');
            $table->string('country');
            $table->string('street_address');
            $table->string('city');
            $table->string('phone');
            $table->enum('payment_method',['cod','paypal'])->default('cod');
            $table->enum('payment_status',['paid','unpaid'])->default('unpaid');
            $table->enum('status',['new','process','delivered','cancel'])->default('new');

            $table->mediumText('comment');
//            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('shipping_id')->nullable();
//            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('shipping_id')->references('id')->on('shippings')->onDelete('SET NULL');
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
        Schema::dropIfExists('orders');
    }
}
