<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRankingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rankings', function (Blueprint $table) {
            $table->id();
            $table->integer('level');
            $table->string('name');
            $table->double('personal_sales', 9, 2);
            $table->double('package_requirement', 9, 2);
            $table->double('group_sale_requirement',9, 2);
            $table->double('group_package', 9, 2);
            $table->double('level_discount',5, 2);
            $table->string('direct_member')->nullable();
            $table->string('direct_member_rank')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->string('rank_short', 255);
            $table->string('category', 255);
            $table->double('upgrade_ranking_sales', 9, 2)->default(0);
            $table->double('upgrade_level');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rankings');
    }
}
