<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

//        factory(\App\User::class,74)->create();
//        factory(\App\Countries::class,64)->create();
//        factory(\App\Organization::class,100)->create();
//        factory(\App\Deliverer::class,100)->create();
//        factory(\App\Forwarder::class,100)->create();
//        factory(\App\ShipmentDetail::class,256)->create();
//        factory(\App\Shipment::class,100)->create();
//        factory(\App\Payment::class,1)->create();/
//        factory(\App\Cargo::class,30)->create();
        factory(\App\deliveries::class,30)->create();


    }
}
