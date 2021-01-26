<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockBPCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_BP_cars', function (Blueprint $table) {
            $table->bigIncrements('BPCar_id');
            $table->integer('BPCus_id');
            $table->string('BPCar_regisCar')->nullable();
            $table->string('BPCar_carBrand')->nullable();
            $table->string('BPCar_carModel')->nullable();
            $table->string('BPCar_carColor')->nullable();
            $table->string('BPCar_carYear')->nullable();
            $table->string('BPCar_carRepair')->nullable();
            $table->string('BPCar_carFinished')->nullable();
            $table->string('BPCar_carDelivered')->nullable();
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
        Schema::dropIfExists('stock_BP_cars');
    }
}
