<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Аутентификация и регистрация пользователей
Route::post('/auth/register', [AuthController::class, 'register'])->name('registration');
Route::post('/auth/login', [AuthController::class, 'login'])->name('login');

// Аутентифицированные запросы (проверяют api-токен запроса)
Route::middleware('auth:sanctum')->group(function () {
    // Действия с пользователем
    Route::prefix('user')->group(function () {
        Route::get('/{user_id}', [UserController::class, 'getUser']);
        Route::get('/{user_id}/logout', [AuthController::class, 'logout']);
    });

    // Действия с квестами
    Route::get('/quests', [QuestController::class, 'getQuests']);
    Route::prefix('quest')->group(function () {
        Route::post('/create', [QuestController::class, 'createQuest']);
        Route::get('/{quest_id}', [QuestController::class, 'getQuest']);
        Route::put('/{quest_id}', [QuestController::class, 'updateQuestInfo']);
        Route::delete('/{quest_id}', [QuestController::class, 'deleteQuest']);
        
        // Вопросы квеста
        Route::prefix('question')->group(function () {
            Route::post('/create', [QuestController::class, 'createQuestion']);
            Route::get('/{question_id}', [QuestController::class, 'getQuestion']);
            Route::put('/{question_id}/update', [QuestController::class, 'updateQuestionInfo']);
            Route::delete('/{question_id}/delete', [QuestController::class, 'deleteQuestion']);
        });

        // Ответы на вопросы
        Route::prefix('answer')->group(function () {
            Route::post('/create', [QuestController::class, 'createAnswer']);
            Route::get('/{answer_id}', [QuestController::class, 'getAnswer']);
            Route::put('/{answer_id}/update', [QuestController::class, 'updateAnswerInfo']);
            Route::delete('/{answer_id}/delete', [QuestController::class, 'deleteAnswer']);

            Route::post('/check', [QuestController::class, 'checkAnswers']);
        });

        // Обработка попытки прохождения квеста
        Route::post('/attempt/check', [QuestController::class, 'checkAttempt']);

        // Геопозиции квеста
        Route::prefix('geoposition')->group(function () {
            Route::post('/create', [QuestController::class, 'createGeoposition']);
            Route::get('/{geoposition_id}', [QuestController::class, 'getGeoposition']);
            Route::put('/{geoposition_id}/update', [QuestController::class, 'updateGeopositionInfo']);
            Route::delete('/{geoposition_id}/delete', [QuestController::class, 'deleteGeoposition']);

            Route::post('/{geoposition_id}/visited', [QuestController::class, 'visitGeoposition']);
        });
    });
});
