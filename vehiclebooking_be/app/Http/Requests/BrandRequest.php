<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BrandRequest extends FormRequest
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
        // Kiểm tra xem có ID trong request để quyết định quy tắc `unique`
        $rules = [
            'brand_name' => [
                'required',
                'string',
                'max:255',
            ],
        ];

        return $rules;
    }
    // hàm xuất lỗi
    public function messages(): array
    {
        return [
            'brand_name.required' => 'Tên hãng không được để trống.',
            'brand_name.string' => 'Tên hãng dùng phải là một chuỗi.',
            'brand_name.max' => 'Tên hãng không được quá dài.',
            // 'brand_name.unique' => 'Tên Hãng đã tồn tại trong hệ thống. Vui lòng nhập tên mới.',
        ];
    }
}
