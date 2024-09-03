<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            're_password' => 'required|string|same:password',
        ];
    }
    // hàm xuất lỗi
    public function messages()
    {
        return [
            'name.required' => 'Tên người dùng là bắt buộc.',
            'name.string' => 'Tên người dùng phải là một chuỗi.',
            'name.min' => 'Tên người dùng phải có ít nhất 6 ký tự.',
            'name.max' => 'Tên người dùng không được quá 50 ký tự.',
            'name.regex' => 'Tên người dùng không hợp lệ. Ví dụ "Nguyễn Văn A"',
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email phải là một địa chỉ email hợp lệ.',
            'email.unique' => 'Email đã tồn tại trong hệ thống. Vui lòng nhập email khác.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.string' => 'Mật khẩu phải là một chuỗi ký tự.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            're_password.required' => 'Mật khẩu là bắt buộc.',
            're_password.same' => 'Mật khẩu nhập lại không khớp!',
        ];
    }
}
