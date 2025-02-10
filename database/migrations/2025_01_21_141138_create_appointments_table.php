<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->string('outlet');
            $table->unsignedBigInteger('barber_id');
            $table->json('services'); // To store multiple services
            $table->string('customer_name');
            $table->string('phone');
            $table->timestamps();

            // Add foreign key constraint
            // $table->foreign('barber_id')->references('id')->on('barbers')
            //       ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
