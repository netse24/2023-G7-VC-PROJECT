<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateUserRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['success' => false, 'message' => $validator->errors()], 412));
    }

    public function rules(): array
    {
        return [
            "first_name"=>"required|max:100",
            "last_name"=>"required|max:50000",
            "gender"=>"required",
            "email"=>[
                "required",
                "min:1",
                "max:100",
                Rule::unique('users')->ignore($this->user)
            ],
            "date_of_birth" => "required",
            "address" =>"required",
        ];
    }
}