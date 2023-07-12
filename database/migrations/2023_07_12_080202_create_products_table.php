<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable()->comment('Product code');
            $table->string('name-en')->nullable()->comment('Product name in English');
            $table->string('name-cn')->nullable()->comment('Product name in Chinese');
            $table->longText('desc_en')->nullable()->comment('Product description in English');
            $table->longText('desc_cn')->nullable()->comment('Product description in Chinese');
            $table->double('price')->nullable();
            $table->double('discount')->nullable();
            $table->tinyInteger('category');
            $table->tinyInteger('shipping_quantity');
            $table->string('image_1')->nullable();
            $table->string('image_2')->nullable();
            $table->string('image_3')->nullable();
            $table->string('image_4')->nullable();
            $table->string('image_5')->nullable();
            $table->string('status', 10)->nullable()->default('Active')->comment('Product Active/Inactive');
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
        Schema::dropIfExists('products');
    }
}
