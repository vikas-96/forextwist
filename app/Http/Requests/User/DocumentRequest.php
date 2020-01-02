<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class DocumentRequest extends FormRequest
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
        $document_name = array_keys(config('dropdowns.document_name'));
        if ($this->method() == 'PUT' || $this->method() == 'PATCH') {
            return [
                'status' => "required|in:pending,approved"
            ];
        }

        return [
            'name' => "required|in:".implode(',',$document_name),
            'path' => "required"
        ];
    }
}
