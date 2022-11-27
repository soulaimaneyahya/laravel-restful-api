<?php

namespace App\Transformers;

use App\Models\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
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
    public function transform(Product $product)
    {
        return [
            'id' => (int)$product->id,
            'title' => (string)$product->name,
            'details' => (string)$product->description,
            'seller' => (array) [
                'id' => (int) $product->seller_id
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
            ]
        ];
    }
}
