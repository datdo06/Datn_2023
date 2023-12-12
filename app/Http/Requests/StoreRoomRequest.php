<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomRequest extends FormRequest
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
        if (!empty($this->room->id)) {
            return [
                'type_id' => 'required',
                'acreage' => 'required|numeric',
                'location' => 'required',
                'room_status_id' => 'required',
                'number' => 'required|unique:rooms,number,' . $this->room->id,
                'capacity' => 'required|numeric',
                'price' => 'required|numeric',
                'view' => 'required|max:255'
            ];
        }
        return [
            'type_id' => 'required',
            'acreage' => 'required|numeric',
            'location' => 'required',
            'room_status_id' => 'required',
            'number' => 'required|unique:rooms,number',
            'capacity' => 'required|numeric',
            'price' => 'required|numeric',
            'view' => 'required|max:255'
        ];
    }
    public function messages(){
        return [
            'type_id.required' => 'Chọn quận huyện',
            'room_status_id.required' => 'Chọn trạng thái',
            'acreage.required' => 'Diện tích không được để trống',
            'number.required' => 'Tên không được để trống',
            'number.unique' => 'Tên đã tồn tại',
            'capacity.required' => 'Số người ở không được để trống',
            'price.required' => 'Giá tiền không được để trống',
            'view.required' => 'Phong cảnh không được để trống',
            'location.required' => 'Địa chỉ không được để trống',
            'acreage.numeric' => 'Chưa đúng định dạng số',
            'capacity.numeric' => 'Chưa đúng định dạng số',
            'price.numeric' => 'Chưa đúng định dạng số',
        
        ];
    }
}
