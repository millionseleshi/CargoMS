<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('shipperName');
            $table->string('shipperAddress');
            $table->string('shipperPhoneNumber');
            $table->string('shipperEmail');

            $table->string('consigneeName');
            $table->string('consigneeAddress');
            $table->string('consigneePhoneNumber');
            $table->string('consigneeEmail');
            $table->string('flightNo');
            $table->enum('shipmentType',['radioactive','perishable','live animal','general Cargo','valuable item','vehicles','dangerous goods']);
            $table->float('totalWeight');

            $table->string('AWB');
            $table->enum('validity',['valid','unchecked','invalid'])->default('unchecked');;
            $table->enum('status',['pickup','checkin','processing','checkout','delivered']);
//                   pickup=> shipper-deliverer
//                   checkin=> deliverer-forwarder
//                   processing=>@forwarder processing+flight
//                   checkout=> forwarder-deliver

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
        Schema::dropIfExists('shipments');
    }
}
