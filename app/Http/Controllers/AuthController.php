<?php

namespace App\Http\Controllers;

use App\Auth;
use App\Doctor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class AuthController extends Controller
{
    protected $request;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->responseError($validator->errors()->first());
        }
        $user = User::where(['email' => $data['email'], 'password' => Hash::check('password', $data['password'])])->with('address')->first();
        if ($user) {
            $token['token'] = Str::random(64);
            $token['user_id'] = $user['id'];
            $token['delete_flg'] = 0;
            Auth::insert($token);
            $user['token'] = $token['token'];
            if (isset($_SESSION['cart' . $data['userId']])) {
                $res = $_SESSION['cart' . $data['userId']];
                $newUserId = 'cart' . $user['id'];
                $_SESSION[$newUserId] = $res;
                unset($_SESSION[$data['userId']]);
            }
            return $this->responseSuccess($user);
        } else {
            return $this->responseError('User not found or not register yet');
        }

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLoginAdmin()
    {
        return view('admin.blocks.login');
    }

    /**
     * @param AdminLoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginAdmin(AdminLoginRequest $request)
    {
        $data = $request->all();
        $user = Admin::where(['username' => $data['username'], 'password' => Hash::check('password', $data['password'])])->first();
        if ($user) {
            $token['token'] = StringHelper::randomUnique(64);
            $token['user_id'] = $user->id;
            $token['delete_flg'] = 0;
            $this->auth->insert($token);
            $user['token'] = $token['token'];
            return redirect(route('admin.getIndex'));
        } else {
            return back()->with('error', 'Tên đăng nhập hoặc mật khẩu không chính xác!');
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginDoctor()
    {
        $data = $this->request->all();
        $validator = Validator::make($data, [
            'username' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->responseError($validator->errors()->first());
        }
        $user = Doctor::where(['username' => $data['username'], 'password' => Hash::check('password', $data['password'])])->first();
        if ($user) {
            $token['token'] = StringHelper::randomUnique(64);
            $token['user_id'] = $user->id;
            $token['delete_flg'] = 0;
            $this->auth->insert($token);
            $user['token'] = $token['token'];
            return $this->responseSuccess($user);
        } else {
            return $this->responseError('User not found or not register yet');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        $data = $this->request->all();
        $result = $this->checkToken($data['token']);
        if ($result) {
            $tokens = $this->auth->where('token', $data['token'])->first();
            $tokens->delete_flg = 1;
            $tokens->save();
            return response()->json(['status' => Response::HTTP_OK]);
        }
        return response()->json(['status' => Response::HTTP_FORBIDDEN]);
    }


}
