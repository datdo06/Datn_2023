<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCouponRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'coupon_name' => 'required',
            'coupon_code' => 'required',
            'coupon_time' => 'required',
            'coupon_number' => 'required',
            'coupon_condition' => 'required',
        ];
    }
    public function messages(){
        return [
            'coupon_name.required' => 'Tên mã giảm giá không được để trống',
            'coupon_code.required' => 'Mã không được để trống',
            'coupon_time.required' => 'Số mã còn lại không được để trống',
            'coupon_number.required' => 'Số tiền giảm không được để trống',
            'coupon_condition.required' => 'Phương thức không được để trống',
        ];
    }
}
