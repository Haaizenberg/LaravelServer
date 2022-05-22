<?php

namespace App\Http\Controllers;

use App\Http\Requests\Quests\Quest\QuestCreateRequest;
use App\Models\Quest;

class QuestController extends Controller
{
    public function createQuest(QuestCreateRequest $request)
    {
        $createdQuest = Quest::createQuest($request->validated());

        return response()->json($createdQuest ?? null, options:JSON_FORCE_OBJECT);
    }


    public function getQuests()
    {
        return response()->json([ 'quests' => Quest::all() ]);
    }
}
