<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['album_id', 'title', 'photo'];

    public function album()
    {
        return $this->belongsTo('App\Album');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function likes()
    {
        return $this->morphMany('App\Like', 'likeable');
    }


}
