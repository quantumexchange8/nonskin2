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
            $table->string('name')->nullable();
            $table->longText('description')->nullable();
            $table->double('price')->nullable();
            $table->double('discount')->default(0);
            $table->tinyInteger('category_id');
            $table->tinyInteger('shipping_quantity')->default(1);
            $table->double('weight')->default(0);
            $table->string('image_1')->nullable();
            $table->string('image_2')->nullable();
            $table->string('image_3')->nullable();
            $table->string('image_4')->nullable();
            $table->string('image_5')->nullable();
            $table->string('status', 10)->nullable()->default('Active')->comment('Product Active/Inactive');
            $table->string('remarks', 10)->nullable()->default('Nonskin')->comment('Product remarks');
            $table->timestamps();
            $table->softDeletes();
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
