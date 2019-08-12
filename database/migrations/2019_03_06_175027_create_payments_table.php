<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Name');
            $table->string('FatherName');
            $table->string('GrandFatherName');
            $table->enum('paymentType',['bank','mobile']);
            $table->string('accountNumber')->nullable();
            $table->float('amountExpected');
            $table->float('amountPaid')->nullable();
            $table->string('receiptsId')->nullable();
            $table->string('AWB')->nullable();
            $table->string('paymentDate')->nullable();
//            $table->integer('users_id')->nullable();
            $table->enum('status',['verified','unverified'])->default('unverified');
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
        Schema::dropIfExists('payments');
    }
}
