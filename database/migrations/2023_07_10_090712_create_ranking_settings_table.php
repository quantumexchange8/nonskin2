<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRankingSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ranking_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('desc');
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
        Schema::dropIfExists('ranking_settings');
    }
}
