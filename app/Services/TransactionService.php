<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class TransactionService extends AppService
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
