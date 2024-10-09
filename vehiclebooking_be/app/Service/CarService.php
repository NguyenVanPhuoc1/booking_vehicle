<?php

namespace App\Service;
//model base chung
use Illuminate\Database\Eloquent\Model;
use App\Models\Cars;

class CarService
{
    protected $query;

    public function __construct(Cars $model)
    {
        // Lưu query ban đầu từ model, có thể tái sử dụng trong các phương thức khác
        $this->query = $model->query();
    }

    protected function getQuery()
    {
        $query = Cars::query();
        return $query;
    }
    //lấy theo phương thức first
    // nếu dùng static :: thì tự động tạo câu query nếu đã có query thì nên dùng ->
    public function productbyFirst($slug, $ignoreId = null)
    {
        $product = $this->getQuery()->where('slug', $slug)->first();

        return $product;
    }
    //lấy theo phương thức get
    public function productbyGet($slug, $ignoreId = null)
    {
        $product = $this->getQuery()->where('slug', $slug)->get();

        return $product;
    }
    // Hàm tìm xe theo ID
    public function findCarById($id)
    {
        $car = $this->getQuery()->findOrFail($id);
        return $car;
    }

    public function getCarOutstanding()
    {
        $product_list = $this->getQuery()->where('noi_bat', '=', true)->orderBy('createdAt', 'desc')->limit(10)->get();
        // $product_list = Cars::where('noi_bat', true)->orderBy('createdAt', 'desc')->limit(10)->get();
        return $product_list;
    }
    public function getFilteredCars(array $filters)
    {
        // Khởi tạo truy vấn cho mô hình Car
        $query = $this->getQuery();

        // Áp dụng bộ lọc cho brand_id nếu có
        if (isset($filters['brand_id']) && is_array($filters['brand_id'])) {
            $query->whereIn('brand_id', $filters['brand_id']);
        }

        // Áp dụng bộ lọc cho priceRange nếu có
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

        // Áp dụng bộ lọc cho body_name và car_seats nếu có
        $query->whereHas('specification', function ($q) use ($filters) {
            if (isset($filters['body_name'])) {
                $q->whereIn('body', $filters['body_name']);
            }

            if (isset($filters['car_seats'])) {
                // Chuyển giá trị car_seats thành float
                $seats = array_map('floatval', $filters['car_seats']);
                $q->whereIn('seat', $seats);
            }
        });

        // Tối ưu hóa việc lấy dữ liệu với chunk()
        $cars = [];
        $query->with(['specification', 'getImageCars'])
            ->chunk(100, function ($chunk) use (&$cars) {
                foreach ($chunk as $car) {
                    $cars[] = $car;
                }
            });

        return $cars;
    }
}
