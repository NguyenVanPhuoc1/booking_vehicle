<?php

namespace App\Http\Controllers;

use App\Models\CarBrand;
use Illuminate\Http\Request;

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
}
