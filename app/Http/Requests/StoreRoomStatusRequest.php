<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomStatusRequest extends FormRequest
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
        if (!empty($this->roomstatus->id)) {
            return [
                'name' => 'required|max:255',
                'code' => 'required|unique:room_statuses,code,' . $this->roomstatus->id
            ];
        }
        return [
            'name' => 'required|max:255',
            'code' => 'required|unique:room_statuses,code'
        ];
    }
    public function messages(){
        return [
            'name.required' => 'Tên không được để trống',
            'name.max' => 'Tên quá dài',
            'code.required' => 'Mã không được để trống',
            'code.unique' => 'Mã đã tồn tại',
        ];
    }
}
