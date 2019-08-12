<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('carrier');
            $table->string('flightNumber');
            $table->double('maxWidth');
            $table->double('maxLength');
            $table->double('maxHeight');
            $table->float('maxWeight');

            $table->string('from');
            $table->string('to');
            $table->dateTime('departureDate');
            $table->dateTime('arrivalDate');

            $table->integer('shipments_id')->nullable();//fk
            $table->enum('status',['takeoff','landed']);
            $table->boolean('available')->default('1');
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
        Schema::dropIfExists('cargos');
    }
}
