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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('institution_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('transaction_category_id')->unsigned();
            $table->string('title');
            $table->bigInteger('amount');
            $table->string('description');
            $table->bigInteger('sequence');
            $table->enum('is_tuition_fee', array('no','yes'));
            $table->bigInteger('tuition_fee')->nullable();
            $table->bigInteger('eat')->nullable();
            $table->bigInteger('laundry')->nullable();
            $table->enum('type', array('public','private'));
            $table->bigInteger('year');
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
        Schema::dropIfExists('payments');
    }
};
