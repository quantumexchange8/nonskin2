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
            $table->double('total_amount')->nullable();
            $table->string('receiver')->nullable();
            $table->string('contact')->nullable();
            $table->string('email')->nullable();
            $table->string('delivery_method')->nullable()->default('delivery');
            $table->string('delivery_address')->nullable();
            $table->double('delivery_fee')->nullable();
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
