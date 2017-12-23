<?php

use App\Cat;
use Illuminate\Database\Seeder;

class CatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cat::create([
            'color' => 'rot',
            'name' => 'Fritz',
            'photo_path' => '/../pics/01.jpg',
            'status' => 'in_care'
        ]);

        Cat::create([
            'color' => 'schwarz mit weißen Punkten',
            'status' => 'deceased'
        ]);

        Cat::create([
            'color' => 'orange',
            'name' => 'Karl',
            'status' => 'present'
        ]);

        Cat::create([
            'color' => 'weiß',
            'name' => 'Mimi',
            'is_male' => false,
            'photo_path' => '/../pics/04.jpg',
            'status' => 'mediated'
        ]);
    }
}
