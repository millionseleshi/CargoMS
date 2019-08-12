<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('companyName');
            $table->string('phoneNumber');
            $table->string('AlternatePhoneNumber')->nullable();;
            $table->string('email');
            $table->string('address');//Combine city-subcity-woreda-HN
            $table->mediumText('about')->nullable();;
            $table->enum('type',['forwarder','deliverer']);
            $table->boolean('status')->default('1'); //active
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
        Schema::dropIfExists('organizations');
    }
}
