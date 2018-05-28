<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => 'anja',
            'email' => 'anja@example.com',
            'password' => bcrypt('hewodiye')
        ]);

        App\User::create([
            'name' => 'angela',
            'email' => 'angela@example.com',
            'password' => bcrypt('ravocowa')
        ]);

        App\User::create([
            'name' => 'andreas',
            'email' => 'andreas@example.com',
            'password' => bcrypt('duxireko')
        ]);

        App\User::create([
            'name' => 'marita',
            'email' => 'marita@example.com',
            'password' => bcrypt('gokadepu')
        ]);

        App\User::create([
            'name' => 'marion',
            'email' => 'marion@example.com',
            'password' => bcrypt('runasuke')
        ]);

        App\User::create([
            'name' => 'michael',
            'email' => 'michael@example.com',
            'password' => bcrypt('vewivoba')
        ]);
    }
}
