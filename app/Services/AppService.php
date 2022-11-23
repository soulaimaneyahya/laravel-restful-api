<?php

namespace App\Services;

use App\Traits\ApiResponser;
use App\Repositories\ApiRepository;

class AppService
{
    public function __construct
    (
        protected ApiRepository $apiRepository
    )
    {
    }

    use ApiResponser;
}
