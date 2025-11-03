<?php

namespace App\Traits;

use Closure;

trait ValidatesIdExists
{
    protected function validateIdExists(string $modelClass): Closure
    {
        return function ($validator) use ($modelClass) {
            $id = $this->route('id');

            if (! $id || ! is_numeric($id)) {
                $validator->errors()->add('id', 'ID is required and must be numeric.');

                return;
            }

            if (! $modelClass::find($id)) {
                $validator->errors()->add('id', 'ID not found.');
            }
        };
    }
}
