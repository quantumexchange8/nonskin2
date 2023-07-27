<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_num')->nullable();
            $table->string('type')->nullable();
            $table->integer('user_id')->unsigned()->comment('Refers to user id');
            $table->double('amount',9,2)->unsigned();
            $table->string('gateway')->nullable();
            $table->string('status')->nullable();
            $table->string('remarks')->nullable();
            $table->string('receipt')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_holder_name')->nullable();
            $table->string('bank_acc_no')->nullable();
            $table->string('bank_ic')->nullable();
            $table->text('reason')->nullable()->default('text');
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
        Schema::dropIfExists('payments');
    }
}
