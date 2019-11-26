<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{

    protected $appends = ['slide', 'image_content'];
    /**
     * @return string
     */
    public function getSlideAttribute()
    {
        return asset('images/promotion/slide') . '/' . "{$this->slide_image}";
    }

    /**
     *
     * @return string
     */
    public function getImageContentAttribute()
    {
        return asset("images/promotion") . "/" . "{$this->content_image}";
    }
}
