<?php

namespace App\Transformers;

use App\Models\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Product $product)
    {
        return [
            'id' => (string)$product->id,
            'title' => (string)$product->name,
            'details' => (string)$product->description,
            'seller' => (array) [
                'id' => (string) $product->seller_id
            ],
            'inventory' => (int)$product->quantity,
            'picture' => url("img/{$product->image}"),
            'situation' => (string)$product->status,
            'createdAt' => (string)$product->created_at,
            'updatedAt' => (string)$product->updated_at,
            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('api.v1.products.show', $product->id),
                ],
                [
                    'rel' => 'products transactions',
                    'href' => route('api.v1.products.transactions.index', $product->id),
                ],
                [
                    'rel' => 'products categories',
                    'href' => route('api.v1.products.categories.index', $product->id),
                ],
                [
                    'rel' => 'products buyers',
                    'href' => route('api.v1.products.buyers.index', $product->id),
                ],
                [
                    'rel' => 'products seller',
                    'href' => route('api.v1.sellers.show', $product->seller_id),
                ],
            ]
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'id' => 'id',
            'title' => 'name',
            'details' => 'description',
            'seller' => 'seller_id',
            'inventory' => 'quantity',
            'picture' => 'image',
            'situation' => 'status',
            'createdAt' => 'created_at',
            'updatedAt' => 'updated_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
