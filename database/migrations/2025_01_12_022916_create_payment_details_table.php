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
        Schema::create('payment_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('institution_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('payment_id')->unsigned();
            $table->bigInteger('transaction_category_id')->unsigned();
            $table->bigInteger('degree_id')->unsigned();
            $table->string('user_name');
            $table->bigInteger('amount');
            $table->string('description');
            $table->bigInteger('sequence');
            $table->enum('is_tuition_fee', array('no','yes'));
            $table->bigInteger('tuition_fee');
            $table->bigInteger('eat');
            $table->bigInteger('laundry');
            $table->bigInteger('paid');
            $table->bigInteger('unpaid');
            $table->string('year');
            $table->enum('status', array('active','non active','success','failed','cancel'));
            $table->enum('disable', array('no','yes'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_details');
    }
};
