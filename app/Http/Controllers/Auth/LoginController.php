<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // public function login()
    // {
    //     return view('auth.login');
    // }

    // public function customlogin(Request $request)
    // {
    //     // dd($request->all());
    //     $request->validate([
    //         'email' => 'required',
    //         'password' => 'required',
    //     ]);

    //     $credentials = [
    //         'username' => $request['email'],
    //         'password' => $request['password'],
    //     ];

    //     if(Auth::attempt($credentials)) {
    //         return redirect()->intended('members/dashboard')
    //                     ->withSuccess('Signed in');
    //     }

    //     return redirect("login")->withError('Login details are not valid');
    // }
}
