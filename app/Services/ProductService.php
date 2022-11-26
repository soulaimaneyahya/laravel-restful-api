<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class ProductService extends AppService
{
    public function all(Collection $collection)
    {
        return $this->apiRepository->all($collection);        
    }

    public function find(Model $model)
    {
        return $this->apiRepository->find($model);
    }
}
