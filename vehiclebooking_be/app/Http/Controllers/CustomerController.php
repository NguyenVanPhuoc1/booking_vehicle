<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerQuestion;
use App\Http\Requests\CustomerRequest;
use App\Models\Customer;

use function response;

class CustomerController extends Controller
{
    // add cus_question
    public function _addCusQuestion(CustomerRequest $request)
    {
        try {
             // Tìm khách hàng theo email
            $customer = Customer::where('email','=' ,$request -> email)->first();

            if (!$customer) {
                // Nếu không tìm thấy khách hàng, tạo mới
                $customer = Customer::create([
                    'name' => $request -> name,
                    'email' => $request -> email,
                    'phone' => $request -> phone,
                ]);
            }
                // // Thêm câu hỏi cho khách hàng
                CustomerQuestion::updateOrCreate(
                    ['cus_id' => $customer->_id], // Điều kiện tìm kiếm bản ghi
                    ['cus_question' => $request->cus_ques, 'noi_bat' => true] 
                );
            // Trả về phản hồi thành công
            return response()->json(['message' => 'add question successfully'], 200);
            // return response()->json($customer, 200);

        } catch (\Exception $e) {
            // Xử lý lỗi khác
            return response()->json([
                'error' => 'An error occurred while add question. Please try again later.'
            ], 403);
        }
    }
}
