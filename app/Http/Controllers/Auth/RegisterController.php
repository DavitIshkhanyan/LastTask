<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

//use Image;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validator = Validator::make($data, [
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'register_email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'register_password' => ['required', 'string', 'min:8', 'confirmed'],
             'avatar' => ['mimes:jpg,jpeg,png', 'image', 'max:1999']
        ]);

        $validator->setAttributeNames([
            'username' => 'username',
            'register_email' => 'email',
            'register_password' => 'password',
            'avatar' => 'avatar'
        ]);

        return $validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
//        dd(time() . '.'.$data['avatar']->getClientOriginalExtension());
//        dd($data);
        if(count($data)==10){
            $path = $data['avatar']->store('avatars', 'public');
        }
        return User::create([
            'username' => $data['username'],
            'email' => $data['register_email'],
            'password' => Hash::make($data['register_password']),
            'full_name' => $data['first_name'].' '.$data['last_name'],
            'DOB' => $data['DOB'],
            'gender_id' => $data['gender'],
//            'avatar' => (count($data)==10)?(time() . '.'.$data['avatar']->getClientOriginalExtension()):(null),
            'avatar' => (count($data)==10)?($path):('avatars/User-Default.jpg'),

        ]);
    }
}
