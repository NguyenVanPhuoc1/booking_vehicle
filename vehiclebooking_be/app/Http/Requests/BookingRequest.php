<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
        $today = now()->toDateString();
        return [
            'selected_car' => 'required|string', // required và phải là kiểu chuỗi (string)
            'pickup_location' => 'required|string', // required và phải là kiểu chuỗi (string)
            'destination' => 'required|string', // required và phải là kiểu chuỗi (string)
            'start_date' => 'required|date|after_or_equal:today|before:end_date', // required, kiểu ngày và phải nhỏ hơn end_date
            'end_date' => 'required|date|after:start_date', // required, kiểu ngày và phải lớn hơn start_date
            'cus_name' => 'required|string', // required và phải là kiểu chuỗi (string)
            'cus_email' => 'required|email', // required và phải là kiểu email
            'cus_phone' => 'required|digits:10|starts_with:0', // required và phải là kiểu chuỗi (string)
            'cus_request' => 'nullable|string', 
        ];
    }
    public function messages()
    {
        return [
            'selected_car.required' => 'You must select a car.',
            'pickup_location.required' => 'Please provide a pickup location.',
            'destination.required' => 'Please provide a destination.',
            'start_date.required' => 'Start date is required.',
            'start_date.after_or_equal' => 'The start date must be today or a future date.',
            'start_date.before' => 'Start date must be before the end date.',
            'end_date.required' => 'End date is required.',
            'end_date.after' => 'End date must be after the start date.',
            'cus_name.required' => 'Please provide your name.',
            'cus_email.required' => 'Please provide your email.',
            'cus_email.email' => 'Please provide a valid email address.',
            'cus_phone.required' => 'Please provide your phone number.',
            'cus_phone.digits' => 'Số điện thoại bắt buộc là 10 số.',
            'cus_phone.starts_with' => 'Số điện thoại phải bắt đầu từ số 0.',
        ];
    }
}
