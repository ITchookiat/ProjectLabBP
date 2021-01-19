<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBodyCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('body_calls', function (Blueprint $table) {
            $table->bigIncrements('BPCall_id');
            $table->integer('BPCus_id');
            $table->string('BPCall_date')->nullable();
            $table->string('BPCall_result')->nullable();
            $table->string('BPCall_note')->nullable();
            $table->string('BPCall_type')->nullable();
            $table->string('BPCall_usercall')->nullable();
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
        Schema::dropIfExists('body_calls');
    }
}
