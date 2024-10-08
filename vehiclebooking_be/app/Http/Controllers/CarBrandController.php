<?php

namespace App\Http\Controllers;

use App\Models\CarBrand;
use App\Models\Cars;
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

    protected function brandNameExists($brandName, $ignoreId = null)
    {
        $query = CarBrand::where('brand_name', $brandName);

        // Nếu có ID, loại trừ bản ghi hiện tại (trong trường hợp cập nhật)
        // if ($ignoreId) {
        //     $query->where('id', '!=', $ignoreId);
        // }

        // return $query->exists();
        return $query->limit(1)->count('_id') > 0;
    }


    public function _addBrand(BrandRequest $request)
    {
        try {
            // Kiểm tra xem brand_name có tồn tại không
            if ($this->brandNameExists($request->brand_name)) {
                $errors['brand_name'] = ['Tên Hãng đã tồn tại trong hệ thống. Vui lòng nhập tên mới.'];
                return response()->json(['errors' => $errors], 422);
            }

            // Thực hiện thêm dữ liệu vào MongoDB
            CarBrand::create([
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

    public function _updateBrand(BrandRequest $request)
    {
        try {
            // Tìm bản ghi theo ID
            $brand = CarBrand::find($request->id);
            
            if ($brand) {
                // Xây dựng mảng dữ liệu để cập nhật
                $updateData = [];
                $errors = [];

                // Kiểm tra và cập nhật brand_name
                if ($request->has('brand_name') && $request->brand_name !== null) {
                    if ($request->brand_name !== $brand->brand_name) {
                        // Kiểm tra xem brand_name mới có tồn tại không
                        if ($this->brandNameExists($request->brand_name, $request->id)) {
                            $errors['brand_name'] = ['Tên Hãng đã tồn tại trong hệ thống. Vui lòng nhập tên mới.'];
                            return response()->json(['errors' => $errors], 422);
                        }
                    }
                    $updateData['brand_name'] = $request->brand_name;
                }
                
                // Cập nhật các trường khác
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
    public function _checkBoxNoiBat(Request $request, $id)
    {
        $brand = CarBrand::findOrFail($id);

        // Cập nhật trường 'noi_bat' với giá trị từ request
        $brand->noi_bat = $request->input('noi_bat');
        $brand->save();

        return response()->json(['message' => 'Brand updated successfully', 'brand' => $brand], 200);
    }

    public function _deleteSelectedBrands(Request $request)
    {
        $ids = $request->input('ids'); // Lấy danh sách các ID từ yêu cầu

        if (is_array($ids)) {
            if($this->checkCar($ids)){
                return response()->json(['error' => 'Sản Phẩm của hãng còn tồn tại.'], 400);
            }else{
                // Xóa các phần tử có ID trong danh sách
                CarBrand::whereIn('_id', $ids)->delete();
    
                return response()->json(['message' => 'Các phần tử đã được xóa.']);
            }
        }

        return response()->json(['error' => 'Danh sách ID không hợp lệ.'], 422);
    }
    public function checkCar($ids){
        return Cars::whereIn('brand_id', $ids)->exists();
    }

}
