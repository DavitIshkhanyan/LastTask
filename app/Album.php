<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = ['title', 'cover_image', 'user_id'];

    public function user()
    {
//        return $this->belongsTo('App\User', 'user_id', 'id');
        return $this->belongsTo('App\User');
    }

    public function photos()
    {
        return $this->hasMany('App\Photo');
    }
}
