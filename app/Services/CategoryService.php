<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class CategoryService extends AppService
{
    public function all(Collection $collection)
    {
        return $this->apiRepository->all($collection);        
    }

    public function find(Model $model)
    {
        return $this->apiRepository->find($model);
    }

    public function store(array $data, ?Product $product)
    {
        $category = Category::create($data);

        if (isset($product)) {
            $product->categories()->syncWithoutDetaching([$category->id]);
        }

        return $this->apiRepository->find($category);
    }

    public function update(array $data, ?Product $product = null, Category $category)
    {
        $category->fill([
            'name' => $data['name'] ?? $category->name,
            'description' => $data['description'] ?? $category->description,
        ]);

        if (!$category->isDirty()) {
            return $this->infoResponse('You need to specify diff value to change', 422);
        }

        $category->save();
        
        if (isset($product)) {
            $product->categories()->syncWithoutDetaching([$category->id]);
        }

        return $this->apiRepository->find($category);
    }

    public function delete(?Product $product = null, Category $category)
    {
        if (isset($product)) {
            if (!$product->categories()->find($category->id)) {
                return $this->infoResponse('The specified category is not a category of this product', 404);
            }
            $product->categories()->detach($category->id);
        } else {
            $category->products()->sync([]);
            $category->delete();
        }

        return $this->infoResponse('category deleted !', 200);
    }
}
