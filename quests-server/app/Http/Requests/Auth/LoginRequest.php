<?php

namespace App\Http\Requests;

use App\Http\Requests\Helper\RequestMessages;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Правила валидации
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => [ 'bail', 'required', 'email:rfc,dns', 'max:255' ],
            'password' => [ 'bail', 'required', 'string', 'max:255' ],
        ];
    }


    /**
     * Описание полей запроса
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'email' => 'email адрес',
            'password' => 'пароль',
        ];
    }


    /**
     * Описание сообщений об ошибках при валидации
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'email.email:rfc,dns' => RequestMessages::EMAIL,
            'email.required' => RequestMessages::REQUIRED,
            'email.max:255' => RequestMessages::MAX_255,

            'password.string' => RequestMessages::STRING,
            'password.required' => RequestMessages::REQUIRED,
            'password.max:255' => RequestMessages::MAX_255,
        ];
    }
}
