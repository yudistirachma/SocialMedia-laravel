<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void3
     */
    public function run()
    {
        $this->call(CatagoriesTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
