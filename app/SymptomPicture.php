<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SymptomPicture extends Model
{
    protected $table = 'symptom_pictures';
    //
    public function symptom()
    {
        return $this->belongsTo('App\Symptom');
    }

    protected $appends = ['picture_name'];

    protected $hidden = ['created_at', 'updated_at'];

    /**
     * @return string
     */
    public function getPictureNameAttribute()
    {
        return asset('images/symptoms') . '/' .$this->attributes['picture_name'];
    }
}
