<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{

    protected $table = 'medicines';

    protected $appends = ['thumbnail_web', 'thumbnail_app', 'format_price', 'category_name', 'body_content'];

    protected $hidden = ['created_at', 'updated_at', 'thumbnail'];

    /**
     * @return string
     */
    public function getThumbnailAppAttribute()
    {
        return asset('images/medicine/thumbnail') . '/' . "{$this->thumbnail}";
    }

    /**
     *
     * @return string
     */
    public function getThumbnailWebAttribute()
    {
        return asset("images/medicine") . "/" . "{$this->thumbnail}";
    }

    public function getFormatPriceAttribute()
    {
        return number_format("{$this->price}", 0, ".", '.');
    }

    public function getCategoryNameAttribute()
    {
        $cate = config('category');
        if("{$this->category}" <= 5) {
            return $cate['category1']["{$this->category}" - 1]['name'];
        } else if("{$this->category}" > 5 && "{$this->category}" <= 10) {
            return $cate['category2']["{$this->category}" - 6]['name'];
        } else if("{$this->category}" > 10) {
            return $cate['category3']["{$this->category}" - 11]['name'];
        }
    }

    public function getBodyContentAttribute()
    {
        $data = '<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body style="text-align: center; font-size: 30px"><div>';
        $data .= $this->content;
        $data .='
</div></body>
</html>
';
        return $data;
    }
}
