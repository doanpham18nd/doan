<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{

    protected $appends = ['format_total'];

    public function billDetail()
    {
        return $this->hasMany('App\BillDetail');
    }

    public function address()
    {
        return $this->belongsTo('App\UserAddress', 'user_address');
    }

    public function getFormatTotalAttribute()
    {
        return number_format("{$this->total}", 0, ".", '.');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
