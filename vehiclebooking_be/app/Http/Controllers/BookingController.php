<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Arr;
use App\Models\CustomerCarRentals;
use App\Http\Requests\BookingRequest;
use function response;

class BookingController extends Controller
{
    // đăng nhập tài khoản dưới các trường dữ liệu được nhập
    public function _bookingCar(BookingRequest $request)
    {
        try {
            $customer = Customer::where('email','=' ,$request -> cus_email)->first();
            // tìm k có thêm mới
            if (!$customer) {
                // Nếu không tìm thấy khách hàng, tạo mới
                $customer = Customer::create([
                    'name' => $request -> cus_name,
                    'email' => $request -> cus_email,
                    'phone' => $request -> cus_phone,
                ]);
            }
            $selectedOption = $request->input('selected_car');
            $array = explode(' - ', $selectedOption);
            $carName = trim(Arr::get($array, 0));
            $price = intval(Arr::get($array, 1));
            CustomerCarRentals::updateOrCreate(
                ['cus_id' => $customer->_id], // Điều kiện tìm kiếm bản ghi
                [
                    'car_select' => $carName, 
                    'car_price' => $price,
                    'pickup_location' => $request -> pickup_location,
                    'destination' => $request -> destination,
                    'start_date' => $request -> start_date,
                    'end_date' => $request -> end_date,
                ] 
            );

            // Trả về phản hồi thành công
            return response()->json(['message' => 'Booking successfully'], 201);
        } catch (\Exception $e) {
            // Xử lý lỗi khác
            return response()->json([
                'error' => 'An error occurred while booking the car. Please try again later.'.$e
            ], 403);
        }
    }
}
