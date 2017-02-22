<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_cars', function (Blueprint $table) {
            $table->increments('id');
						$table->decimal('long', 10, 7);
						$table->decimal('lat', 10, 7);
						$table->integer('user_car_id')->unsigned();
            $table->foreign('user_car_id')->references('id')->on('user_cars')->onDelete('cascade');
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
        Schema::dropIfExists('location_cars');
    }
}
