<?php

namespace App\Transformers;

use App\Models\Transaction;
use League\Fractal\TransformerAbstract;

class TransactionTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Transaction $transaction)
    {
        return [
            'id' => (string)$transaction->id,
            'transactionNumber' => (string)$transaction->transaction_no,
            'buyer' => (array) [
                'id' => (string) $transaction->buyer_id
            ],
            'product' => (array) [
                'id' => (string) $transaction->product_id
            ],
            'amount' => (int)$transaction->quantity,
            'createdAt' => (string)$transaction->created_at,
            'updatedAt' => (string)$transaction->updated_at,
            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('api.v1.transactions.show', $transaction->id),
                ],
                [
                    'rel' => 'transactions categories',
                    'href' => route('api.v1.transactions.categories.index', $transaction->id),
                ],
                [
                    'rel' => 'transactions sellers',
                    'href' => route('api.v1.transactions.sellers.index', $transaction->id),
                ],
                [
                    'rel' => 'transactions products',
                    'href' => route('api.v1.products.show', $transaction->iproduct_id),
                ],
                [
                    'rel' => 'transactions buyers',
                    'href' => route('api.v1.buyers.show', $transaction->buyer_id),
                ],
            ]
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'id' => 'id',
            'transactionNumber' => 'transaction_no',
            'buyer' => 'buyer_id',
            'product' => 'product_id',
            'amount' => 'quantity',
            'createdAt' => 'created_at',
            'updatedAt' => 'updated_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
