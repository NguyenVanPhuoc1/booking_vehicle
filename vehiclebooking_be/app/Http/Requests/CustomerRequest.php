<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:6|max:50|regex:/^[\pL\s]+$/u',
            'email' => 'required|email',
            'phone' => 'required|digits:10|starts_with:0',
            'cus_ques' => 'required',
        ];
    }
    // return message
    public function messages(){
        return[
            'name.required' => 'Tên người dùng là bắt buộc.',
            'name.string' => 'Tên người dùng phải là một chuỗi.',
            'name.min' => 'Tên người dùng phải có ít nhất 6 ký tự.',
            'name.max' => 'Tên người dùng không được quá 50 ký tự.',
            'name.regex' => 'Tên người dùng không hợp lệ. Ví dụ "Nguyễn Văn A"',
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email phải là một địa chỉ email hợp lệ.',
            'phone.required' => 'Số điện thoại không được để trống.',
            'phone.digits' => 'Số điện thoại bắt buộc là 10 số.',
            'phone.starts_with' => 'Số điện thoại phải bắt đầu từ số 0.',
            'cus_ques.required' => 'Địa chỉ người nhận không được để trống.',
        ];
    }
}
