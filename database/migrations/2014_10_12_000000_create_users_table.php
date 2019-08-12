<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('firstName');
            $table->string('middleName');
            $table->string('lastName');

            $table->string('phoneNumber');
            $table->string('AlternatePhoneNumber')->nullable();

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();

            $table->string('address'); //Combine city-subcity-woreda-HN

            $table->string('userName')->nullable();
            $table->string('password')->nullable();
            $table->string('userImage')->nullable();
            $table->enum('role',['admin','customer','Femployee','Demployee'])->default('customer');
            $table->boolean('status')->default('1'); //active
            $table->rememberToken();

            $table->timestamps();
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
