<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('institution_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('merchant_name');
            $table->string('banner');
            $table->bigInteger('no_ktp');
            $table->string('description');
            $table->enum('status', array('active','non active'));
            $table->enum('disable', array('no','yes'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchants');
    }
};
