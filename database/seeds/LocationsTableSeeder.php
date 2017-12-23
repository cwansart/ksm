<?php

use App\Cat;
use App\Location;
use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cats = Cat::all();

        Location::create([
            'location' => 'Katzenschutzbund',
            'cat_id' => $cats[0]->getAttribute('id')
        ]);

        Location::create([
            'location' => 'Musterfamilie\nMusterstraße 42\Musterstadt',
            'cat_id' => $cats[1]->getAttribute('id')
        ]);
    }
}
