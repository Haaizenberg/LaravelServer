<?php

namespace App\Http\Requests\Helper;

class RequestMessages
{
    public const REQUIRED = 'Поле ":attribute" обязательно для заполнения';
    public const STRING = 'Поле ":attribute" должно содержать текст';
    public const MAX_255 = 'Поле ":attribute" слишком длинное';
    public const NUMERIC = 'Поле ":attribute" должно быть числового типа';
    public const INTEGER = 'Поле ":attribute" должно быть числового типа';
    public const BOOLEAN = 'Поле ":attribute" должно быть булева типа';
    public const DATE_FORMAT_DEFAULT = 'Поле ":attribute" должно быть в формате yyyy-mm-dd';
    public const UNIQUE = 'Поле ":attribute" должно быть уникальным';
    public const EXISTS = 'Поле ":attribute" должно существовать в БД';
    public const EMAIL = 'Поле ":attribute" должно быть email-адресом';
}