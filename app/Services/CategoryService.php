<?php

namespace App\Services;

use App\Models\Category;
use App\Traits\ApiResponser;
use App\Repositories\ApiRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class CategoryService
{
    use ApiResponser;

    public function __construct
    (
        private ApiRepository $apiRepository
    )
    {
    }

    public function all(Collection $collection)
    {
        return $this->apiRepository->all($collection);        
    }

    public function find(Model $model)
    {
        return $this->apiRepository->find($model);
    }

    public function store(array $data)
    {
        $category = Category::create($data);
        return $this->apiRepository->find($category);
    }

    public function update(array $data, Category $category)
    {
        if (isset($data['name'])) {
            $category->name = $data['name'];
        }

        if (!$category->isDirty()) {
            return $this->infoResponse('You need to specify diff value to change', 422);
        }

        $category->save();
        return $this->apiRepository->find($category);
    }

    public function delete(Category $category)
    {
        $category->delete();
        return $this->infoResponse('category deleted !', 200);
    }
}
