<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('avatar');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(array('name'=>'default','email'=>'default@currenttech', 'avatar' => '', 'password'=>Hash::make('defaultsecret')));
        DB::table('users')->insert(array('name'=>'Superadmin','email'=>'superadmin@currenttech', 'avatar' => '', 'password'=>Hash::make('secret')));
        DB::table('users')->insert(array('name'=>'Admin','email'=>'admin@nonskin', 'avatar' => '', 'password'=>Hash::make('secret')));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
