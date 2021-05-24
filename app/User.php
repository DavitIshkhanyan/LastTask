<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'full_name', 'DOB', 'gender_id', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function gender()
    {
        return $this->belongsTo('App\Gender', 'gender_id', 'id');
    }

    public function friendsOfMine()
    {
        return $this->belongsToMany('App\User', 'friends', 'user_id', 'friend_id');
    }

    public function friendOf()
    {
        return $this->belongsToMany('App\User', 'friends', 'friend_id', 'user_id');
    }

    public function friends()
    {
        return $this->friendsOfMine()->wherePivot('accepted', true)->get()
            ->merge( $this->friendOf()->wherePivot('accepted', true)->get() );
    }

    public function friendRequests()
    {
        return $this->friendsOfMine()->wherePivot('accepted', false)->get();
    }

    public function friendRequestsPending()
    {
        return $this->friendOf()->wherePivot('accepted', false)->get();
    }

    public function hasFriendRequestPending(User $user)
    {
        return (bool) $this->friendRequestsPending()->where('id', $user->id)->count();
    }

    public function hasFriendRequestReceived(User $user)
    {
        return (bool) $this->friendRequests()->where('id', $user->id)->count();
    }

    public function addFriend(User $user)
    {
        $this->friendOf()->attach($user->id);
    }

    public function deleteFriend(User $user)
    {
        $this->friendOf()->detach($user->id);
        $this->friendsOfMine()->detach($user->id);
    }

    public function acceptFriendRequest(User $user)
    {
        $this->friendRequests()->where('id',$user->id)->first()->pivot->update([
            'accepted' => true
        ]);
    }

    public function isFriendWith(User $user)
    {
        return (bool) $this->friends()->where('id', $user->id)->count();
    }

    public function albums()
    {
//        return $this->hasMany('App\Album', 'user_id', 'id')->get();
        return $this->hasMany('App\Album')->with('photos')->get();
    }

    public function comments()
    {
        return $this->hasMany('App\Comment')->get();
    }

    public function hasLikedPhoto(Photo $photo)
    {
        return (bool) $photo->likes
            ->where('likeable_id', $photo->id)
            ->where('likeable_type', get_class($photo))
            ->where('user_id', $this->id)
            ->count();
    }

    public function hasLikedComm(Comment $comm)
    {
        return (bool) $comm->likes
            ->where('likeable_id', $comm->id)
            ->where('likeable_type', get_class($comm))
            ->where('user_id', $this->id)
            ->count();
    }

    public function likes()
    {
        return $this->hasMany('App\Like', 'user_id');
    }
}
