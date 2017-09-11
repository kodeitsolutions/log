<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
    //protected $redirectTo = '/entry';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    protected function authenticated($request, $user)
    {
        if ($user->isGuard) {
            return redirect('/shift/choose');
        }   
        else {
            return redirect('/entry');
        }
    }

    public function username()
    {
        return 'username';
    } 

    public function logout()
    {
        $user = Auth::user();
        if ($user->isGuard) {
            $user->shift = null;
            $user->save();
        }

        Auth::logout();
        Session::flush();
        
        return redirect('login');
    }   
}
