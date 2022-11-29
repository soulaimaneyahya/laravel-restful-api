<?php

namespace App\Transformers;

use App\Models\Buyer;
use League\Fractal\TransformerAbstract;

class BuyerTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Buyer $buyer)
    {
        return [
            'id' => (string)$buyer->id,
            'name' => (string)$buyer->name,
            'email' => (string)$buyer->email,
            'isVerified' => (int)$buyer->verified,
            'createdAt' => (string)$buyer->created_at,
            'updatedAt' => (string)$buyer->updated_at,
            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('api.v1.buyers.show', $buyer->id),
                ],
                [
                    'rel' => 'buyers transactions',
                    'href' => route('api.v1.buyers.transactions.index', $buyer->id),
                ],
                [
                    'rel' => 'buyers products',
                    'href' => route('api.v1.buyers.products.index', $buyer->id),
                ],
                [
                    'rel' => 'buyers sellers',
                    'href' => route('api.v1.buyers.sellers.index', $buyer->id),
                ],
                [
                    'rel' => 'buyers categories',
                    'href' => route('api.v1.buyers.categories.index', $buyer->id),
                ],
            ]
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'id' => 'id',
            'name' => 'name',
            'email' => 'email',
            'isVerified' => 'verified',
            'createdAt' => 'created_at',
            'updatedAt' => 'updated_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
