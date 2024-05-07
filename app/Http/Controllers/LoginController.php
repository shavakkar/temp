<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:writer')->except('logout');
    }

    public function showCustomerLoginForm()
    {
        return view('login');
    }

    public function customerLogin(Request $request)
    {
        $request->validate([
            'email'   => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect(route('user.customer'));
        }
        return back()->withInput($request->only('email', 'remember'));
    }


    public function showDriverLoginForm()
    {
        return view('login');
    }

    public function driverLogin(Request $request)
    {
        $request->validate([
            'email'   => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('driver')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect(route('user.driver'));
        }
        return back()->withInput($request->only('email', 'remember'));
    }
}
