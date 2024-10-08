<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cars;
use App\Http\Controllers\ProductController;

class FilterController extends Controller
{
    // public function filterByBrandName($query, $filters)
    // {
    //     $query->whereHas('carBrand', function($q) use ($filters) {
    //         $q->where('brand_name', $filters['brand_name']);
    //     });

    //     return $query;
    // }

    // // Phương thức để lọc theo khoảng giá
    // public function filterByPriceRange($query, $filters)
    // {
    //     if (isset($filters['price_min'])) {
    //         $query->where('price', '>=', $filters['price_min']);
    //     }

    //     if (isset($filters['price_max'])) {
    //         $query->where('price', '<=', $filters['price_max']);
    //     }

    //     return $query;
    // }

    // // Phương thức để lọc theo kiểu thân xe
    // public function filterByBody($query, $filters)
    // {
    //     $query->whereHas('carSpecification', function($q) use ($filters) {
    //         $q->where('body', $filters['body']);
    //     });

    //     return $query;
    // }

    // // Phương thức để lọc theo số ghế
    // public function filterBySeats($query, $filters)
    // {
    //     $query->whereHas('carSpecification', function($q) use ($filters) {
    //         $q->where('seats', $filters['seats']);
    //     });

    //     return $query;
    // }

    public function _getDataFilter(Request $request)
    {
        // Lấy các tham số lọc từ yêu cầu
        $filters = $request->query('params', []);

        // Khởi tạo truy vấn cho mô hình Car
        $query = Cars::query();
        // Áp dụng các bộ lọc vào truy vấn
        if (isset($filters['brand_id']) && is_array($filters['brand_id'])) {
            $query->whereIn('brand_id', $filters['brand_id']);
        }

        if (isset($filters['priceRange']) && is_array($filters['priceRange'])) {
            $minPrice = isset($filters['priceRange'][0]) ? floatval($filters['priceRange'][0]) : null;
            $maxPrice = isset($filters['priceRange'][1]) ? floatval($filters['priceRange'][1]) : null;

            if ($minPrice !== null) {
                $query->where('price_per_day', '>=', $minPrice);
            }

            if ($maxPrice !== null) {
                $query->where('price_per_day', '<=', $maxPrice);
            }
        }
        $query->whereHas('specification', function($q) use ($filters, &$seat) {
            if (isset($filters['body_name'])) {
                $q->whereIn('body', $filters['body_name']);
            }
        
            if (isset($filters['car_seats'])) {
                $seat = array_map('floatval', $filters['car_seats']);;
                $q->whereIn('seat', $seat);
            }
        });

        // Lấy danh sách các xe theo bộ lọc
        // $cars = $query->with(['specification', 'getImageCars'])->get();
        $cars = [];
        $query->with(['specification', 'getImageCars'])->chunk(100, function ($chunk) use (&$cars) {
            // Thêm mỗi lô kết quả vào mảng $cars
            foreach ($chunk as $car) {
                $cars[] = $car;
            }
        });
        // Trả về kết quả dưới dạng JSON
        return response()->json($cars);
    }
}
