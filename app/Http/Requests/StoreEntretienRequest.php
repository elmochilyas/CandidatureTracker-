<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEntretienRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => ['required', 'string', 'in:phone,video,technical,hr,in_person'],
            'scheduled_at' => ['required', 'date'],
            'notes' => ['nullable', 'string'],
            'result' => ['nullable', 'string', 'in:pending,positive,negative,rescheduled'],
        ];
    }
}
