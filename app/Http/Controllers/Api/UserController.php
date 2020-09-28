<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function register(Request $request)
    {
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->api_token = Str::random(25);
            $user->level = $request->level;
            $user->save();
            return $this->onSuccess(true, 'Register berhasil', $user);
        } catch (\Exception $e) {
            return $this->onFailure($e);
        }
    }

    public function login(Request $request)
    {
        try {
            if(Auth::attempt($request->only(['email', 'password']))) {
                return $this->onSuccess(true, 'Login berhasil', Auth::user());
            } else {
                return $this->onSuccess(false, 'Login Gagal', null);
            }
        } catch (\Exception $e) {
            return $this->onFailure($e);
        }
    }

    public function user()
    {
        try {
            if(Auth::check()) {
                return $this->onSuccess(true, 'User ditemukan', Auth::user());
            } else {
                return $this->onSuccess(false, 'User tidak ditemukan', null);
            }
        } catch (\Exception $e) {
            return $this->onFailure($e);
        }
    }

    public function logout()
    {
        try {
            if(Auth::check()) {
                Auth::logout();
                return $this->onSuccess(true, "Logout berhasil", null);
            } else {
                return $this->onSuccess(false, "Anda sudah logout", null);
            }
        } catch (\Exception $e) {
            return $this->onFailure($e);
        }
    }

    private function onSuccess($status, $msg, $data) {
        return response()->json([
           'success' => $status,
           'msg' => $msg,
           'data' => $data,
        ]);
    }

    private function onFailure(\Exception $e) {
        if($e instanceof ClientException) {
            $newException = json_decode($e->getResponse()->getBody()->getContents(), true);
            if($newException) {
                $e = new \Exception($newException['reason'], $newException['code']);
            }
        }

        $arr = [
            'message' => $e->getMessage(),
            'code' => $e->getCode()
        ];
        return response()->json($arr);
    }
}
