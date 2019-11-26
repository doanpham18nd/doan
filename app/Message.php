<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    public function user()
    {
        $this->belongsTo('App\User', 'patient_id');
    }

    public function admin()
    {
        $this->belongsTo('App\Admin', 'doctor_id');
    }
}
