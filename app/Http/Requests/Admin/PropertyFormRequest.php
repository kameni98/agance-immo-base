<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PropertyFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:8'],
            'description' => ['required', 'string', 'min:8'],
            'price' => ['required', 'numeric:', 'min:0'],
            'surface' => ['required', 'numeric', 'min:10'],
            'rooms' => ['required', 'numeric'],
            'bedrooms' => ['required', 'numeric'],
            'floor' => ['numeric'],
            'city_id' => ['required','numeric','exists:cities,id'],
            'address' => ['required','string','min:2'],
            'postal_code' => ['nullable','string','min:2'],
            'sold' => ['nullable','boolean:'],
            'options' => ['array', 'exists:options,id']
        ];
    }
}
