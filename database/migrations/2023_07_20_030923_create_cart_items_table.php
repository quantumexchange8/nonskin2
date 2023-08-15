<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->integer('cart_id')->unsigned()->comment('Refers to cart id');
            $table->integer('product_id')->unsigned()->comment('Refers to product id');
            $table->integer('quantity')->unsigned()->comment('Refers to quantity input by user');
            $table->double('price',7,2)->comment('Price of the product');
            $table->double('nett_price')->default(0);
            $table->double('discount_price')->nullable();
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
        Schema::dropIfExists('cart_items');
    }
}
