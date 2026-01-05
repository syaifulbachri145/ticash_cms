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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('trans_number');
            $table->bigInteger('institution_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('destination_id');
            $table->bigInteger('transaction_category_id')->unsigned();
            $table->enum('type', array('debit','credit'));           
            $table->string('description')->nullable();
            $table->bigInteger('amount');
            $table->bigInteger('admin_fee');
            $table->bigInteger('shared_fee');
            $table->enum('status', array('waiting','processing','success','pending'));
            $table->enum('disable', array('no','yes'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
