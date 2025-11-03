<?php

namespace App\Http\Requests\HabitLog;

use App\Models\Habit;
use App\Traits\JsonValidationResponse;
use App\Traits\ValidatesIdExists;
use Illuminate\Foundation\Http\FormRequest;

class ShowHabitLogRequest extends FormRequest
{
    use JsonValidationResponse, ValidatesIdExists;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [];
    }

    public function after(): array
    {
        return [
            $this->validateIdExists(Habit::class),
        ];
    }
}
