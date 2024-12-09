<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $type = $this->user_type;
        $inputs = [
            'name' => 'required',
            'phone' => 'required|numeric|unique:users',
            'email' => 'required|email|unique:users',
        ];

        if ($type == 'admin') {
            $inputs += [
                'password' => 'required|min:6',
            ];
        } else {
            $inputs += [
                'login_code' => 'required|unique:users',
            ];
        }
        return $inputs;
    }


    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => __('Name'),
            'email' => __('Email'),
            'phone' => __('Phone'),
            'password' => __('Password'),
            'login_code' => __('Login code'),
        ];
    }
}
