<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    </head>
    <body>
        <form action="{{ route('registration') }}" method="post">
            <input type="text" name="name" id="name" value="Dima">
            <input type="email" name="email" id="email" value="dimas@mail.ru">
            <input type="password" name="password" id="password" value="password">
            <input type="text" name="device_name" id="device_name" value="MiAir">

            <button type="submit">Submit</button>
        </form>
    </body>
</html>
