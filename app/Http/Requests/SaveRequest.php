<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Factory;

class SaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'title' => 'required | min:5| max:100',
            'content' => 'required',
            'role_id'=>'required',
            'deadline' => 'required|date|after:yesterday',
            'priority' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '* Bạn chưa nhập tên yêu cầu',
            'content.required' => '* Bạn chưa nhập nội dung',
            'title.min' => 'Tên yêu cầu tối thiểu 5 kí tự',
            'title.max' => 'Tên yêu cầu tối thiểu 100 kí tự',
            'deadline.required' => '* Bạn chưa nhập deadline',
            'role_id.required' => '* Bạn chưa chọn đầu việc',
            'priority.required' => '* Bạn chưa lựa chọn độ ưu tiên',
            'deadline.after' => ' * Deadline phải lớn hơn hiện tại',
            'deadline.date' => '* Bạn nhập sai định dang dd/mm/YYYY',
        ];

    }
}
