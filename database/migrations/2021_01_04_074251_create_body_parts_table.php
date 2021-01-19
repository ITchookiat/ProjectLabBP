<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBodyPartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('body_parts', function (Blueprint $table) {
            $table->bigIncrements('BPPart_id');
            $table->integer('BPCus_id');
            $table->string('BPPart_date')->nullable();
            $table->string('BPPart_assessment')->nullable();
            $table->integer('BPPart_quantity')->nullable();
            $table->string('BPPart_assessmentclaim')->nullable();
            $table->string('BPPart_datecome')->nullable();
            $table->string('BPPart_assessmentcome')->nullable();
            $table->string('BPPart_company')->nullable();
            $table->string('BPPart_note')->nullable();
            $table->string('BPPart_user')->nullable();
            $table->string('BPPart_status')->nullable();
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
        Schema::dropIfExists('body_parts');
    }
}
