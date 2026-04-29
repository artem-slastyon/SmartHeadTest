<?php

namespace App\Http\Requests\Api;

use App\Support\SizeConverter;
use Exception;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

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
        $maxSize = SizeConverter::toKilobytes(config('validation.maxFileSize'));

        return [
            'name' => 'string|required',
            'email' => 'email|required',
            'phone' => 'nullable|regex:' . config('validation.phoneRegex'),
            'subject' => 'string|required',
            'text' => 'string|required',
            'attachments.*' => 'file|max:' . config('validation.maxFileCount') . '|size:' . $maxSize,
        ];
    }
}
