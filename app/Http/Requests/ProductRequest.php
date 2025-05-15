<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'product_id' => 'exists:products,id',
            'name' => 'required|min:2',
            'quantity' => 'required|integer|gt:1',
            'description' => 'required|min:2',
            'price' => 'required|numeric|gt:0',
            'types' => 'required|in:digital,physical',
            
        ];
    }
}
