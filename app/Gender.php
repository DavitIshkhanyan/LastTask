<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    protected $fillable=['title'];

    public function users(){
        return $this->hasMany('App\User','gender_id','id')->get();
    }
}
