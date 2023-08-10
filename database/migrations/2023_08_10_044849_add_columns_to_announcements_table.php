<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('announcements', function (Blueprint $table) {
            $table->string('image')->nullable()->after('content');
            $table->date('start_date')->nullable()->after('image');
            $table->date('end_date')->nullable()->after('start_date');
            $table->string('recipient')->nullable()->after('end_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('announcements', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');
            $table->dropColumn('recipient');
        });
    }
}
