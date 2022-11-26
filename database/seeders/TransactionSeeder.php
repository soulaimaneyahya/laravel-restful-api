<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Seller;
use App\Models\Transaction;
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
        $count = max((int)$this->command->ask("How many transactions would you like ?", 1000), 1);

        $transactions = Transaction::factory($count)->make()->each(function($transaction) {
            $seller = Seller::all()->random();
            $buyer = User::all()->except($seller->id)->random();

            $transaction->buyer_id = $buyer->id;
            $transaction->product_id = $seller->products->random()->id;
            $transaction->save();
        });
    }
}
