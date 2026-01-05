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
        Schema::create('gethers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('institution_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('degree_id')->nullable();
            $table->string('user_name')->nullable();
            $table->string('degree_name')->nullable();
            $table->bigInteger('balance');
            $table->string('description')->nullable();
            $table->string('goal')->nullable();
            $table->date('deadline')->nullable();
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
        Schema::dropIfExists('gethers');
    }
};
