<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponser;
use Illuminate\Routing\Middleware\ThrottleRequests;

class CustomThrottleRequests extends ThrottleRequests
{
    use ApiResponser;

    /**
     * build 'Too Many Attempts.'
     *
     * @param [type] $key
     * @param [type] $maxAttempts
     * @return void
     */
    protected function buildResponse($key, $maxAttempts)
    {
        // 429 Too Many Requests
        $response = $this->infoResponse('Too Many Attempts.', 429);
        $retryAfter = $this->limiter->availableIn($key);
        
        return $this->addHeaders(
            $response, $maxAttempts,
            $this->calculateRemainingAttempts($key, $maxAttempts, $retryAfter),
            $retryAfter
        );
    }
}
