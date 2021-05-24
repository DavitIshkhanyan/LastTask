<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Foundation\Auth\ConfirmsPasswords;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;



use Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = User::all();
        return view('profiles.all_profiles',['profiles'=>$profiles]);

    }

    public function getProfile($username)
    {
        $profile = User::where('username',$username)->first();

        if (!$profile) {
            abort(404);
        }
        return view('profiles.single_profile',['profile'=>$profile]);
    }

    public function edit()
    {
        return view('profiles.edit');
    }

    public function update(Request $request)
    {
        if($request->input('username') !== Auth::user()->username){
            $request->validate([ 'username' => ['required', 'string', 'max:255', 'unique:users']]);
        }
        if($request->input('email') !== Auth::user()->email){
            $request->validate([ 'email' => ['required', 'string', 'email', 'max:255', 'unique:users']]);
        }

        $request->validate([ 'avatar' => 'mimes:jpg,jpeg,png|image|max:1999']);

        if($request->file('avatar') !== null){
            $path = $request->file('avatar')->store('avatars', 'public');
        }
        Auth::User()->update([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'full_name' => $request->input('full_name'),
            'DOB' => $request->input('DOB'),
            'gender_id' => $request->input('gender'),
            'avatar' => ($request->file('avatar')!=null)?($path):(Auth::user()->avatar),
        ]);

        return redirect()->route('profile.edit')->with('info','Profile Updated');
    }

    public function editPassword()
    {
        return view('profiles.edit_pass');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        if(! Hash::check($request->input('old_password'), Auth::user()->password)){
            return back()->with('error', 'Invalid Password');
        }
        else if( Hash::check($request->input('password'), Auth::user()->password)){
            return back()->with('error', "New password and old password can't be the same");
        }
        else{
            Auth::User()->update([
            'password' => Hash::make($request->input('password')),
            ]);
            return redirect()->route('edit_pass')->with('info','Password Changed');
        }
    }
}
