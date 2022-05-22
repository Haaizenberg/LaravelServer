<?php

namespace App\Http\Requests\Quests\Quest;

use App\Http\Requests\Helpers\RequestMessages;
use Illuminate\Foundation\Http\FormRequest;

class QuestCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => [ 'bail', 'required', 'string', 'max:255' ],
            'user_id' => [ 'bail', 'required', 'integer', 'max:255', 'exists:App\Models\User,id' ],
            'quest_type_id' => [ 'bail', 'required', 'integer', 'max:255', 'exists:App\Models\QuestType,id' ],
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
            'title' => 'Название квеста',
            'user_id' => 'id создателя',
            'quest_type_id' => 'id типа квеста',
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
            'title.string' => RequestMessages::STRING,
            'title.required' => RequestMessages::REQUIRED,
            'title.max:255' => RequestMessages::MAX_255,

            'user_id.string' => RequestMessages::STRING,
            'user_id.required' => RequestMessages::REQUIRED,
            'user_id.max:255' => RequestMessages::MAX_255,
            'user_id.exists' => RequestMessages::EXISTS,

            'quest_type_id.string' => RequestMessages::STRING,
            'quest_type_id.required' => RequestMessages::REQUIRED,
            'quest_type_id.max:255' => RequestMessages::MAX_255,
            'quest_type_id.exists' => RequestMessages::EXISTS,
        ];
    }
}
