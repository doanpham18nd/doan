<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    protected $appends = ['medicine_name', 'image_thumbnail', 'format_price', 'alias'];

    public function getMedicineNameAttribute()
    {
        $medicine = Medicine::where('id', "{$this->medicine_id}")->first();
        return $medicine->name;
    }

    public function getAliasAttribute()
    {
        $medicine = Medicine::where('id', "{$this->medicine_id}")->first();
        return $medicine->alias;
    }

    public function getImageThumbnailAttribute()
    {
        $medicine = Medicine::where('id', "{$this->medicine_id}")->first();
        return asset("images/medicine") . "/" . "{$medicine->thumbnail}";
    }

    public function getFormatPriceAttribute()
    {
        $medicine = Medicine::where('id', "{$this->medicine_id}")->first();
        return number_format("{$medicine->price}", 0, ".", '.');
    }
}
