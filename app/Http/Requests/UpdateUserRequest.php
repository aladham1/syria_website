<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'phone' => "required|numeric|unique:users,phone,{$this->id},id",
            'email' => "required|email|unique:users,email,{$this->id},id",
        ];
        if ($type == 'admin') {
            $inputs += [
                'password' => 'required|min:6',
            ];
        } else {
            $inputs += [
                'login_code' => "required|unique:users,login_code,{$this->id},id",
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
        ];
    }
}
