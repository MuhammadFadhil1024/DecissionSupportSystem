<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }

    public function index()
    {
        return view('authentication.pages.login');
    }

    public function store(Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:255',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }

        try {

            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                return redirect()->route('dashboard.category.index')->with('success', 'Login success');
            }
            return redirect()->back()->with('error', 'email or password wrong');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error during the creation!');
        }
    }

    public function logout()
    {
        try {
            auth()->logout();

            return redirect()->route('login')->with('success', 'Logout success');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'Error during the creation!');
        }
    }
}
