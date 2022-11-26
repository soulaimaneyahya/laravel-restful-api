<?php

namespace App\Services;

use App\Models\Buyer;
use App\Models\Product;

class TransactionService extends AppService
{
    public function store(array $data, Product $product, Buyer $buyer)
    {
        if ($buyer->id == $product->seller_id) {
            return $this->infoResponse('The buyer must be different from the seller', 409);
        }

        if (!$buyer->isVerified()) {
            return $this->infoResponse('The buyer must be a verified user', 409);
        }
        if (!$product->seller->isVerified()) {
            return $this->infoResponse('The seller must be a verified user', 409);
        }

        if (!$product->isAvailable()) {
            return $this->infoResponse('The product is not available', 409);
        }

        if ($product->quantity < $data['quantity']) {
            return $this->infoResponse('The product does not have enough units for this transaction', 409);
        }

        $product->quantity -= $data['quantity'];
        $product->save();

        $transaction = $buyer->transactions()->create([
            'product_id' => $product->id,
            'quantity' => $data['quantity']
        ]);
        return $this->apiRepository->find($transaction);
    }
}
