<?php

use App\User;
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
        User::create([
            'name' => 'pasukan bodrek',
            'username' => 'pasukanBodrek',
            'password' => bcrypt('pasukanbodrek'),
            'email' => 'pasukanBodrek230@gmail.com'
        ]);
    }
}
