<?php

namespace App\Http\Controllers;

use App\Events\User\UserEvent;
use App\Http\Requests\UserRegisterRequest;
use App\Mail\MailActiveUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
    public function register(UserRegisterRequest $request)
    {
        try {
            $user =  User::query()->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => 1,
                'status' => 1,
                'slug' => $this->convertName($request->name)
            ]);
            $user->save();
            event(new UserEvent($request->email));
            $this->setFlash(__('Kiểm tra Email để kích hoạt tài khoản'));
            return back();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }
    public function activeUser(Request $request)
    {
        $user = User::query()->where('email', $request->email)->first();
        $user->status = 2;
        $user->save();
        $this->setFlash(__('Tài khoản đã được xác thực'));
        return back();
    }
}
