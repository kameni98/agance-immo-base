<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchPropertiesRequest extends FormRequest
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
            'title' => ['string', 'nullable'],
            //gte => veut dire plus grand que donc ici on veut que le prix sont plus que 0
            'price' => [ 'numeric:', 'nullable', 'gte:0'],
            'surface' => ['numeric', 'nullable', 'gte:0'],
            'rooms' => ['numeric', 'nullable', 'gte:0']
        ];
    }
}
