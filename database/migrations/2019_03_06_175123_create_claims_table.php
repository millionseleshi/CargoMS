<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claims', function (Blueprint $table) {
             $table->bigIncrements('id');

             $table->integer('users_id')->unsigned()->nullable(); //registered user

             $table->string('claimersName')->nullable();
             $table->string('claimersAddress')->nullable();
             $table->string('claimersPhone')->nullable();
             $table->string('claimersEmail')->nullable();

             $table->string('AWB');
             $table->string('flightNo');
             $table->string('literaryAirline');
             $table->enum('irregularity',['loss','damage','pilferage'.'dead','sickOrInjured','other']);
             $table->mediumText('remark')->nullable();
             $table->string('estimatedValue');
             $table->mediumText('contentDescription');
             $table->enum('status',['unprocessed','settled'])->default('unprocessed');;
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
        Schema::dropIfExists('claims');
    }
}
