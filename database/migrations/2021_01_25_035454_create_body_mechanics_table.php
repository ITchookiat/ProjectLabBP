<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBodyMechanicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('body_mechanics', function (Blueprint $table) {
            $table->bigIncrements('BPMec_id');
            $table->integer('BPCus_id');
            $table->string('BPMec_Status')->nullable();
            $table->string('BPMec_StartDate')->nullable();
            $table->string('BPMec_StopDate')->nullable();
            $table->string('BPMec_UserRespon')->nullable();

            $table->string('BPMec_Note')->nullable();
            $table->string('BPMec_UserUpdate')->nullable();
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
        Schema::dropIfExists('body_mechanics');
    }
}
