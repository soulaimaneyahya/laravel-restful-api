<?php

namespace App\Repositories;

use App\Traits\ApiResponser;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class UserRepository
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
