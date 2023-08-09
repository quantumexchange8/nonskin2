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
            $table->bigInteger('upline_id')->nullable();
            $table->string('referrer_id')->unique()->nullable();
            $table->string('hierarchyList')->nullable();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('full_name');
            $table->string('id_no')->unique();
            $table->string('contact')->unique();
            $table->string('password');
            $table->string('role')->default('user');
            $table->string('superadmin')->default(0);
            $table->string('member_type')->default('customer');
            $table->string('cash_wallet')->nullable();
            $table->string('commission_wallet')->nullable();
            $table->string('bonus_quota')->nullable();
            $table->string('network')->nullable();
            $table->string('direct_sponsor')->nullable();
            $table->string('daily_sales')->nullable();
            $table->string('personal_sales')->nullable();
            $table->string('direct_sales')->nullable();
            $table->string('total_sales')->nullable();
            $table->string('group_sales')->nullable();
            $table->string('personal_ranking')->nullable();
            $table->string('address_1');
            $table->string('address_2')->nullable();
            $table->string('city', 50);
            $table->string('postcode', 5);
            $table->string('state', 50);
            $table->string('country', 50);
            $table->string('bank_name')->nullable();
            $table->string('bank_holder_name')->nullable();
            $table->string('bank_acc_no')->nullable();
            $table->string('bank_ic')->nullable();
            $table->string('delivery_address_1', 180);
            $table->string('delivery_address_2', 180)->nullable();
            $table->string('delivery_city', 50);
            $table->string('delivery_postcode', 50);
            $table->string('delivery_state', 50);
            $table->string('delivery_country', 50);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->string('status')->default('Active');
            $table->timestamps();
            $table->string('avatar')->nullable();
            $table->tinyInteger('is_active')->default(1)->comment('0 - Inactive, 1 - Active');
            $table->tinyInteger('is_legacy')->default(0)->comment('0 - New User, 1 - Old existing users');
            $table->unsignedBigInteger('rank_id')->nullable();
            // $table->foreign('rank_id')
            //     ->references('id')
            //     ->on('ranking')
            //     ->onUpdate('cascade');
            $table->softDeletes();
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
