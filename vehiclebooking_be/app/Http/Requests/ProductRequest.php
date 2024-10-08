<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $rules = [
            'product_name' => 'required|string|max:255',
            'price' => 'required|numeric|max:500',
            'brand_id' => 'required|min:1|exists:car_brand,_id',
        ];

        return $rules;
    }
    public function messages()
    {
        return [
            'product_name.required' => 'Tên sản phẩm là bắt buộc.',
            'product_name.string' => 'Tên sản phẩm phải là chuỗi ký tự.',
            'product_name.max' => 'Tên sản phẩm không được vượt quá 255 ký tự.',

            'price.required' => 'Giá sản phẩm là bắt buộc.',
            'price.numeric' => 'Giá sản phẩm phải là một số.',
            'price.max' => 'Giá sản phẩm không được vượt quá 500.',

            'brand_id.required' => 'Hãng không được để trống!',
            'brand_id.min' => 'Giá trị không được để trống!',
            'brand_id.exists' => 'Hãng không tồn tại!',
        ];
    }

}
