<?php

namespace App\Http\Controllers\Auth;

use Hash;
use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function username()
    {
        return 'name';
    }

    public function validateLogin(Request $request)
    {
        $message = [
            'name.required' => '登录名称不能为空',
            'password.required' => '密码不能为空',
        ];
        $this->validate($request, [
            $this->username() => 'required',
            'password' => 'required',
        ], $message);
    }

    public function login (Request $request, User $user)
    {
        $this->validateLogin($request);

        $userInfo = $user->where('name', $request->name)->first();

        if ($userInfo) {
            if (Hash::check($request->password, $userInfo->password)) {
                $this->guard()->login($userInfo);

                return redirect('/')->with('messages', '登录成功');
            }
        }

        return back()->with('messages', '账号或者密码错误')->withInput();
    }


}
