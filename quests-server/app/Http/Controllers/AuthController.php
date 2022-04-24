<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Аутентификация пользователя
     * 
     * @return string API токен
     */
    public function login(LoginRequest $request): string
    {
        $fields = $request->validated();
        $user = User::getUserForLogin($fields);

        if (is_null($user)) {
            return response('Пользователя с данным email не найдено');
        }
        if (! Hash::check($fields['password'], $user->password)) {
            return response('Неверный пароль');
        }

        return response()->json([ 'token' => $user->createToken($fields['device_name'])->plainTextToken ]);
    }


    /**
     * Регистрация пользователя
     * 
     * @return string API токен
     */
    public function register(RegisterRequest $request): string
    {
        $fields = $request->validated();
        $user = User::createUser($fields);

        if (is_null($user)) {
            return response('Ошибка при регистрации', 500);
        }

        Auth::login($user, $fields['remember_token'] ?? false);

        return response()->json([ 'token' => $user->createToken($fields['device_name'])->plainTextToken ]);
    }
}
