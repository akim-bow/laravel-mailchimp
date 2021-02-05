<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function index(Request $request) {
        $credentials = $request->only(['email', 'password']);
        $result = Auth::attempt($credentials);

        if ($result) {
            $token = Str::random(60);
            $request->user()->forceFill([
                'api_token' => $token,
            ])->save();

            return [
                'status' => 'ok',
                'token' => $token,
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Неверные данные'
            ];
        }
    }

    public function check(Request $request) {
        $token = $request->user()['api_token'];
        if ($token && $token == $request->bearerToken()) {
            return [
                'status' => 'ok'
            ];
        } else {
            return [
                'status' => 'error',
                'token' => $token,
                'bearer' => $request->bearerToken(),
            ];
        }
    }
}
