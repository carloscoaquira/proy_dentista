<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Home') }}</title>

        @vite('resources/css/app.css')
    </head>
    <body">
        <h1 class="text-blue-600">
            Login Dashboard
        </h1>
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit"
                class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                Cerrar sesión
            </button>
        </form>
    </body>
</html>
