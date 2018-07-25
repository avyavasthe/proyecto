<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

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
    protected $redirectTo = '/';

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

     public function register(Request $request)
     {
         $this->validator($request->all())->validate();

         event(new Registered($user = $this->create($request->all())));

         $this->guard()->login($user);

         return $this->registered($request, $user)
                         ?: redirect($this->redirectPath());
     }

    protected function validator(array $data)
    {

        return Validator::make($data, [
          'name' => 'required|max:40',
          'email' => 'required|unique:users|max:60|email',
          'iden' => 'required|unique:users|max:15',
          'telefono' => 'required|max:20',
          'foto' => 'max:50',
          'direccion' => 'required|max:60',
          'entidad' => 'required',
          'password' => 'required|confirmed',
          'terminos' => 'required',
        ]);
    }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */



    protected function create(array $data)
    {
      $path='1';

      if (isset($data['foto'])) {

        $folder= 'avatars';

        $path=$data['foto']->store($folder,'public');






  }

        return User::create([
          'name'=>$data['name'],
          'email'=>$data['email'],
          'iden'=>$data['iden'],
          'entidad'=>$data['entidad'],
          'direccion'=>$data['direccion'],
          'telefono'=>$data['telefono'],

          'foto'=> $path,
          'password'=>Hash::make($data['password']),
        ]);
    }









}