<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Auth;
use App\Doctor;
use App\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
session_start();
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    /**
     * @param $token
     * @param bool $isAdmin
     * @param bool $isDoctor
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkToken($token, $isAdmin = false, $isDoctor = false)
    {
        $result = Auth::where(['token' => $token, 'delete_flg' => 0])->first();
        if ($result && !$isAdmin) {
            $user = User::where('id', $result['user_id'])->first();
            return $user;
        } elseif ($result && $isAdmin) {
            $user = Admin::where('id', $result['user_id'])->first();
            return $user;
        } elseif ($result && $isDoctor) {
            $user = Doctor::where('id', $result['user_id'])->first();
            return $user;
        }
        return $this->responseError('Token is expired or not found');
    }

    /**
     * @param null $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseSuccess($data = null)
    {
        if ($data == null) {
            $data = (object)[];
        }
        return response()->json([
            'data' => $data,
            'status' => 1
        ]);
    }

    /**
     * @param $error
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseError($error)
    {
        return response()->json([
            'error' => $error,
            'status' => 0
        ]);
    }
}
