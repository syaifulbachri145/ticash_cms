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
        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('institution_id')->unsigned();
            $table->bigInteger('transaction_category_id')->unsigned();
            $table->string('user_id');
            $table->string('user_name');
            $table->string('user_approved');
            $table->bigInteger('amount');
            $table->string('description');
            $table->date('request_date');
            $table->date('approval_date')->nullable();
            $table->enum('status', array('waiting','pending','rejected','approved','cenceled'));
            $table->enum('disable', array('no','yes'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('claims');
    }
};
