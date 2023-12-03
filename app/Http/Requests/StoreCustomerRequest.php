<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
            'name' => 'required',
            'phone'=>['required', 'regex:/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/', 'min:8', 'unique:users,phone'],
            'email' => ['required', 'email:rfc,dns', 'unique:users,email'],
            'avatar' => 'mimes:png,jpg',
            'password' => [
                'required',
                'string',
                'min:6',          
                'regex:/[a-z]/',    
                'regex:/[A-Z]/',
                'regex:/[0-9]/',     
                'regex:/[@$!%*#?&]/', 
            ],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên không được để trống',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.regex' => 'Số điện thoại không đúng định dạng',
            'phone.min' => 'Số điện thoại không đúng định dạng',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải dài trên 6 kí tự',
            'password.regex' => 'Mật khẩu phải có ít nhất 1 số, 1 chữ viết hoa và 1 kí tự đặc biệt ',
        ];
    }
}
