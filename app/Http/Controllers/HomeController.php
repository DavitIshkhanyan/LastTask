<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        $user = User::where('username', $username)->first();

        return view('home')->with('status', 'You are logged in!');
//        return redirect()->route('home')->with('info', 'You are logged in!');
//        return redirect()
//            ->route('profile.index', ['username' => $username])
//            ->with('info', "Friend request sended");
    }
}
