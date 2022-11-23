<?php

namespace App\Repositories;

use App\Traits\ApiResponser;
use App\Interfaces\ApiInterface;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class ApiRepository implements ApiInterface
{
    use ApiResponser;

    public function all(Collection $collection, $code = 200)
    {
        return $this->successResponse(['data' => $collection], $code);
    }
    
    public function find(Model $model, $code = 200)
    {
        return $this->successResponse(['data' => $model], $code);
    }
}
