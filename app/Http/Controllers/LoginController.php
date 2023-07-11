<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login.login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::guard('user')->attempt($credentials, true)) {
            if (Auth::guard('user')->user()->status == 2) {
                if (Auth::guard('user')->user()->role_id == 2) {
                    return redirect()->route('employer.index');
                }
                return redirect()->route('home');
            } else {
                $this->setFlash(__('Tải khoản chưa được kích hoạt'), 'error');
                return redirect()->back();
            }
        }
        $this->setFlash(__('Tải khoản hoặc mật khẩu không đúng'), 'error');
        return redirect()->back();
    }
    public function logout()
    {
        Auth::guard('user')->logout();
        return redirect()->route('home');
    }
}
