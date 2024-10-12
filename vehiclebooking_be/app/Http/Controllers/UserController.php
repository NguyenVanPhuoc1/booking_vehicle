<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Cookie;
use Laravel\Socialite\Facades\Socialite;

use function response;

class UserController extends Controller
{
    // lấy data người dùng
    public function index(Request $request) 
    {
        dd('hello);die();
        // Lấy số bản ghi mỗi trang từ yêu cầu, mặc định là 100
        $perPage = $request->input('per_page', 10);
        $page = $request->input('page', 1);

        $customers = Customer::paginate($perPage, ['*'], 'page', $page);

        return response()->json($customers);
    }

    // đăng kí tài khoản
    public function register(RegisterRequest $request)
    {
        try {
            // $apiToken = Str::random(80);
            // Thực hiện thêm dữ liệu vào MongoDB
            User::insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->input('password')),
                'role' => 0, // phân quyền 1: admin, 0: người dùng

            ]);

            // Trả về phản hồi thành công
            return response()->json(['message' => 'Customer registered successfully'], 201);
        } catch (\Exception $e) {
            // Xử lý lỗi khác
            return response()->json([
                'error' => 'An error occurred while registering the customer. Please try again later.'
            ], 403);
        }
    }

    // đăng nhập tài khoản dưới các trường dữ liệu được nhập
    public function login(LoginRequest $request)
    {
        try {
            // Kiểm tra thông tin đăng nhập dùng auth(session based)
            // if (Auth::attempt($request->only('email', 'password'))) {
            //     $user = Auth::user();

            //     // Kiểm tra xem tùy chọn "Nhớ Tôi" có được chọn không
            //     if ($request->filled('remember_me') && $request->remember_me == true) {
            //         Auth::login($user, true); // Bật tính năng "remember_me"
            //     } else {
            //         Auth::login($user, false);
            //     }

            //     return response()->json([
            //         'user' => $user,
            //         'message' => 'Đăng nhập thành công.',
            //     ]);
            // }

            // // Nếu không đăng nhập được
            // return response()->json(['error' => 'Email hoặc mật khẩu đăng nhập không đúng!'], 403);
             // Kiểm tra thông tin đăng nhập dùng jwt(json web token)
            $credentials = $request->only('email', 'password');
            $remember = $request->has('remember_me') && $request->remember_me == true;
            $ttl = $remember ? (60 * 24 * 7) : 60;
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Thông tin đăng nhập không chính xác'], 401);
            }
            $user = $this->me();
            $token = JWTFactory::setTTL($ttl)->fromUser($user);

            return $this->respondWithToken($token,$user);
        
        } catch (\Exception $e) {
            // Bắt mọi lỗi và trả về phản hồi với chi tiết lỗi
            return response()->json([
                'error' => 'Đã xảy ra lỗi trong quá trình đăng nhập.',
                'message' => $e->getMessage(), // Bạn có thể hiển thị chi tiết lỗi trong quá trình phát triển
            ], 500); // Trả về mã lỗi 500 - Lỗi máy chủ
        }
    }
    protected function respondWithToken($token,$user)
    {
        // $user = $this->me();
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => $user,
        ],200);
    }
    // lấy thông tin người dùng
    public function me()
    {
        return response()->json(auth()->user());
    }

    // đăng nhập với Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            // Lấy thông tin người dùng từ Google
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Tìm hoặc tạo người dùng trong database
            $user = User::updateOrCreate(
                ['email' => $googleUser->getEmail()],
                ['name' => $googleUser->getName(), 'role' => 0]

            );

            // Đăng nhập người dùng
            Auth::login($user, true);

            // Chuyển hướng về Vue.js với token trong query string
            return '
            <html>
                <head>
                    <script>
                        function callOpenerFunction(username) {
                            if (window.opener && true) {
                                window.opener.postMessage({ action: \'callLoginCallback\', username: username }, \'*\');
                            } else {
                                console.log(`Cửa sổ chính không có hàm _doLoginFromCallback hoặc không thể gọi được.`);
                            }
                        }

                        // Gọi hàm khi cửa sổ popup được tải
                        window.onload = function() {
                            var username = `' . json_encode($user) . '`;
                            callOpenerFunction(username);
                        };
                    </script>
                </head>
            </html>
            ';
            // return redirect("http://localhost:5173/")->withHeader('userName',$user->name);
        } catch (\Exception $e) {
            // Xử lý lỗi nếu có https://booking-vehicle-hibw.vercel.app/
            return redirect('https://booking-vehicle-hibw.vercel.app/login?error=auth_failed');
        }
    }
    // đăng nhập với FaceBook
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->stateless()->redirect();
    }
    public function handleFacebookCallback()
    {
        try {
            // Lấy thông tin người dùng từ Google
            $googleUser = Socialite::driver('facebook')->stateless()->user();

            // Tìm hoặc tạo người dùng trong database
            $user = User::updateOrCreate(
                ['email' => $googleUser->getEmail()],
                ['name' => $googleUser->getName(), 'role' => 0]

            );

            // Đăng nhập người dùng
            Auth::login($user, true);

            // Chuyển hướng về Vue.js với token trong query string
            return '
            <html>
                <head>
                    <script>
                        function callOpenerFunction(username) {
                            if (window.opener && true) {
                                window.opener.postMessage({ action: \'callLoginCallback\', username: username }, \'*\');
                            } else {
                                console.log(`Cửa sổ chính không có hàm _doLoginFromCallback hoặc không thể gọi được.`);
                            }
                        }

                        // Gọi hàm khi cửa sổ popup được tải
                        window.onload = function() {
                            var username = `' . json_encode($user) . '`;
                            callOpenerFunction(username);
                        };
                    </script>
                </head>
            </html>
            ';
            // return redirect("http://localhost:5173/")->withHeader('userName',$user->name);
        } catch (\Exception $e) {
            // Xử lý lỗi nếu có
            return redirect('https://booking-vehicle-hibw.vercel.app/login?error=auth_failed');
        }
    }

    // update profile
    public function _updateProfile(Request $request){
        try{
            $user = User::where('email', $request->email)->first();
            if($user->name === $request->name){
                $user->update([
                    'birthday' => $request->birthday ?? $user->birthday, 
                    'gender' => $request->gender ?? $user->gender,
                ]);
            }
            return response()->json(['message' => 'Cập nhật thành công' ,'user' => $user], 200);
        }catch ( \Exception $e){
            return response()->json(['error' => 'Không cập nhật được'], 404);
        }
    }
}
