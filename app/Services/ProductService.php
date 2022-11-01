<?php

namespace App\Services;

use App\Models\Product;
use App\Traits\ApiResponser;
use App\Repositories\ApiRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ProductService
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
}
