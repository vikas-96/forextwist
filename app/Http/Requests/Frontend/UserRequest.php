<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $emailValidation = 'sometimes|required|email|unique:users,email';
        if ($this->method() == 'PUT' || $this->method() == 'PATCH') {
            // $id = $this->route()->parameter('borrower');
            $emailValidation = 'sometimes|required|email|unique:users,email,' . $this->borrower . ',id';
        }
        return [
            'firstname' => 'sometimes|required|regex:/^[a-z\d\.-_\s]+$/i',
            'lastname' => 'sometimes|required|regex:/^[a-z\d\.-_\s]+$/i',
            'email' => $emailValidation,
            'password' => 'sometimes|required',
            'contact' => 'sometimes|required|numeric',
            'dob' => 'sometimes|required|date:YYYY-MM-DD|before:today',
            'country' => 'sometimes|required',
            'state' => 'sometimes|required',
            'city' => 'sometimes|required',
            'pincode' => 'sometimes|required|min:5',
            'address' => 'sometimes|required'
        ];
    }
}
