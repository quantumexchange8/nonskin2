<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRankingUpdateLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ranking_update_log', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('old_rank');
            $table->integer('new_rank');
            $table->double('user_package_amount');
            $table->double('target_package_amount');
            $table->double('user_group_sales');
            $table->double('target_group_sales');
            $table->integer('user_cultivate_member_amount')->default(null);
            $table->integer('target_cultivate_member_amount')->default(null);
            $table->integer('target_cultivate_type_id')->default(null);
            $table->longText('referrals_with_target_cultivate_type')
                  ->charset('utf8mb4')
                  ->collation('utf8mb4_0900_ai_ci');
            $table->double('user_personal_sales');
            $table->double('target_personal_sales');
            $table->string('type', 10)->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
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
        Schema::dropIfExists('ranking_update_log');
    }
}
