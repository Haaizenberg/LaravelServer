<?php

namespace App\Http\Requests\Quests\Quest;

use Illuminate\Foundation\Http\FormRequest;

class QuestUpdateRequest extends QuestCreateRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => parent::rules()['title'],
        ];
    }
}
