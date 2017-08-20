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
            'name' => 'cw',
            'email' => 'cw@example.com',
            'password' => bcrypt('qwe')
        ]);
    }
}
