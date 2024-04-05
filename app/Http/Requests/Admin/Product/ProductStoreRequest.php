<?php

namespace App\Http\Requests\Admin\Product;

use App\Enum\Product\ProductStatusEnum;
use App\Enum\Product\ProductUnitEnum;
use App\Models\Brand;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class ProductStoreRequest extends FormRequest
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
            'code' => 'required|string|min:3|max:190',
            'name' => 'required|string|min:3|max:190',
            'quantity' => 'required|numeric',
            'critical_quantity' => 'required|numeric',
            'purchase_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'currency_id' => 'required|numeric|exists:currencies,id',
            'description' => 'nullable|string|min:3|max:250',
            'images' => 'nullable|array',
            'images.*' => 'nullable|mimes:jpg,jpeg,png',
            'meta_keywords' => 'nullable|string|min:3|max:150',
            'meta_description' => 'nullable|string|min:3|max:150',
            'status' => ['required', new Enum(ProductStatusEnum::class)],
            'brand_id' => 'required|exists:brands,id',
            'unit' => ['required', new Enum(ProductUnitEnum::class)],
        ];
    }

    protected function prepareForValidation(): void
    {
        $brandId = Brand::query()
            ->where('slug', $this->get('brand'))
            ->firstOrFail()
            ->id;

        $this->merge([
            'brand_id' => $brandId
        ]);
    }
}
