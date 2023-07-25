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
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('order_num')->nullable();
            $table->double('total_amount',9,2)->unsigned()->default(0);
            $table->string('receiver');
            $table->string('contact');
            $table->string('email')->nullable();
            $table->string('delivery_method')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('delivery_address');
            $table->double('delivery_fee');
            $table->string('status')->nullable()->default('New');
            $table->string('courier')->nullable();
            $table->string('cn')->nullable();
            $table->string('tracking_number')->nullable();
            $table->longText('remarks')->nullable();
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
