<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    //lấy tin nổi bật
    public function _getDataNewsOutstanding(){
        try{
            // $news = News::where('noi_bat','=',true)->orderBy('created_at', 'desc')->get();
            $news = News::where('noi_bat','=',true)->get();
            return response()->json($news);
        }
        catch(\Exception $e){
            return response() -> json([
                'error' => 'Không tìm thấy tin tuc noi bat.'
            ], 404);
        }
    }
}
