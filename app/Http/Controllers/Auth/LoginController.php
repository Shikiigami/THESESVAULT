<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\recentLogin;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::DASHBOARD;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'ends_with:@psu.palawan.edu.ph'],
            'password' => ['required', 'string'],
        ], $this->customValidationMessages());
    }

    protected function customValidationMessages()
    {
        return [
            'email.ends_with' => 'Please use only corporate email addresses ending with @psu.palawan.edu.ph.',
        ];
    }
    public function index(){
        return view('auth.login');
    }
    
    
    public function adminIndex(){
        return view('auth.admin-login');
    }
    public function logout(Request $request)
    {
        /**
          * @var \App\User $user
        */

        $user = Auth::user();
        if ($user) {
            $user->update(['status' => 'inactive']);
        }
        Auth::logout();
        return redirect('/login');
    }

    protected function authenticated(Request $request, $user)
    {
        $user->update(['status' => 'active', 'last_login' => now()]);
        
        $recentLogin = new recentLogin();
        $recentLogin->idUser = $user->id;
        $recentLogin->login_time = now();
        $recentLogin->save();
        
        return redirect()->intended($this->redirectPath());
    }
    
}
