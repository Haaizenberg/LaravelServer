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


    public static function getById(string $userId): User|null
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

    public static function getByToken(string $token): User|null
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
