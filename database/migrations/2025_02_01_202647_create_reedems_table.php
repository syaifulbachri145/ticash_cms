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
        Schema::create('reedems', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('institution_id')->unsigned();
            $table->string('user_id');
            $table->bigInteger('amount');
            $table->enum('status', array('waiting','success'));
            $table->enum('disable', array('no','yes'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reedems');
    }
};
