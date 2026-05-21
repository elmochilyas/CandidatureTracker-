<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCandidatureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'offer_url' => ['nullable', 'url', 'max:2048'],
            'status' => ['required', 'string', 'in:to_apply,applied,waiting,interview_scheduled,rejected,accepted'],
            'priority' => ['required', 'string', 'in:low,normal,high'],
            'notes' => ['nullable', 'string'],
            'application_date' => ['required', 'date', 'before_or_equal:today'],
            'attachment' => ['nullable', 'file', 'max:10240', 'mimes:pdf,doc,docx,png,jpg,jpeg'],
        ];
    }
}
