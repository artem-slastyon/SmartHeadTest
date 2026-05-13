<?php

namespace App\Http\Requests\Api;

use Exception;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class TicketCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     * @throws Exception
     */
    public function rules(): array
    {
        return [
            'name' => 'string|required',
            'email' => 'email|required',
            'phone' => 'nullable|regex:' . config('validation.phoneRegex'),
            'subject' => 'string|required',
            'text' => 'string|required',
            'files' => 'array|max:' . config('validation.maxFileCount'),
            'files.*' => File::default()->max(config('validation.maxFileSize'))
        ];
    }
}
