<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailRequest extends FormRequest
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
        return [
            'recipient_email' => 'required|email',
            'recipient_name' => 'required',
            'subject' => 'required',
            'body' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'recipient_email.required' => 'Email is required',
            'recipient_email.email' => 'Email is invalid',
            'recipient_name.required' => 'Name is required',
            'subject.required' => 'Subject of the email is required',
            'body.required' => 'Body of the email is required'
        ];
    }
}
