<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{

    protected $appends = ['thumbnail_web', 'thumbnail_app'];

    protected $hidden = ['created_at', 'updated_at'];

    /**
     * @return string
     */
    public function getThumbnailAppAttribute()
    {
        return asset('images/article/thumbnail') . '/' . "{$this->thumbnail}";
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getThumbnailWebAttribute()
    {
        return asset("images/article") . "/" . "{$this->thumbnail}";
    }
}
