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
            $table->bigInteger('referral')->nullable();
            $table->string('referrer')->nullable();
            $table->string('hierarchyList')->nullable();
            $table->string('username')->nullable()->unique();
            $table->string('contact')->nullable()->unique();
            $table->string('email')->unique();
            $table->string('name');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('avatar');
            $table->rememberToken();
            $table->integer('ranking_id')->unsigned()->nullable();
            $table->string('ranking_name')->nullable();
            $table->integer('role_id');
            $table->string('role');
            $table->string('address_1')->nullable()->default('-');
            $table->string('address_2')->nullable()->default('-');
            $table->string('city')->nullable()->default('-');
            $table->string('postcode', 5)->nullable()->default('-');
            $table->string('state')->nullable()->default('-');
            $table->string('country')->nullable()->default('-');
            $table->string('bank_name')->default('-');
            $table->string('bank_holder_name')->default('-');
            $table->string('bank_acc_no')->default('-');
            $table->string('bank_ic')->default('-');
            $table->string('delivery_address_1')->nullable()->default('-');
            $table->string('delivery_address_2')->nullable()->default('-');
            $table->string('delivery_city')->nullable()->default('-');
            $table->string('delivery_postcode', 5)->nullable()->default('-');
            $table->string('delivery_state')->nullable()->default('-');
            $table->string('delivery_country')->nullable()->default('-');
            $table->timestamps();
            $table->integer('created_by')->unsigned()->nullable()->comment('Refers to user id');
            $table->integer('updated_by')->unsigned()->nullable()->comment('Refers to user id');
        });

        // DB::table('users')->insert(array('name'=>'default','email'=>'default@currenttech', 'avatar' => '', 'password'=>Hash::make('defaultsecret')));
        // DB::table('users')->insert(array('name'=>'Superadmin','email'=>'superadmin@currenttech', 'avatar' => '', 'password'=>Hash::make('secret')));
        // DB::table('users')->insert(array('name'=>'Admin','email'=>'admin@nonskin', 'avatar' => '', 'password'=>Hash::make('secret')));
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
