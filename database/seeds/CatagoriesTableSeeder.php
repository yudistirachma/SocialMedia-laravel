<?php

use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CatagoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = collect(['framework', 'code', 'library', 'tech']);
        $categories->each(function($c){
            Category::create([
                'name' => $c,
                'slug' => Str::slug($c)
            ]);
        });
    }
}
