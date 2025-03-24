<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Screen;
use App\Models\Seat;

class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Screen::count() == 0) {
            $this->call(ScreenSeeder::class);
        }

        for ($screen_number = 1; $screen_number <=3; $screen_number++){
            $screen_id = Screen::where('number', $screen_number)->value('id'); 
            if (!$screen_id) continue;

            $rows = range('A', 'O'); 
            foreach ($rows as $row) {
                for ($i = 1; $i <= 20; $i++) {
                    $wheelchairReserved = false;
                    if ($row == 'A' && $i <= 3) {
                        $wheelchairReserved = true; 
                    } 
                    Seat::create([
                        'row' => $row,
                        'number' => $i,
                        'wheelchair_reserved' => $wheelchairReserved,
                        'screen_id' => $screen_id, 
                    ]);
                }
            }
        }

        for ($screen_number = 4; $screen_number <=6; $screen_number++){
            $screen_id = Screen::where('number', $screen_number)->value('id'); // ✅ Ora è un intero
            if (!$screen_id) continue;

            $rows = range('A', 'J'); 
            foreach ($rows as $row) {
                for ($i = 1; $i <= 15; $i++) {
                    $wheelchairReserved = false;
                    if ($row == 'A' && $i <= 3) {
                        $wheelchairReserved = true; 
                    } 
                    Seat::create([
                        'row' => $row,
                        'number' => $i,
                        'wheelchair_reserved' => $wheelchairReserved,
                        'screen_id' => $screen_id, 
                    ]);
                }
            }
        }


    }
}
