<?php

namespace App\Http\Requests\Admin\Order;

use App\Enum\Order\OrderStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class OrderChangeStatusRequest extends FormRequest
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
            'status' => ['required', new Enum(OrderStatusEnum::class)]
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'Sipariş durum alanı zorunludur.',
            'status.enum' => 'Sipariş durum alanı geçerli bir değer olmak zorundadır.',
        ];
    }
}
