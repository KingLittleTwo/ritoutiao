<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private $table = 'users';
    public function signIn(Request $request)
    {
        if (empty($request['email']))
            Message::jsonMsg(500, 'please input your email');
        if (empty($request['password']))
            Message::jsonMsg(500, 'please input your password');

        $user_info = DB::table($this->table)
            ->where('email', $request['email'])
            ->first();
        if (encrypt($request['password'] == $user_info->password))
        {
            session('user_info', [
                'id' => $user_info->id,
                'name' => $user_info->name,
                'avatar_b_url' => $user_info->avatar_b_url,
                'avatar_m_url' => $user_info->avatar_m_url,
                'avatar_s_url' => $user_info->avatar_s_url,
            ]);
            Message::jsonMsg(200, true);
        }
        Message::jsonMsg(500, 'Username or password is incorrect');
    }

    public function signUp(Request $request)
    {
        if (empty($request['email']))
            Message::jsonMsg(500, 'please input your email');
        if (empty($request['password']))
            Message::jsonMsg(500, 'please input your password');
        if (empty($request['name']))
            Message::jsonMsg(500, 'please input your email');
        $id = DB::table($this->table)
            ->insertGetId($request);
        if (empty($id))
            Message::jsonMsg(500, 'failed');
        Message::jsonMsg(200, true);
    }

    public function signOut(Request $request)
    {
        $request->session()->flush();
        Message::jsonMsg(200, true);
    }
}
