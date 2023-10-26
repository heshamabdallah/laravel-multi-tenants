<?php

namespace App\Http\Requests\Tenant;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'min:2',
                'max:255'
            ],
            'sku' => [
                'required',
                'string',
                'min:1',
                'max:255',
                'unique:products,sku'
            ],
            'quantity' => [
                'required',
                'integer',
                'min:0',
            ],
            'price' => [
                'required',
                'decimal:0,2',
                'min:1',
                'max:9999999',
            ],
            'currency' => [
                'required',
                'string',
                // For simplicity we use one currency, if the products have multiple currencies
                // Then when an order is created we need to do currency conversion to a base currency
                Rule::in(['EGP'])
            ]
        ];
    }
}
