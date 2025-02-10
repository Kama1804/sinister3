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
        // Adding the foreign key constraint to the existing 'appointments' table
        Schema::table('appointments', function (Blueprint $table) {
            // Add the foreign key constraint for the barber_id column
            $table->foreign('barber_id')->references('id')->on('barbers')
                  ->onDelete('restrict'); // Prevent deletion if barber has appointments
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Drop the foreign key constraint during rollback
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['barber_id']);
        });
    }
};
