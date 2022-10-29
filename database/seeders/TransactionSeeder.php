<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Seller;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = max((int)$this->command->ask("How many transactions would you like ?", 10), 1);
        
        $seller = Seller::has('products')->get()->random();
        $buyer = User::all()->except($seller->id)->random();

        $transactions = \App\Models\Transaction::factory($count)->create([
            'buyer_id' => $buyer->id,
            'product_id' => $seller->products->random()->id
        ]);
    }
}
