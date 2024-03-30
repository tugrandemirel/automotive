<?php

namespace App\Http\Requests\User;

use App\Enum\User\UserStatusEnum;
use App\Models\Company;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\Password;

class UserStoreRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:190',
            'username' => 'required|string|min:3|max:190',
            'phone' => 'required|string|min:3|max:15',
            'email' => 'required|string|min:3|max:50|email|unique:App\Models\User,email',
            'password' => ['required', Password::defaults()],
            'status' => ['required', new Enum(UserStatusEnum::class)],
            'company_id' => 'required|exists:App\Models\Company,id'
        ];
    }

    protected function prepareForValidation(): void
    {
        /** @var Company $companyId */
        $companyId = Company::query()
            ->where('id', $this->get('company'))
            ->firstOrFail()->id;

        $this->merge([
           'company_id' => $companyId
        ]);
    }
}
