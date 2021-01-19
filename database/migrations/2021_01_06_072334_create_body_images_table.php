<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBodyImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('body_images', function (Blueprint $table) {
            $table->bigIncrements('BPImage_id');
            $table->string('BPCus_id')->nullable();
            $table->string('BPImage_filename')->nullable();
            $table->string('BPImage_filesize')->nullable();
            $table->string('BPImage_type')->nullable();
            $table->string('BPImage_userUpload')->nullable();
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
        Schema::dropIfExists('body_images');
    }
}
