<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the Product is authorized to make this request.
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
     * @return array
     */
    public function rules()
    {
        return [
            'category' => ['required'],
            'productName' => ['required', 'max:50'],
            'productImage' => ['required', 'mimes:jpg,jpeg,png,webp', 'file'],
            'productDescription' => ['required', 'min:10'],
            'productPrice' => ['required'],
        ];
    }
}
