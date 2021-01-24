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
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:agent')->except('logout');
	}

    public function login(Request $request)
    {
        $input = $request->all();
        $this->validate($request,[
            'email'=> 'required|email',
            'password' => 'required'
            ]);   
         
            $credential = [
                'email' => $request->email,
                'password' => $request->password,
            ];
    
            if (Auth::attempt($credential)) {
                $auth = Auth::user();
                if ($auth->role == 'admin') {
                    Auth::guard('admin')->attempt($credential);
                    return redirect()->intended(route('home'));
                }else{
                    Auth::guard('agent')->attempt($credential);
                    return redirect()->intended(route('agent.home'));
                }
            }
    
            //return redirect()->back()->withInput($request->only('username', 'password'));
    
            return $this->sendFailedLoginResponse($request);
            
    }

}
