<?php

namespace App\Http\Requests\HabitLog;

use App\Enums\Status;
use App\Models\Habit;
use App\Traits\JsonValidationResponse;
use App\Traits\ValidatesIdExists;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateHabitLogRequest extends FormRequest
{
    use JsonValidationResponse, ValidatesIdExists;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date' => 'required|string|date_format:m-d-Y',
            'status' => ['required', 'string', Rule::in(Status::ALL())],
            'note' => 'nullable|string|max:255',
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
            'date.required' => 'Date is required',
            'date.date' => 'Date must be a valid date',
            'date.date_format' => 'Date must be in the format of m-d-Y',
            'status.required' => 'Status is required',
            'status.in' => 'Status must be one of the following: done, skipped, missed',
            'note.max' => 'Note must be at most 255 characters',
        ];
    }
}
