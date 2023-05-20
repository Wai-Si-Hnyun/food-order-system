<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WishlistRequest extends FormRequest
{
    /**
     * Determine if the Category is authorized to make this request.
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
            'product_id' => ['unique:wishlists,product_id'],
        ];
    }
}
