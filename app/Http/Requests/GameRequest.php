<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'brandid'  => ['present', 'required', 'int'],
            'category' => ['nullable', 'string'],
            'country'  => ['present', 'required', 'string'],
            'perpage'  => ['nullable', 'max:100', 'min:3', 'numeric', 'filled'],
            'page'     => ['min:1', 'numeric', 'filled']
        ];
    }
}
