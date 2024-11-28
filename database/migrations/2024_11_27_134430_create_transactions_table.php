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
            $table->string('client_id');
            $table->decimal('amount', 10, 2);
            $table->unsignedBigInteger('currency_id');
            $table->date('transaction_date');
            $table->timestamps();
            $table->foreign('client_id')->references('client_id')->on('customers');
            $table->foreign('currency_id')->references('id')->on('currencies'); // Ensure currencies table exists

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
