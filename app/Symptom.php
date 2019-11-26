<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function symptomPictures()
    {
        return $this->hasMany('App\SymptomPicture');
    }

    /**
     * @return bool|null
     * @throws \Exception
     */
    public function delete()
    {
        $this->symptomPictures()->delete();
        return parent::delete();
    }
}
