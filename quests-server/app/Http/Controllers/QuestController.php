<?php

namespace App\Http\Controllers;

use App\Http\Requests\Quests\Quest\QuestCreateRequest;
use App\Models\Quest;
use Illuminate\Http\JsonResponse;

class QuestController extends Controller
{
    /**
     * Создаёт квест в БД
     * 
     * @param App\Http\Requests\Quests\Quest\QuestCreateRequest $request
     * @return Illuminate\Http\JsonResponse
     */
    public function createQuest(QuestCreateRequest $request): JsonResponse
    {
        $createdQuest = Quest::createQuest($request->validated());

        return response()->json($createdQuest ?? null, options:JSON_FORCE_OBJECT);
    }

    /**
     * Возвращает все квесты из БД
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function getQuests(): JsonResponse
    {
        return response()->json([ 'quests' => Quest::all() ]);
    }
}
