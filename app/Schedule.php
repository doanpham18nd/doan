<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{

    protected $appends = ['thumbnail'];

    public function scheduleContents()
    {
        return $this->hasMany('App\ScheduleContent');
    }

    /**
     * @return string
     */
    public function getThumbnailAttribute()
    {
        return asset('images/schedule') . '/' .$this->attributes['thumbnail'];
    }
}
