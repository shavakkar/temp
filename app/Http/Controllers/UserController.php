<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Session;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    //     $this->middleware('guest:customer')->except('logout');
    //     $this->middleware('guest:driver')->except('logout');
    // }

    public function register()
    {
        return view('register');
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);

        if ($request->userType === 'customer') {
            $user = Customer::create($data);
            if (!$user) {
                return redirect(route('register'))->with('error', 'User not registered');
            }
            return redirect(route('login'))->with('success', 'User Registered');
        } else {
            $driver = Driver::create($data);
            if (!$driver) {
                return redirect(route('register'))->with('error', 'User not registered');
            }
            return redirect(route('login'))->with('success', 'User Registered');
        }
    }

    public function login()
    {
        return view('login');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($request->userType === 'customer') {
            if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
                return redirect(route('user'))->with('success', 'User Logged in');
            }
            return redirect(route('login'))->with('error', 'User Errors');
        } else {
            if (Auth::guard('driver')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
                return redirect(route('user'))->with('success', 'User Logged in');
            }
            return redirect(route('login'))->with('error', 'User Errors');
        }

        // $data['email'] = $request->email;
        // $data['password'] = Hash::make($request->password);

        // dump(Auth::guard('customer')->attempt($data));

        // if (Auth::attempt($data)) {
        //     return redirect(route('user'))->with('success', 'User Logged in');
        // }
        // return redirect(route('login'))->with('error', 'User Errors');
    }

    public function logout(Request $request)
    {
        Session::flush();
        if (Auth::guard('customer')->check()) {
            Auth::guard('customer')->logout();
        } else {
            Auth::guard('driver')->logout();
        }
        return redirect(route('register'));
    }
}
