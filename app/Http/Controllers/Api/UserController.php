<?php

namespace App\Http\Controllers\Api;

use App\Http\Common\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;

class UserController extends Controller
{
    private $table = 'users';

    public function signIn(Request $request)
    {
        try {
            if (empty($request['email']))
                Message::jsonMsg(500, 'please input your email');
            if (empty($request['password']))
                Message::jsonMsg(500, 'please input your password');

            $user_info = DB::table($this->table)
                ->where('email', $request['email'])
                ->first();
            if (empty($user_info))
                Message::jsonMsg(500, 'user is not exists');

            if (Hash::check($request['password'], $user_info->password)) {
                session(['user_info' => [
                    'id' => $user_info->id,
                    'name' => $user_info->name,
                    'avatar_b_url' => $user_info->avatar_b_url,
                    'avatar_m_url' => $user_info->avatar_m_url,
                    'avatar_s_url' => $user_info->avatar_s_url,
                ]]);
                Message::jsonMsg(200, 'login success');
            }
            Message::jsonMsg(500, 'password is incorrect');
        } catch (Exception $e) {
            Message::jsonMsg(500, 'failed');
        }
    }

    public function signUp(Request $request)
    {
        try {
            if (empty($request['email']))
                Message::jsonMsg(500, 'please input your email');
            if (empty($request['password']))
                Message::jsonMsg(500, 'please input your password');
            if (empty($request['name']))
                Message::jsonMsg(500, 'please input your name');
            $data = [
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'name' => $request->name,
            ];
            $user = DB::table($this->table)
                ->where('email', $request->email)
                ->orWhere('name', $request->name)
                ->get();
            if (!$user->isEmpty())
                Message::jsonMsg(500, 'email or name is already used');
            $id = DB::table($this->table)
                ->insertGetId($data);
            if (empty($id))
                Message::jsonMsg(500, 'failed');
            Message::jsonMsg(200, 'signup success');
        } catch (Exception $e) {
            Message::jsonMsg(500, 'failed');
        }
    }

    public function signOut(Request $request)
    {
        try {
            $request->session()->flush();
            Message::jsonMsg(200, true);
        } catch (Exception $e) {
            Message::jsonMsg(500, 'failed');
        }
    }
}
