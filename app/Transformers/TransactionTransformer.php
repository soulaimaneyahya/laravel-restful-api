<?php

namespace App\Transformers;

use App\Models\Transaction;
use League\Fractal\TransformerAbstract;

class TransactionTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Transaction $transaction)
    {
        return [
            'id' => (int)$transaction->id,
            'transactionNumber' => (string)$transaction->transaction_no,
            'buyer' => (array) [
                'id' => (int) $transaction->buyer_id
            ],
            'product' => (array) [
                'id' => (int) $transaction->product_id
            ],
            'amount' => (int)$transaction->quantity,
            'createdAt' => (string)$transaction->created_at,
            'updatedAt' => (string)$transaction->updated_at,
            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('api.v1.transactions.show', $transaction->id),
                ],
            ]
        ];
    }
}
