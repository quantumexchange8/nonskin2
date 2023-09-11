<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRankingUpdateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ranking_update_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('old_rank');
            $table->integer('new_rank');
            $table->double('user_package_amount');
            $table->double('target_package_amount');
            $table->double('user_group_sales');
            $table->double('target_group_sales');
            $table->double('user_group_package');
            $table->double('target_group_package');
            $table->double('user_personal_sales');
            $table->double('target_personal_sales');
            $table->string('type', 10)->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('remarks')->nullable();
            $table->timestamps();
            // $table->foreign('user_id')
            //     ->references('id')
            //     ->on('users')
            //     ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ranking_update_logs');
    }
}
