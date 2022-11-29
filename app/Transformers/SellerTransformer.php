<?php

namespace App\Transformers;

use App\Models\Seller;
use League\Fractal\TransformerAbstract;

class SellerTransformer extends TransformerAbstract
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
    public function transform(Seller $seller)
    {
        return [
            'id' => (string)$seller->id,
            'name' => (string)$seller->name,
            'email' => (string)$seller->email,
            'isVerified' => (int)$seller->verified,
            'createdAt' => (string)$seller->created_at,
            'updatedAt' => (string)$seller->updated_at,
            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('api.v1.sellers.show', $seller->id),
                ],
                [
                    'rel' => 'sellers transactions',
                    'href' => route('api.v1.sellers.transactions.index', $seller->id),
                ],
                [
                    'rel' => 'sellers products',
                    'href' => route('api.v1.sellers.products.index', $seller->id),
                ],
                [
                    'rel' => 'sellers buyers',
                    'href' => route('api.v1.sellers.buyers.index', $seller->id),
                ],
                [
                    'rel' => 'sellers categories',
                    'href' => route('api.v1.sellers.categories.index', $seller->id),
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
