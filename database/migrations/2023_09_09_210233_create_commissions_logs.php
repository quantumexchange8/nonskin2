<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionsLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commissions_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('downline_id');
            $table->integer('downline_rankid');
            $table->unsignedBigInteger('upline_id');
            $table->integer('upline_rankid');
            $table->double('upline_totalsales');
            $table->unsignedBigInteger('commission_id');
            $table->double('downline_sales');
            $table->double('percentage');
            $table->double('total_bonus');
            $table->string('remarks');
            $table->timestamps('commission_date');
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
        Schema::dropIfExists('commissions_logs');
    }
}
