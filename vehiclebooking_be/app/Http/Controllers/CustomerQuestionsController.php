<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerQuestion;

class CustomerQuestionsController extends Controller
{
    public function _getAllQuestions(Request $request){
        try{
            $perPage = $request->input('per_page', 10);
            $page = $request->input('page', 1);
    
            $allQuestion = CustomerQuestion::paginate($perPage, ['*'], 'page', $page);
            return response()->json($allQuestion);
        }
        catch(\Exception $e)
        {
            return response()->json([
                'error' => 'Not fetch data.'
            ], 404);
        }
    }
    //update question
    public function _updateQuestion(Request $request, $id){
        $request->validate([
            'ans_ques' => 'string',
        ]);
        try {
            // Tìm bản ghi theo ID
            $cus_ques = CustomerQuestion::find($id);
            
            if ($cus_ques) {
                // Xây dựng mảng dữ liệu để cập nhật
                $updateData = [];

                if ($request->has('ans_ques') && $request->ans_ques !== null) {
                    $updateData['ans_ques'] = $request->ans_ques;
                }
                
                if ($request->has('noi_bat') && $request->noi_bat !== null) {
                    $updateData['noi_bat'] = $request->noi_bat;
                }

                if (!empty($updateData)) {
                    // Cập nhật dữ liệu nếu mảng cập nhật không rỗng
                    $cus_ques->update($updateData);
                }

                // Trả về phản hồi thành công
                return response()->json(['message' => 'Update question successfully', $request->ans_ques], 200);
            } else {
                return response()->json(['error' => 'Question not found.'], 404);
            }
        } catch (\Exception $e) {
            // Xử lý lỗi khác
            return response()->json([
                'error' => "Don't update question successfully. Please try again later."
            ], 403);
        }
    }
}
