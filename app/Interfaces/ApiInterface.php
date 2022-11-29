<?php

namespace App\Interfaces;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

interface ApiInterface
{
    public function all(Collection $collection, $code = 200);
    
    public function find(Model $instance, $code = 200);
}
