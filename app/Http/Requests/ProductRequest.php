<?php

namespace App\Http\Requests;

use App\Enums\ProductStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
        $statuses = implode(',', array_column(ProductStatusEnum::cases(), 'value'));

        $articleRule = [
            (!auth()->user()->isAdmin() && request()->isMethod('put')) ? 'prohibited' : '',
            'required', 'string', Rule::unique('products')->ignore($this->product)];

        return [
            'article' => $articleRule,
            'name' => ['required', 'string', 'min:10'],
            'status' => ['required', "in:{$statuses}"],
            'data' => ['required', 'array'],
            'data.*.key' => ['required', 'string', 'max:255'],
            'data.*.value' => ['required', 'string', 'max:255'],
        ];
    }
}
