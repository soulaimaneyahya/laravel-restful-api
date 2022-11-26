<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\CategoryProduct;
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
        $count = max((int)$this->command->ask("How many products would you like ?", 200), 1);
        Product::factory($count)->create();

        Product::all()->each(function (Product $product) {
            $take = random_int(1, 10);
            $categories = Category::inRandomOrder()->take($take)->get()->pluck('id');
            $product->categories()->syncWithoutDetaching($categories);
        });
    }
}
