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
            $table->string('BPMec_KnockRespon')->nullable();
            $table->string('BPMec_RemoveRespon')->nullable();
            $table->string('BPMec_PrepareRespon')->nullable();
            $table->string('BPMec_PaintRespon')->nullable();
            $table->string('BPMec_AssembleRespon')->nullable();
            $table->string('BPMec_PolishRespon')->nullable();
            $table->string('BPMec_WashRespon')->nullable();
            $table->string('BPMec_DeliverRespon')->nullable();

            $table->string('BPMec_KnockDate')->nullable();
            $table->string('BPMec_RemoveDate')->nullable();
            $table->string('BPMec_PrepareDate')->nullable();
            $table->string('BPMec_PaintDate')->nullable();
            $table->string('BPMec_AssembleDate')->nullable();
            $table->string('BPMec_PolishDate')->nullable();
            $table->string('BPMec_WashDate')->nullable();
            $table->string('BPMec_DeliverDate')->nullable();

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
