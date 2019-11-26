<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{

    protected $appends = ['ward_name', 'province_name', 'district_name'];

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getWardNameAttribute()
    {
        $ward = Ward::where('ward_id', "{$this->ward_id}")->first();
        return $ward->name;
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getProvinceNameAttribute()
    {
        $ward = Province::where('province_id', "{$this->province_id}")->first();
        return $ward->name;
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getDistrictNameAttribute()
    {
        $ward = District::where('district_id', "{$this->district_id}")->first();
        return $ward->name;
    }
}
