<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    //lấy tin nổi bật
    public function _getDataNewsOutstanding(Request $request){
        try{
            //return về câu query
            $newsQuery = News::orderBy('created_at', 'desc');

            if ($request->input('page') === 'index_page') {
                $newsQuery->where('noi_bat', '=', true)->limit(3);
            }
            
            $news = $newsQuery->get();
            
            return response()->json($news);
        }
        catch(\Exception $e){
            return response() -> json([
                'error' => 'Không tìm thấy tin tuc noi bat.'
            ], 404);
        }
    }
}
