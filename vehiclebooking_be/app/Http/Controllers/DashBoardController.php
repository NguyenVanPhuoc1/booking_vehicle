<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Vormkracht10\Analytics\Facades\Analytics;
use Vormkracht10\Analytics\Period;
use Illuminate\Support\Carbon;

class DashBoardController extends Controller
{
    public function _getDataUserViewPage(Request $request)
    {
        // Lấy giá trị từ request, mặc định là '7day'
        $duration = $request->get('gia_tri', '7day');
        
        // Xác định khoảng thời gian
        $startDate = Carbon::now();
        switch ($duration) {
            case '30day':
                $startDate->subDays(30);
                break;
            default:
                $startDate->subDays(7);
                break;
        }
        $endDate = Carbon::now();

        // Lấy dữ liệu và trả về dưới dạng JSON
        $data = $this->getData($startDate, $endDate);
        return response()->json($data);
    }

    private function getData($startDate, $endDate)
    {
        // Lấy dữ liệu từ Google Analytics
        $analyticsData = Analytics::totalViewsByDate(Period::make($startDate, $endDate));
        $numberOfDays = $endDate->diffInDays($startDate) + 1;
        $data = [];
        $currentDate = clone $startDate;

        // for ($i = 0; $i < $numberOfDays; $i++) {
        //     $data[] = [
        //         'date' => $currentDate->toDateString(),
        //         'screenPageViews' => $analyticsData[$i]['screenPageViews'] ?? 0,
        //     ];

        //     $currentDate->addDay();
        // }
        // Chuyển đổi ngày trong dữ liệu thành định dạng dd-mm-yyyy
        $dataDates = array_map(function($data) {
            return Carbon::createFromFormat('Ymd', $data['date'])->format('d-m-Y');
        }, $analyticsData);

        for ($i = 0; $i < $numberOfDays; $i++) {
            // Chuyển đổi ngày hiện tại thành định dạng dd-mm-yyyy
            $currentDateString = $currentDate->format('d-m-Y');

            // Kiểm tra nếu ngày hiện tại có trong dữ liệu
            if (in_array($currentDateString, $dataDates)) {
                // Lấy dữ liệu cho ngày hiện tại
                $dataItem = array_filter($analyticsData, function($item) use ($currentDateString) {
                    return Carbon::createFromFormat('Ymd', $item['date'])->format('d-m-Y') === $currentDateString;
                });

                $dataItem = array_shift($dataItem); // Lấy phần tử đầu tiên của mảng lọc

                $data[] = [
                    'date' => $currentDateString,
                    'screenPageViews' => $dataItem['screenPageViews'] ?? 0,
                ];
            } else {
                // Ngày không có dữ liệu
                $data[] = [
                    'date' => $currentDateString,
                    'screenPageViews' => 0,
                ];
            }

            $currentDate->addDay();
        }
        return $data;
        // return $analyticsData;
    }
}
