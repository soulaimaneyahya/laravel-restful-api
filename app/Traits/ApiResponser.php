<?php

namespace App\Traits;

trait ApiResponser
{
    private function successResponse($data, $code)
    {
        return response()->json($data, $code);
    }

    protected function infoResponse($message, $code)
    {
        return response()->json(['message' => $message, 'code' => $code], $code);
    }
}
