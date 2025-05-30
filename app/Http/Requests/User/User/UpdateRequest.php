<?php

namespace App\Http\Requests\User\User;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the User is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     * Rule::unique('users')->ignore($this->route('user'))
     */

   
    public function rules(): array
    {
        return [
            'account' => [
                'required',
                'string',
                'min:4',
                Rule::unique('users')->ignore($this->route('user'))
            ],
            'email' => 'nullable|string|email|max:191',
            'name' => 'required|string',
            'cid' => 'required',
            'user_catalogue_id'=> 'gt:0',
        ];
    }

    
    public function attributes(): array{
        return [
            'account' => 'tài khoản',
            'name' => 'Họ tên',
            'cid' => 'Số hiệu CBCC',
            'user_catalogue_id' => 'Chức vụ',
            'password' => 'mật khẩu',
            're_password' => 'nhập lại mật khẩu' ,
        ];
    }

    public function messages(): array{
        return [
            'account.required' => 'Bạn chưa nhập :attribute',
            'account.string' => 'Tên :attribute phải là kiểu chuỗi',
            'account.min' => 'Tên :attribute phải có tối thiểu 4 ký tự',
            'email.required' => 'Bạn chưa nhập :attribute',
            'email.string' => 'Tên :attribute phải là kiểu chuỗi',
            'email.email' => 'Email chưa đúng định dạng. Ví dụ: abc@gmail.com',
            'email.max' => 'Độ dài :attribute tối đa 191 ký tự',
            'name.required' => 'Bạn chưa nhập :attribute',
            'name.string' => 'Tên :attribute phải là kiểu chuỗi',
            'cid.required' => 'Bạn chưa nhập :attribute',
            'user_catalogue_id.gt' => 'Bạn chưa nhập :attribute',
            'password.required' => 'Bạn chưa nhập vào :attribute',
            'password.min' => 'Mật khẩu phải có tối thiểu 6 ký tự',
        ];
    }

  

}