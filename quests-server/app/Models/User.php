<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * Создаёт нвого пользователя
     * 
     * @param array $fields аттрибуты пользователя
     * 
     * @return App\Models\User|null
     */
    public static function createUser(array $fields): ?User
    {
        try {
            $user = self::create([
                'name' => $fields['device_name'],
                'email' => $fields['email'],
                'password' => Hash::make($fields['password']),
            ]);
    
            $user->save();
        } catch (\Exception $e) {
            Log::error('Ошибка при создании пользователя', [
                'message' => $e->getMessage(),
                'fields' => $fields,
            ]);
            $user = null;
        }
        
        return $user;
    }


    /**
     * Возвращает пользователя с заданным email из БД 
     * если он существует
     * 
     * @param array $fields аттрибуты пользователя
     * 
     * @return App\Models\User|null
     */
    public static function getUserForLogin(array $fields): ?User
    {
        try {
            $user = self::where('email', $fields['email'])->first();
        } catch (\Exception $e) {
            Log::error('Ошибка при получении пользователя', [
                'message' => $e->getMessage(),
                'fields' => $fields,
            ]);
            $user = null;
        }
        
        return $user;
    }


    /**
     * Возвращает пользователя по заданному id из БД
     * если таковой существует
     * 
     * @param string $userId id пользователя
     * 
     * @return App\Models\User|null
     */
    public static function getById(string $userId): ?User
    {
        try {
            $user = self::firstWhere('id', $userId);
        } catch (\Exception $e) {
            Log::error("Ошибка при получении пользователя с id -> $userId", [
                'message' => $e->getMessage()
            ]);
            $user = null;
        }

        return $user;
    }

    
    /**
     * Возвращает пользователя по заданному токену API из БД
     * если таковой существует
     * 
     * @param string $token id пользователя
     * 
     * @return App\Models\User|null
     */
    public static function getByToken(string $token): ?User
    {
        try {
            $user = self::firstWhere('id', $token);
        } catch (\Exception $e) {
            Log::error("Ошибка при получении пользователя с id -> $token", [
                'message' => $e->getMessage()
            ]);
            $user = null;
        }

        return $user;
    }


    /**
     * Удаляет токен доступа API для пользователя
     * 
     * @return bool
     */
    public function deleteApiToken(): bool
    {
        try {
            $this->tokens()->delete();
            $success = true;
        } catch (\Exception $e) {
            Log::error("Ошибка при удалении токена API для пользователя с id -> $this->id", [
                'message' => $e->getMessage()
            ]);
            $success = false;
        }

        return $success;
    }
}
