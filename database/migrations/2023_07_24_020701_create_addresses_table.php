<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->comment('Refers to user id');
            $table->string('name', 100)->nullable();
            $table->string('contact', 15)->nullable();
            $table->boolean('is_default')->nullable()->default(false);
            $table->string('address_1', 180);
            $table->string('address_2', 180)->nullable();
            $table->string('postcode', 5);
            $table->string('city', 50);
            $table->string('state', 50);
            $table->string('country', 50);
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
        Schema::dropIfExists('addresses');
    }
}
