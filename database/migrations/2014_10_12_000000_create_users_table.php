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
            $table->string('username')->unique();
            $table->string('contact')->unique();
            $table->string('email')->unique();
            $table->string('name');
            $table->string('id_no')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('avatar');
            $table->rememberToken();
            $table->integer('ranking_id')->unsigned()->nullable();
            $table->string('ranking_name')->nullable();
            $table->integer('role_id');
            $table->string('role');
            $table->string('address_1');
            $table->string('address_2')->nullable()->default('-');
            $table->string('city');
            $table->string('postcode', 5);
            $table->string('state');
            $table->string('country');
            $table->string('bank_name');
            $table->string('bank_holder_name');
            $table->string('bank_acc_no');
            $table->string('bank_ic');
            $table->string('delivery_address_1');
            $table->string('delivery_address_2')->nullable()->default('-');
            $table->string('delivery_city');
            $table->string('delivery_postcode', 5);
            $table->string('delivery_state');
            $table->string('delivery_country');
            $table->string('remarks', 10)->default('New User');
            $table->tinyInteger('is_legacy')->default(0)->comment('0 - New User, 1 - Old existing users');
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
