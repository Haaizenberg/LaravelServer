<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Quest extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'quest_type_id',
        'user_id'
    ];

    /**
     * Создаёт квест в БД
     * 
     * @param array $questFields аттрибуты квеста
     * @return App\Models\Quest созданный квест
     */
    public static function createQuest(array $questFields): self
    {
        try {
            $quest = self::create([
                'title' => $questFields['title'],
                'quest_type_id' => $questFields['quest_type_id'],
                'user_id' => $questFields['user_id'],
            ]);
    
            $quest->save();
        } catch (\Exception $e) {
            Log::error('Ошибка при создании квеста', [
                'message' => $e->getMessage(),
                'fields' => $questFields,
            ]);
            $quest = null;
        }
        
        return $quest;
    }
}
