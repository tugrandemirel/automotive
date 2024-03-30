<?php

namespace App\Http\Requests\Admin\Company;

use App\Enum\Company\CompanyCreditCanPayEnum;
use App\Enum\Company\CompanyCurrentCanPayEnum;
use App\Enum\Company\CompanyCurrentEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CompanyUpdateRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'email' =>'required|string|max:50',
            'phone' => 'required|string|max:50',
            'code' => 'required|string|max:190',
            'bank_information' => 'nullable|string|max:500',
            'description' => 'nullable|string|max:500',
            'file' => 'nullable',
            'current' => ['required', new Enum(CompanyCurrentEnum::class)],
            'current_can_pay' => ['required', new Enum(CompanyCurrentCanPayEnum::class)],
            'credit_can_pay' => ['required', new Enum(CompanyCreditCanPayEnum::class)],
            'general_discount' => 'required|numeric',
            'advance_discount' => 'required|numeric',
            'one_shot_discount' => 'required|numeric',
            'city' => 'required|string|max:30',
            'district' => 'required|string|max:30',
            'address' => 'array',
            'tax_administration' => 'required|string|max:50',
            'identity_number' => 'required|string|max:20',
            'authorized_person' => 'required|array',
            'authorized_person.name.*' => 'required|min:3|max:190',
            'authorized_person.email.*' => 'required|min:3|max:190',
            'authorized_person.phone.*' => 'required|min:3|max:20',
            'authorized_person.gsm.*' => 'nullable|min:3|max:20',
        ];
    }
}
