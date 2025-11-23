<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Home') }}</title>

        @vite('resources/css/app.css')
    </head>
    <body>
        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <label for="email">Correo</label>
            <input id="email" type="email" name="email" required>

            <label for="password">Contraseña</label>
            <input id="password" type="password" name="password" required>

            <button type="submit">Ingresar</button>
        </form>
    </body>
</html>
