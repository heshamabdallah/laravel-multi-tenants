<?php

namespace App\Http\Requests\Tenant;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'user_id' => [
                'required',
                'integer',
                'exists:users,id',
            ],
            'products' => [
                'required',
                'array',
                'min:1',
            ],
            'products.*.product_id' => [
                'required',
                'distinct',
                'integer',
                'exists:products,id'
            ],
            'products.*.quantity' => [
                'required',
                'integer',
                'min:1',
                // We need to add max per each product to make sure user can't request
                // more than available quantites unless backorder allowed
            ],
        ];
    }
}
