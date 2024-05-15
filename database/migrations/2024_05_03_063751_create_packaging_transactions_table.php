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
        Schema::create('packaging_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->foreign('vehicle_id')->references('id')->on('vehicles');
            $table->unsignedBigInteger('person_id')->nullable();
            $table->foreign('person_id')->references('id')->on('people');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('packaging_id')->nullable();
            $table->foreign('packaging_id')->references('id')->on('packagings');
            $table->string('delivery_note_no')->nullable();
            $table->string('internal_delivery_no')->nullable();
            $table->string('no_of_packs')->nullable();
            $table->string('total_quantity')->nullable();
            $table->string('receipt_no')->nullable();
            $table->string('destination')->nullable();
            $table->string('type')->nullable();
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packaging_transactions');
    }
};
