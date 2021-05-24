<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('full_name')->nullable();
            $table->date('DOB')->nullable();
            $table->integer('gender_id')->nullable();
//            $table->string('avatar')->nullable();
            $table->string('avatar')->default('avatars/User-Default.jpg');
            $table->rememberToken();
            $table->timestamps();

//            Username(unique)
//            Email(unique)
//            Password(hash)
//            Confirm password
//            Full name
//            DOB
//            Gender
//            Avatar
        });
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
