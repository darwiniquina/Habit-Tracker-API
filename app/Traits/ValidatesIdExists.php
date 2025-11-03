<?php

namespace App\Traits;

use Closure;
use Symfony\Component\HttpFoundation\Response;

trait ValidatesIdExists
{
    protected function validateIdExists(string $modelClass): Closure
    {
        return function ($validator) use ($modelClass) {
            $id = $this->route('id');

            if (! $id || ! is_numeric($id)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'ID is required and must be numeric.',
                ], Response::HTTP_BAD_REQUEST)->throwResponse();
            }

            if (! $modelClass::find($id)) {
                return response()->json([
                    'status' => 'error',
                    'message' => class_basename($modelClass).' not found.',
                ], Response::HTTP_NOT_FOUND)->throwResponse();
            }
        };
    }
}
