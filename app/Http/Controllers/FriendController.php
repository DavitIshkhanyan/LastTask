<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function getIndex()
    {
        $friends = Auth::user()->friends();
        $requests = Auth::user()->friendRequests();

        return view('friends.index', [
            'friends' => $friends,
            'requests' => $requests
        ]);
    }

    public function getAdd($username)
    {
        $user = User::where('username', $username)->first();

        if( ! $user ) {
            return redirect()
                ->route('home')
                ->with('info', "User don't found");
        }

        if (Auth::user()->id === $user->id){
            return redirect()
                ->route('home')
                ->with('info', "You can't send friend request to yourself :)");
        }

        if ( Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user()) ) {
            return redirect()
                ->route('profile.index', ['username' => $user->username])
                ->with('info', "Friend request is already send");
        }

        if ( Auth::user()->isFriendWith($user) ){
            return redirect()
                ->route('profile.index', ['username' => $user->username])
                ->with('info', "User is already in friends");
        }

        Auth::user()->addFriend($user);

        return redirect()
            ->route('profile.index', ['username' => $username])
            ->with('info', "Friend request sended");

//            ->back()->with( ['username' => $username])
//            ->with('info', "Friend request sended");
    }

    public function getAccept($username)
    {
        $user = User::where('username', $username)->first();

        if( ! $user ) {
            return redirect()
                ->route('home')
                ->with('info', "User don't found");
        }

        if ( ! Auth::user()->hasFriendRequestReceived($user) ) {
            return redirect()->route('home');
        }

        Auth::user()->acceptFriendRequest($user);

        return redirect()
            ->route('profile.index', ['username' => $username])
            ->with('info', "Friend request accepted");
    }

    public function postDelete($username)
    {
        $user = User::where('username', $username)->first();

        if ( ! Auth::user()->isFriendWith($user) ){
            return redirect()->back();
        }

        Auth::user()->deleteFriend($user);

        return redirect()->back()->with('info', 'Deleted from friends');
    }
}
