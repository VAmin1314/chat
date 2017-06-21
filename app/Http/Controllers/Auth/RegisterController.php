<?php

namespace App\Http\Controllers\Auth;

use App\Model\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $message = [
            'name.required' => '用户名不能为空',
            'name.max' => '用户名不能超过20个字母',
            'name.unique' => '用户名已经存在',
            'password.required' => '密码不能为空',
            'password.min' => '密码最少6位数',
            'password.confirmed' => '两次密码不一致',
        ];
        return Validator::make($data, [
            'name' => 'bail|required|max:20|unique:users',
            'password' => 'bail|required|min:6|confirmed',
        ], $message);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $this->validator($data);

        return User::create([
            'name' => $data['name'],
            'email' => '',
            'password' => $data['password']
        ]);
    }
}
