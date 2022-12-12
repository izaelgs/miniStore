<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::insert([
            [
                "name" => "busetagratis",
                "description" => "...",
                "price" => 0.99,
                "img_url" => "...",
            ],
            [
                "name" => "pokemon",
                "description" => "...",
                "price" => 1.99,
                "img_url" => "...",
            ],
            [
                "name" => "bolsonaro",
                "description" => "...",
                "price" => 4.99,
                "img_url" => "...",
            ],
        ]);

        foreach(Product::all() as $product) {
            $product->categories()->attach(rand(1,3));
        };
    }
}
