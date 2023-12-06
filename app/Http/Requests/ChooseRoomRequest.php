<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChooseRoomRequest extends FormRequest
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
            'count_person' => 'required|numeric',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in|after_or_equal:today'
        ];
    }
    public function messages()
    {
        return[
        'count_person.required' => 'Nhập số người',
        'check_in.required' => 'Chọn ngày đến',
        'check_in.after_or_equal' => 'Ngày đến phải sau ngày hôm nay',
        'check_out.required' => 'Chọn ngày đi',
        'check_out.after' => 'Ngày đi phải sau ngày đến',
        'check_out.after_or_equal' => 'Ngày đi phải sau ngày hôm nay',
        'count_person.numeric' => 'Số người chưa đúng định dạng',

        ];
    }
}
