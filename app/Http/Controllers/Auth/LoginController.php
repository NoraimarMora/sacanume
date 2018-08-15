<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function redirectTo() 
    {
        if(Auth::check()) {
            return redirect()->route('inicio');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        if(Auth::check()) {
            return redirect()->route('inicio');
        }

        return view('auth/login');
    }

    public function processLogin()
    {
    }

    public function login(Request $request) 
    {
        $data = array(
            'username' => $request->username,
            'password' => $request->password
        );

        if(Auth::attempt($data)) {
            return redirect()->route('inicio');
        }

        return redirect()->action('Auth\LoginController@index')->with('error', 'Usuario y/o Contraseña invalido');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->action('Auth\LoginController@index');
    }
}
