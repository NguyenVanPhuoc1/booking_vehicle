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
    //lấy thông tin hãng theo id
    public function _getDetailBrand(Request $request){
        $BrandDetail = CarBrand::find($request -> id);
        if($BrandDetail){
            return response()->json($BrandDetail,200);
        }
        return response()->json([
            'error' => 'Not fetch data.'
        ], 404);
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
    public function _updateBrand(Request $request){
        try {
            // Tìm bản ghi theo ID
            $brand = CarBrand::find($request->id);
            
            if ($brand) {
                // Xây dựng mảng dữ liệu để cập nhật
                $updateData = [];
    
                // Thêm trường vào mảng cập nhật nếu giá trị không phải là null
                if ($request->has('brand_name') && $request->brand_name !== null) {
                    $updateData['brand_name'] = $request->brand_name;
                }
                
                if ($request->has('brand_slug') && $request->brand_slug !== null) {
                    $updateData['brand_slug'] = $request->brand_slug;
                }
                
                if ($request->has('noi_bat') && $request->noi_bat !== null) {
                    $updateData['noi_bat'] = $request->noi_bat;
                }
    
                if (!empty($updateData)) {
                    // Cập nhật dữ liệu nếu mảng cập nhật không rỗng
                    $brand->update($updateData);
                }
    
                // Trả về phản hồi thành công
                return response()->json(['message' => 'Update Brand successfully'], 200);
            } else {
                return response()->json(['error' => 'Brand not found.'], 404);
            }
        } catch (\Exception $e) {
            // Xử lý lỗi khác
            return response()->json([
                'error' => "Don't update brand successfully. Please try again later."
            ], 403);
        }
    }

    public function _deleteBrand(){
        
    }
    
}
