<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barber;

class BarberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $barbers = [
            ['name' => 'Zaim', 'outlet' => 'Eco Grandeur'],
            ['name' => 'Danial', 'outlet' => 'Eco Grandeur'],
            ['name' => 'Lil Ali', 'outlet' => 'Eco Grandeur'],
            ['name' => 'Ahmad Snopp', 'outlet' => 'Eco Grandeur'],
            ['name' => 'Kama', 'outlet' => 'Taman Ilmu'],
            ['name' => 'Azreil', 'outlet' => 'Taman Ilmu'],
            ['name' => 'Jamal', 'outlet' => 'Taman Ilmu'],
            ['name' => 'Dato Mustaqim', 'outlet' => 'Taman Ilmu'],
        ];

        foreach ($barbers as $barber) {
            Barber::create($barber);
        }
    }
}
