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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('institution_id')->unsigned();
            $table->bigInteger('referral_code');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('amount');
            $table->string('bank_transfer');
            $table->string('account_name');
            $table->string('description');
            $table->enum('status', array('waiting','processing','success','cencelled','rejected'));
            $table->enum('disable', array('no','yes'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
