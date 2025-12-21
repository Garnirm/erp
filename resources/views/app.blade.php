<!DOCTYPE html>
<html lang="{{ App::getLocale() }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="robots" content="noindex, nofollow">

        <title inertia>ERP</title>

        @vite(['resources/scss/app.scss', 'resources/js/app.js'])

        @inertiaHead
    </head>

    @inertia
</html>