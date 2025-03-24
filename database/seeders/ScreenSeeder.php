<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Screen;

class ScreenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $screens = [
            ['number' => 1, 'technology' => 'IMAX'],
            ['number' => 2, 'technology' => 'IMAX'],
            ['number' => 3, 'technology' => 'Standard'],
            ['number' => 4, 'technology' => 'Standard'],
            ['number' => 5, 'technology' => 'Standard'],
            ['number' => 6, 'technology' => '3D'],
            
        ];

        foreach ($screens as $screen) {
            Screen::create($screen);
        }
    }
}
