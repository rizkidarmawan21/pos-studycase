<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cashier_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('invoice_code')->unique();
            $table->decimal('cash', 48, 4);
            $table->decimal('change', 48, 4);
            $table->decimal('grand_total', 48, 4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
