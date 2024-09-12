<?php

namespace App\Http\Controllers;

use App\Models\CarBrand;
use Illuminate\Http\Request;
use App\Http\Requests\BrandRequest;

use function response;

class CarBrandController extends Controller
{
    public function _getAllBrand(){
        try{
            $allBrandName = CarBrand::all();
            return response()->json($allBrandName);
        }
        catch(\Exception $e)
        {
            return response()->json([
                'error' => 'Not fetch data.'
            ], 404);
        }
    }

    public function _addBrand(BrandRequest $request){
        try {
            // $apiToken = Str::random(80);
            // Thực hiện thêm dữ liệu vào MongoDB
            CarBrand::insert([
                'brand_name' => $request->brand_name,
                'brand_slug' => $request->brand_slug,
                'noi_bat' => $request->noi_bat,
            ]);

            // Trả về phản hồi thành công
            return response()->json(['message' => 'Add Brand successfully'], 201);
        } catch (\Exception $e) {
            // Xử lý lỗi khác
            return response()->json([
                'error' => "Don't add brand successfully. Please try again later."
            ], 403);
        }
    }
}
