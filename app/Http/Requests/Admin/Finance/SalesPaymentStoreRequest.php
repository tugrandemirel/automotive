<?php

namespace App\Http\Requests\Admin\Finance;

use Illuminate\Foundation\Http\FormRequest;

class SalesPaymentStoreRequest extends FormRequest
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
            "description" => "required|string|min:3|max:200",
            "type" => "required|string|min:3|max:200",
            "amount" => "required|min:0|numeric",
            "payment_date" => "required|date"
        ];
    }

    public function messages(): array
    {
        return [
            'description.required' => 'Açıklama alanı zorunludur.',
            'description.min' => 'Açıklama alanı minimum 3 karakter olmak zorundadır.',
            'description.max' => 'Açıklama alanı mmaksimum 200 karakter olmak zorundadır.',
            'type.required' => 'Ödeme Şekli alanı zorunludur.',
            'type.min' => 'Ödeme Şekli alanı minimum 3 karakter olmak zorundadır.',
            'type.max' => 'Ödeme Şekli alanı mmaksimum 200 karakter olmak zorundadır.',
            'amount.required' => 'Tutar alanı zorunludur.',
            'amount.min' => 'Tutar alanı minimum 0 olmak zorundadır.',
            'amount.numeric' => 'Tutar alanı sayısal bir değer  olmak zorundadır.',
            'payment_date.required' => 'Ödeme Tarihi alanı zorunludur.',
        ];
    }

    protected function prepareForValidation()
    {
    }
}
