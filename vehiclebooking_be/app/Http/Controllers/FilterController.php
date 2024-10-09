<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cars;
use App\Http\Controllers\ProductController;
use App\Service\CarService;

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
    protected $carService;

    public function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }
    public function _getDataFilter(Request $request)
    {
        // Lấy các tham số lọc từ yêu cầu
        $filters = $request->query('params', []);

        $cars = $this->carService->getFilteredCars($filters);
        // Trả về kết quả dưới dạng JSON
        return response()->json($cars);
    }
}
