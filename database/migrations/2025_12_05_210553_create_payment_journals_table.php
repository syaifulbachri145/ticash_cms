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
        Schema::create('payment_journals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('institution_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('payment_id')->unsigned()->nullable();
            $table->bigInteger('transaction_category_id');
            $table->string('user_name');
            $table->string('description');
            $table->bigInteger('amount');
            $table->bigInteger('debit');
            $table->bigInteger('credit');
            $table->bigInteger('saldo');
            $table->string('user_approve');
            $table->string('year');
            $table->enum('type', array('debit','credit'));
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
        Schema::dropIfExists('payment_journals');
    }
};
