<?php

namespace App\Http\Requests\Habit;

use App\Enums\Frequency;
use App\Models\Habit;
use App\Traits\JsonValidationResponse;
use App\Traits\ValidatesIdExists;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateHabitRequest extends FormRequest
{
    use JsonValidationResponse, ValidatesIdExists;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string|max:255',
            'frequency' => ['sometimes|required', Rule::in(Frequency::ALL())],
            'color' => 'nullable|string|max:255',
            'reminder_time' => 'sometimes|required|string|max:255',
        ];
    }

    public function after(): array
    {
        return [
            $this->validateIdExists(Habit::class),
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'name.max' => 'Name must be at most 255 characters',
            'description.required' => 'Description is required',
            'description.max' => 'Description must be at most 255 characters',
            'frequency.required' => 'Frequency is required',
            'color.max' => 'Color must be at most 255 characters',
            'reminder_time.required' => 'Reminder time is required',
            'reminder_time.max' => 'Reminder time must be at most 255 characters',
        ];
    }
}
