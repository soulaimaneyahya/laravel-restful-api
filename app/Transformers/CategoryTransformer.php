<?php

namespace App\Transformers;

use App\Models\Category;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
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
    public function transform(Category $category)
    {
        return [
            'id' => (int)$category->id,
            'title' => (string)$category->name,
            'details' => (string)$category->description,
            'createdAt' => (string)$category->created_at,
            'updatedAt' => (string)$category->updated_at,
            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('api.v1.categories.show', $category->id),
                ],
            ]
        ];
    }
}
