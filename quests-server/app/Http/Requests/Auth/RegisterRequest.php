<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Helpers\RequestMessages;
class RegisterRequest extends LoginRequest
{
    /**
     * Правила валидации
     *
     * @return array
     */
    public function rules(): array
    {
        $loginRules = parent::rules();
        $loginRules['name'] = [ 'bail', 'required', 'string', 'max:255' ];

        return $loginRules;
    }


    /**
     * Описание полей запроса
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'имя пользователя',
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
            'name.string' => RequestMessages::STRING,
            'name.required' => RequestMessages::REQUIRED,
            'name.max:255' => RequestMessages::MAX_255,
        ];
    }
}
