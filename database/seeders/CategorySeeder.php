<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::insert([
            ['title' => 'Geral', 'description' => '...'],
            ['title' => 'Roupa', 'description' => '...'],
            ['title' => 'Computador', 'description' => '...'],
            ['title' => 'Material de Construção', 'description' => '...'],
        ]);
    }
}
