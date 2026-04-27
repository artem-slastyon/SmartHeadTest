<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TicketsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'string|nullable',
            'phone' => 'string|nullable',
            'status' => 'integer|between:-1,2|nullable',
            'dateFrom' => 'date_format:Y-m-d|nullable',
            'dateTo' => 'date_format:Y-m-d|nullable',
        ];
    }
}
