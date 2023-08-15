<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlySalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('month');
            $table->year('year');
            $table->double('personal_sales', 0, 2)->default(0);
            $table->double('direct_sales', 0, 2)->default(0);
            $table->double('total_sales', 0, 2)->default(0);
            $table->double('group_direct_sales', 0, 2)->default(0);
            $table->double('group_sales', 0, 2)->default(0);
            $table->timestamps();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monthly_sales');
    }
}
