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
        Schema::create('institutions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('institution_code');
            $table->bigInteger('referral_code');
            $table->string('institution_name');
            $table->string('address');
            $table->string('contact');
            $table->string('email');
            $table->string('image')->nullable();
            $table->bigInteger('balance');
            $table->bigInteger('admin_fee');
            $table->bigInteger('shared_fee');
            $table->bigInteger('profit');
            $table->bigInteger('invoice');
            $table->string('bank_transfer')->nullable();
            $table->bigInteger('account_number')->nullable();
            $table->string('account_name')->nullable();
            $table->string('chat_id')->nullable();
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
        Schema::dropIfExists('institutions');
    }
};
