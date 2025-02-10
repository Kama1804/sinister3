<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('barbers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('outlet');
            $table->timestamps();
        });

        // Insert the 8 barbers
        DB::table('barbers')->insert([
            // Eco Grandeur barbers
            ['name' => 'Zaim', 'outlet' => 'eco_grandeur', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Danial', 'outlet' => 'eco_grandeur', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Lil Ali', 'outlet' => 'eco_grandeur', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ahmad Snopp', 'outlet' => 'eco_grandeur', 'created_at' => now(), 'updated_at' => now()],
            
            // Taman Ilmu barbers
            ['name' => 'Kama', 'outlet' => 'taman_ilmu', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Azreil', 'outlet' => 'taman_ilmu', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Jamal', 'outlet' => 'taman_ilmu', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Dato Mustaqim', 'outlet' => 'taman_ilmu', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('barbers');
    }
};