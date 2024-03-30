<?php

namespace App\Http\Requests\Front\Cart;

use Illuminate\Foundation\Http\FormRequest;

class SingleDestroyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'quantity' => 'required|numeric|min:0'
        ];
    }

    public function messages(): array
    {
        return [
            'quantity.required' => 'Adet alanı zorunludur.',
            'quantity.numeric' => 'Adet alanı sayısal değer olmak zorunludur.',
            'quantity.min' => 'Adet alanı en az 0 olmak zorunludur.',
        ];
    }
}
