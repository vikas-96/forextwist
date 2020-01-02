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
        $emailValidation = 'required|email|unique:users,email';
        $status = "sometimes|required";
        if ($this->method() == 'PUT' || $this->method() == 'PATCH') {
            $emailValidation = 'required|email|unique:users,email,' . $this->user . ',id';
            $status = "sometimes|required|in:active,inactive";
        }
        return [
            'firstname' => 'required|regex:/^[a-z\d\.-_\s]+$/i',
            'lastname' => 'required|regex:/^[a-z\d\.-_\s]+$/i',
            'email' => $emailValidation,
            'password' => 'sometimes|required|string|confirmed',
            'contact' => 'required|numeric',
            'dob' => 'sometimes|required|date:YYYY-MM-DD|before:today',
            'country' => 'sometimes|required',
            'state' => 'sometimes|required',
            'city' => 'sometimes|required',
            'pincode' => 'sometimes|required|min:5',
            'address' => 'sometimes|required',
            'status' => $status
        ];
    }
}
