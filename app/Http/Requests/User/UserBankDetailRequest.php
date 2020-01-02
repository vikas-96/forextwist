<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserBankDetailRequest extends FormRequest
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
        $accountValidation = 'required|numeric|digits_between:8,17|unique:user_bank_details,account_number';
        $status = "sometimes|required";
        if ($this->method() == 'PUT' || $this->method() == 'PATCH') {
            $accountValidation = 'required|numeric|digits_between:8,17|unique:user_bank_details,account_number,' . $this->user_bank_detail . ',id';
            $status = "sometimes|required|in:active,inactive";
        }

        return [
            'nick_name' => "required|regex:/^[a-z\d\.-_\s]+$/i",
            'bank_name' => "required",
            'account_name' => "required",
            'account_number' => $accountValidation,
            'ifsc_code' => "required|regex:/^[A-Za-z]{4}\d{7}$/i",
            'branch_name' => "required",
            'country' => "required",
            'state' => "required",
            'city' => "required",
            'status' => $status
        ];
    }
}
