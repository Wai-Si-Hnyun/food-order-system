<?php

namespace App\Http\Requests;

use App\Rules\MatchUserPassword;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $userId = $this->input('user_id');

        return [
            'billingInfo.name' => 'required|string|max:255',
            'billingInfo.country' => 'required',
            'billingInfo.state' => 'required',
            'billingInfo.city' => 'required',
            'billingInfo.address' => 'required|max:255',
            'billingInfo.phone' => 'required|string|max:15|regex:/^(\+\d+|\d+)$/',
            'billingInfo.password' => ['required', new MatchUserPassword($userId)],
        ];
    }

    public function messages()
    {
        return [
            'billingInfo.name.required' => 'Name is required',
            'billingInfo.country.required' => 'Country is required',
            'billingInfo.state.required' => 'State is required',
            'billingInfo.city.required' => 'City is required',
            'billingInfo.address.required' => 'Address is required',
            'billingInfo.phone.required' => 'Phone is required',
            'billingInfo.password.required' => 'Password is required',
            'billingInfo.name.string' => 'Name must be a string',
            'billingInfo.phone.string' => 'Invalid phone number',
            'billingInfo.name.max' => 'Name must be less than 255 characters',
            'billingInfo.address.max' => 'Address must be less than 255 characters',
            'billingInfo.phone.max' => 'Phone must be less than 15 characters',
            'billingInfo.phone.regex' => 'Invalid phone number',
        ];
    }
}
