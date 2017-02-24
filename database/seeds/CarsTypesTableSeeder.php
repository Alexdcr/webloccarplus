<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CarsTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			DB::table('cars_types')->insert([
          'model' => 'touring',  //Touring Cars
          'created_at' => Carbon::now()
      ]);
      DB::table('cars_types')->insert([
          'model' => 'sports',  //Sports Car
          'created_at' => Carbon::now()
      ]);
      DB::table('cars_types')->insert([
          'model' => 'pickup', //Truck or Pickup Car
          'created_at' => Carbon::now()
      ]);
    }
}
