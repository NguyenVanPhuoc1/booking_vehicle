<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Arr;
use App\Models\CustomerCarRentals;
use App\Http\Requests\BookingRequest;
use Carbon\Carbon; 
use function response;

class BookingController extends Controller
{
    // đăng nhập tài khoản dưới các trường dữ liệu được nhập
    public function _bookingCar(BookingRequest $request)
    {
        // dd($request);die();
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
            $selectedOption = $request->selected_car;
            $array = explode('-', $selectedOption);
            
            $carName = trim(Arr::get($array, 0)); // Lấy tên xe
            $price = intval(str_replace('$', '', trim(Arr::get($array, 1)))); // Xóa ký hiệu $ và khoảng trắng rồi chuyển đổi thành số nguyên
            // Tính số ngày thuê từ ngày bắt đầu đến ngày kết thúc
            $startDate = Carbon::parse($request->start_date);
            $endDate = Carbon::parse($request->end_date);

            // Tính số ngày: Số ngày thuê là tổng số ngày từ ngày bắt đầu tới ngày kết thúc
            $daysRented = $endDate->diffInDays($startDate) + 1; // Thêm 1 để tính cả ngày bắt đầu

            // Tính tổng giá tiền
            $totalPrice = intval($price * $daysRented);
            CustomerCarRentals::updateOrCreate(
                ['cus_id' => $customer->_id], // Điều kiện tìm kiếm bản ghi
                [
                    'car_select' => $carName, 
                    'car_price' => $totalPrice,
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
