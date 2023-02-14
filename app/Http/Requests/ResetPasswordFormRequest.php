<?php

namespace App\Http\Requests;

use App\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordFormRequest extends FormRequest
{
    use FailedValidation;

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
            'email' => 'required',
            'token' => 'required',
            'password' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'A email is required',
            'token.required' => 'A token is required',
            'password.required' => 'A password is required',
        ];
    }
}
