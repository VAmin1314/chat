<?php

namespace App\Http\Controllers\Api;

use Session;
use App\Model\User;
use JWTAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getInfo ()
    {
        JWTAuth::parseToken();
        $user = JWTAuth::parseToken()->authenticate();

        $info = [
            'id' => $user->id,
        ];
        return $info;
    }
}
