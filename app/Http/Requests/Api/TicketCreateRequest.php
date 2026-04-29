<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TicketCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'string',
            'email' => 'email',
            'phone' => 'nullable|regex:' . config('validation.phoneRegex'),
            'subject' => 'string',
            'text' => 'string',
            'attachments.*' => 'file|max:5'
        ];
    }
}
