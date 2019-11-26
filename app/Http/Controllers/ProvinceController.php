<?php

namespace App\Http\Controllers;

use App\District;
use App\Province;
use App\Ward;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function index()
    {
        try {
            $data = Province::get();
            return $this->responseSuccess($data);
        } catch (\Exception $exception) {
            return $this->responseError($exception->getMessage());
        }
    }

    /**
     * @param $provinceId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDistrict($provinceId)
    {
        try {
            $data = District::where('province_id', $provinceId)->get();
            return $this->responseSuccess($data);
        } catch (\Exception $exception) {
            return $this->responseError($exception->getMessage());
        }
    }

    /**
     * @param $districtId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getWard($districtId)
    {
        try {
            $data = Ward::where('district_id', $districtId)->get();
            return $this->responseSuccess($data);
        } catch (\Exception $exception) {
            return $this->responseError($exception->getMessage());
        }
    }
}
