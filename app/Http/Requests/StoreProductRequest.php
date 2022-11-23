<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['bail', 'required'],
            'description' => ['required', 'max:700'],
            'quantity' => ['required', 'integer', 'min:1'],
            'status' => Rule::in([Product::AVAILABLE_PRODUCT, Product::UNAVAILABLE_PRODUCT]),
            'seller_id' => ['required'],
            'image' => ['required', 'image']
        ];
    }
}
