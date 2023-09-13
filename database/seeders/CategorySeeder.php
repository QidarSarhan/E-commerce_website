<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Database\Factories\CategoryFactory;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* \DB::table('categories')->insert([
            'name' => Str::random(10),
            'image' => Str::random(10).'.jpg',
            'parent_id' => null,
        ]); */

        Category::factory(20)->create([
            'parent_id' =>0,
        ]);
    }
}
