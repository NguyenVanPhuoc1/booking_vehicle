<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cars;
use App\Models\CarBrand;
use App\Models\CarImages;
use App\Models\CarsSpecifications;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;
use App\Service\CarService;

class ProductController extends Controller
{
    protected $carService;

    public function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }
    public function _getCarOutstanding(){
        try{
            // $cars = Cars::where('noi_bat','=',true)->orderBy('createdAt', 'desc')->get();
            $cars = $this->carService->getCarOutstanding();
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
            // $car = Cars::where('slug', '=', $slug)->get(); 
            $car = $this->carService->productbyGet($slug);
            $car_detail = $car->load(['specification','getImageCars']);
            if (count($car_detail) < 1) {
                
                return response()->json([
                    'error' => 'Không tìm thấy sản phẩm.'
                ], 404);
            }
            
            return response()->json($car_detail,200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    // get all product
    public function _getAllProduct(Request $request){
        // Lấy số bản ghi mỗi trang từ yêu cầu, mặc định là 100
        $perPage = $request->input('per_page', 10);
        $page = $request->input('page', 1);
        $query = Cars::query();
        $cars = $query->with(['specification', 'getImageCars'])->paginate($perPage, ['*'], 'page', $page);

        return response()->json($cars);
    }
    
    protected function productNameExists($slug, $ignoreId = null)
    {
        // $query = Cars::where('slug', $slug)->first();

        // return $query;
        return $this->carService->productbyFirst($slug);
    }
    //add product
    public function _addProduct(ProductRequest $request){
        try {
            // Kiểm tra xem name có tồn tại không
            if ($this->productNameExists($request->input('slug_name_product')) != null) {
                $errors['product_name'] = ['Tên sản phẩm đã tồn tại trong hệ thống. Vui lòng nhập tên mới.'];
                return response()->json(['errors' => $errors], 422);
            }
            // Lưu ảnh và lấy đường dẫn
            $imagePaths = $this->storeImages($request->file('url_img'));
            // Thực hiện thêm dữ liệu vào MongoDB
            $car_info = Cars::create([
                'name' => $request->input('product_name'),
                'slug' => $request->input('slug_name_product'),
                'price_per_day' => intval($request->input('price')),
                'description' => $request->input('product_desc'),
                'noi_bat' => filter_var($request->input('noi_bat'), FILTER_VALIDATE_BOOLEAN),
                'brand_id' => $request->input('brand_id'),
            ]);
            CarsSpecifications::insert([
                'car_id' => $car_info->_id,
                'body' => $request->input('spec_body'),
                'seat' => intval($request->input('spec_seat')),
                'door' => intval($request->input('spec_door')),
                'interiorColor' => $request->input('spec_interiorColor'),
                'car_slug' => $car_info->slug,
            ]);
            CarImages::insert([
                'car_id' => $car_info->_id,
                'url_img' => $imagePaths,
            ]);
            // Trả về phản hồi thành công
            return response()->json(['message' => 'Add Product successfully','car_info' => $car_info ], 201);
        } catch (\Exception $e) {
            // Xử lý lỗi khác
            return response()->json([
                'error' => "Don't add product successfully. Please try again later."
            ], 403);                                                                                        
        }
    }
    //update product
    public function _updateProduct(ProductRequest $request,$slug){
        try {
            $product = $this->productNameExists($slug);
            $product_exist = $this->productNameExists($request->input('slug_name_product'));
            if ($request->input('product_name') !== null) {
                if ($request->input('product_name') !== $product->name) {
                    // Kiểm tra xem name có tồn tại không
                    if ($product_exist !== null) {
                        $errors['product_name'] = ['Tên sản phẩm đã tồn tại trong hệ thống. Vui lòng nhập tên mới.'];
                        return response()->json(['errors' => $errors], 422);
                    }
                }
    
                    $product->update([
                        'name' => $request->input('product_name'),
                        'slug' => $request->input('slug_name_product'),
                        'price_per_day' => intval($request->input('price')),
                        'description' => $request->input('product_desc'),
                        'noi_bat' => filter_var($request->input('noi_bat'), FILTER_VALIDATE_BOOLEAN),
                        'brand_id' => $request->input('brand_id'),
                    ]);
                    //Lọc và chuẩn bị dữ liệu cho bảng CarsSpecifications
                    $spec_info = $product->specification();
                    $spec_info->update([
                        // 'car_id' => $product->_id,
                        'body' => $request->input('spec_body'),
                        'seat' => intval($request->input('spec_seat')),
                        'door' => intval($request->input('spec_door')),
                        'interiorColor' => $request->input('spec_interiorColor'),
                        // 'car_slug' =>  $request->input('slug_name_product'),
                    ]);
                    // xóa ảnh trước rồi cập nhật sau
                    // $this->deleteCarImages($car_info->_id);
                    $imagesList = $request->file('url_img') ? $request->file('url_img') : null;
                    $imagesUrl = $request->input('url_img') ? $request->input('url_img') : null;
                    $imagePaths = array_merge($this->storeImages($imagesList),$this->storeImages($imagesUrl));
                    $product_img = $product->getImageCars();
                    $product_img->update([
                        'url_img' => $imagePaths
                    ]);
    
                    return response()->json(['message' => 'Update Product Successfully'],200);
            }
        } catch (\Exception $e) {
            // Xử lý lỗi khác
            return response()->json([
                'error' => "Don't update product successfully. Please try again later."
            ], 403);
        }
    }

    public function _checkBoxNoiBat(Request $request, $id)
    {
        // $product = Cars::findOrFail($id);
        $product = $this->carService->findCarById($id);
        // Cập nhật trường 'noi_bat' với giá trị từ request
        $product->noi_bat = filter_var($request->input('noi_bat'), FILTER_VALIDATE_BOOLEAN);
        $product->save();

        return response()->json(['message' => 'Product updated successfully'], 200);
    }

    //tạo mảng chứa ảnh
    protected function storeImages($images) {
        // Kiểm tra nếu $images là null hoặc không phải là mảng
        if (empty($images) || !is_array($images)) {
            return []; // Trả về mảng rỗng
        }
        $imagePaths = [];
    
        foreach ($images as $image) {
            if (is_string($image)) {
                // Nếu $image là đường dẫn đã tồn tại (string), chỉ cần thêm nó vào mảng
                $imagePaths[] = $image; // Đường dẫn đã có
            } elseif ($image instanceof \Illuminate\Http\UploadedFile) {
                // Nếu $image là file tải lên, xử lý và lưu trữ nó
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('public/images', $filename);
                $imagePaths[] = url('storage/images/' . $filename); // Lưu đường dẫn tuyệt đối
            }
        }
    
        return $imagePaths;
    }

    protected function deleteCarImages($carId)
    {
        // Lấy các đường dẫn ảnh từ cơ sở dữ liệu (mảng URL)
        $carImages = CarImages::where('car_id', $carId)->get();
        $carImagesUrl = $carImages->pluck('url_img'); // Lấy ra mảng các URL ảnh

        // Duyệt qua các ảnh và xóa chúng từ thư mục lưu trữ
        foreach ($carImagesUrl as $imageUrl) {
            // Lấy phần đường dẫn thực tế trong storage (loại bỏ phần http://127.0.0.1:8000/storage/)
            $imagePath = str_replace('http://127.0.0.1:8000/storage/', 'public/', $imageUrl);

            // Kiểm tra xem đường dẫn ảnh có tồn tại không và xóa file ảnh
            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
        }

        // Xóa các bản ghi trong cơ sở dữ liệu
        CarImages::where('car_id', $carId)->delete();
    }
    public function _deleteSelectedProducts(Request $request){
        try{
            $ids = $request->input('ids');

            // Lấy danh sách các bản ghi Cars cần xóa
            $cars = Cars::whereIn('_id', $ids)->get();
    
            // Duyệt qua từng bản ghi Cars và xóa các liên kết liên quan trước
            foreach ($cars as $car) {
                // Xóa các bản ghi liên quan trong CarsSpecifications
                $car->specification()->delete();
    
                // Xóa các bản ghi hình ảnh liên quan trong CarImages
                $car->getImageCars()->delete();
            }
    
            // Sau khi xóa các liên kết, xóa bản ghi chính trong Cars
            Cars::whereIn('_id', $ids)->delete();
        
            return response()->json(['message' => 'Các phần tử đã được xóa.']);
        }catch( \Exception $e){
            return response()->json(['error' => 'Danh sách ID không hợp lệ.'], 422);
        }
    }

}
