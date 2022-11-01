<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
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
        $count = max((int)$this->command->ask("How many products would you like ?", 10), 1);
        $products = \App\Models\Product::factory($count)->create()->each(function($product) {
            $categories = Category::all()->random(random_int(1,5))->pluck('id');
            foreach ($categories as $category) {
                $product->categories()->attach($category, [
                    'id' => Str::uuid()
                ]);
            }
        });
    }
}
