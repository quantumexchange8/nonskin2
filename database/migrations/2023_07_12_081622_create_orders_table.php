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
            $table->integer('user_id')->unsigned()->nullable()->comment('Belongs to user id');
            $table->integer('payment_id')->unsigned()->nullable()->comment('Refers to payments table');
            $table->string('order_num')->unique();
            $table->double('price', 9, 2)->default(0);
            $table->double('discount_amt', 9, 2)->default(0);
            $table->double('delivery_fee',4,2);
            $table->double('nett_price', 9, 2)->default(0);//subtotal + delivery_fee
            $table->double('product_wallet', 9, 2)->default(0);//product wallet
            $table->double('total_amount',9,2)->unsigned(); //price - discount
            $table->string('receiver');
            $table->string('contact');
            $table->string('email');
            $table->string('delivery_method');
            $table->string('payment_method');
            $table->string('delivery_address');
            $table->string('status')->default('1');
            $table->string('courier')->nullable();
            $table->string('cn')->nullable();
            $table->string('tracking_number')->nullable();
            $table->longText('remarks')->nullable();
            $table->string('payment_proof')->nullable();
            $table->timestamps();
            $table->integer('created_by')->unsigned()->nullable()->comment('Refers to user id');
            $table->integer('updated_by')->unsigned()->nullable()->comment('Refers to user id');
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
