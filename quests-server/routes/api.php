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
        Route::get('/{user}', [UserController::class, 'getUser']);
        Route::get('/{user}/logout', [AuthController::class, 'logout']);
    });

    // Действия с квестами
    Route::prefix('quest')->group(function () {
        Route::post('/create', [QuestController::class, 'createQuest']);
        Route::get('/{post}', [QuestController::class, 'getQuest']);
        Route::put('/{post}/update', [QuestController::class, 'updateQuestInfo']);
        Route::delete('/{post}/delete', [QuestController::class, 'deleteQuest']);
        
        // Вопросы квеста
        Route::prefix('question')->group(function () {
            Route::post('/create', [QuestController::class, 'createQuestion']);
            Route::get('/{question}', [QuestController::class, 'getQuestion']);
            Route::put('/{question}/update', [QuestController::class, 'updateQuestionInfo']);
            Route::delete('/{question}/delete', [QuestController::class, 'deleteQuestion']);
        });

        // Ответы на вопросы
        Route::prefix('answer')->group(function () {
            Route::post('/create', [QuestController::class, 'createAnswer']);
            Route::get('/{answer}', [QuestController::class, 'getAnswer']);
            Route::put('/{answer}/update', [QuestController::class, 'updateAnswerInfo']);
            Route::delete('/{answer}/delete', [QuestController::class, 'deleteAnswer']);

            Route::post('/check', [QuestController::class, 'checkAnswers']);
        });

        // Обработка попытки прохождения квеста
        Route::post('/attempt/check', [QuestController::class, 'checkAttempt']);

        // Геопозиции квеста
        Route::prefix('geoposition')->group(function () {
            Route::post('/create', [QuestController::class, 'createGeoposition']);
            Route::get('/{geoposition}', [QuestController::class, 'getGeoposition']);
            Route::put('/{question}/update', [QuestController::class, 'updateGeopositionInfo']);
            Route::delete('/{geoposition}/delete', [QuestController::class, 'deleteGeoposition']);

            Route::post('/{geoposition}/visited', [QuestController::class, 'visitGeoposition']);
        });
    });
});
