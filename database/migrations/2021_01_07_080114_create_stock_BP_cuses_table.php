<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockBPCusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_BP_cuses', function (Blueprint $table) {
            $table->bigIncrements('BPCus_id');
            $table->string('BPCus_name')->nullable();
            $table->string('BPCus_phone')->nullable();
            $table->string('BPCus_address')->nullable();
            $table->string('BPCus_claimLevel')->nullable();
            $table->string('BPCus_claimType')->nullable();
            $table->string('BPCus_claimCompany')->nullable();
            $table->string('BPCus_claimCompanyother')->nullable();
            $table->string('BPCus_note')->nullable();
            $table->string('BPCus_dateKeyin')->nullable();
            $table->string('BPCus_userKeyin')->nullable();
            $table->string('BPCus_userUpdated')->nullable();
            $table->string('BPCus_dateUpdated')->nullable();
            $table->string('BPCus_status')->nullable();
            $table->string('BPCus_changeStatus')->nullable();
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
        Schema::dropIfExists('stock_BP_cuses');
    }
}
