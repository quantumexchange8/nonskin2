<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_infos', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable();
            $table->longText('address', 200)->nullable();
            $table->string('contact', 20)->nullable();
            $table->string('register_no', 20)->nullable();
            $table->longText('description')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_acc')->nullable();
            $table->string('bank_holder_name')->nullable();
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
        Schema::dropIfExists('company_infos');
    }
}
