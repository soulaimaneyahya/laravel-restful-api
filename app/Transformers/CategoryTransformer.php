<?php

namespace App\Transformers;

use App\Models\Category;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{ 
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Category $category)
    {
        return [
            'id' => (string)$category->id,
            'title' => (string)$category->name,
            'details' => (string)$category->description,
            'createdAt' => (string)$category->created_at,
            'updatedAt' => (string)$category->updated_at,
            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('api.v1.categories.show', $category->id),
                ],
                [
                    'rel' => 'category products',
                    'href' => route('api.v1.categories.products.index', $category->id),
                ],
                [
                    'rel' => 'categories sellers',
                    'href' => route('api.v1.categories.sellers.index', $category->id),
                ],
                [
                    'rel' => 'categories transactions',
                    'href' => route('api.v1.categories.transactions.index', $category->id),
                ],
                [
                    'rel' => 'categories buyers',
                    'href' => route('api.v1.categories.buyers.index', $category->id),
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
            'createdAt' => 'created_at',
            'updatedAt' => 'updated_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
