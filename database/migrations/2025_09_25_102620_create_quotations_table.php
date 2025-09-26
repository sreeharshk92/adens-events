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
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->string('quotation_number')->unique();
            $table->string('client_name');
            $table->string('client_place');
            $table->string('client_contact');
            $table->string('event_name');
            $table->string('event_date');
            $table->string('event_time');
            $table->integer('number_of_people');
            $table->decimal('per_plate_price', 10, 2);
            $table->decimal('total_amount', 12, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};
