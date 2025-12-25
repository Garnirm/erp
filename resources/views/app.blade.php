<!DOCTYPE html>
<html lang="{{ App::getLocale() }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="robots" content="noindex, nofollow">

        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <title inertia>ERP</title>

        @vite(['resources/scss/app.scss', 'resources/js/app.js'])

        @inertiaHead
    </head>

    @inertia
</html>