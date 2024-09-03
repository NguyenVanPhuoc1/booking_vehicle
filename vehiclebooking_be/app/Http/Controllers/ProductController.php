<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cars;

class ProductController extends Controller
{
    public function _getCarOutstanding(){
        try{
            $cars = Cars::where('noi_bat','=',true)->orderBy('createdAt', 'desc')->get();
            // $cars = Cars::where('noi_bat','=','true')->get();
            return response()->json($cars);
        }
        catch(\Exception $e){
            return response() -> json([
                'error' => 'Không tìm thấy sản phẩm.'
            ], 404);
        }
    }
    // get detail data with slug
    public function _getDataCarDetail_slug($slug){
        try {
            // Lấy thông tin chi tiết của xe và bao gồm cả specification và getImageCars
            $car = Cars::where('slug', '=', $slug)->get(); 
            $car_detail = $car->load(['specification','getImageCars']);
            if (!$car_detail) {
                return response()->json([
                    'error' => 'Không tìm thấy sản phẩm.'
                ], 404);
            }
            
            return response()->json($car_detail);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }
    
}
