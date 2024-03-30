<?php

namespace App\Http\Requests\Front\Cart;

use App\Enum\Product\ProductStatusEnum;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class CartStoreRequest extends FormRequest
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
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1'
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required' => 'Ürün gereklidir.',
            'product.exists' => 'Ürün bulunamadı.',
            'quantity.required' => 'Ürün Adedi gereklidir.',
            'quantity.min' => 'Ürün en az bir adet seçilmelidir.',
            'quantity.numeric' => 'Ürün en az bir adedi sayısal değer olmak zorundadır.',
        ];
    }

}
