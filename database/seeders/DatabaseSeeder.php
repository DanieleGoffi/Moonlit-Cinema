<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        
        /*
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        */
        User::factory()->create([ 
            'name' => 'admin',         //1
            'email' => 'admin@example.com',
            'password' => 'admin',
            'role' => 'admin',
        ]);
        User::factory()->create([
            'name' => 'Mario Doccia',   //2
            'email' => 'mario.doccia@example.com',
            'password' => 'admin',

        ]);
        User::factory()->create([
            'name' => 'Tipo Timido',    //3
            'email' => 'tipo.timido@example.com',
            'password' => 'admin',
        ]);


        $this->call(GenreSeeder::class);
        $this->call(MovieSeeder::class);
        $this->call(ScreenSeeder::class);
        $this->call(SeatSeeder::class);
        $this->call(ScreeningSeeder::class);
        
    }
}
