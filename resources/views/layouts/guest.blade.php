<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen lg:grid lg:grid-cols-2">
            <div class="relative hidden overflow-hidden bg-gradient-to-br from-indigo-600 via-indigo-700 to-violet-800 p-12 text-white lg:flex lg:flex-col lg:justify-between">
                <div class="pointer-events-none absolute -right-24 -top-24 h-80 w-80 rounded-full bg-white/10 blur-3xl"></div>
                <div class="pointer-events-none absolute -bottom-32 -left-20 h-96 w-96 rounded-full bg-violet-400/20 blur-3xl"></div>

                <a href="{{ route('login') }}" class="relative flex items-center gap-3">
                    <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-white/15 ring-1 ring-white/20 backdrop-blur">
                        <img src="{{ asset('images/svg/logo.svg') }}" alt="" class="h-6 w-6 brightness-0 invert">
                    </span>
                    <span class="text-lg font-semibold tracking-tight">Mini Issue Tracker</span>
                </a>

                <div class="relative max-w-md">
                    <h1 class="text-4xl font-bold leading-tight tracking-tight">
                        Track issues.<br>Ship faster.
                    </h1>
                    <p class="mt-4 text-indigo-100/90">
                        Plan projects, triage issues, and keep your team in sync — all in one clean, focused workspace.
                    </p>

                    <ul class="mt-8 space-y-4">
                        @foreach ([
                            'Organize work into projects and issues',
                            'Tag, prioritize, and assign with ease',
                            'Comment and collaborate in real time',
                        ] as $feature)
                            <li class="flex items-center gap-3 text-sm text-indigo-50">
                                <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-white/15 ring-1 ring-white/20">
                                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path d="M5 12.5L10 17.5L19 7.5" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                                {{ $feature }}
                            </li>
                        @endforeach
                    </ul>
                </div>

                <p class="relative text-xs text-indigo-200/70">© {{ date('Y') }} Mini Issue Tracker</p>
            </div>

            <div class="flex min-h-screen items-center justify-center bg-gray-50 px-6 py-12">
                <div class="w-full max-w-md">
                    <a href="{{ route('login') }}" class="mb-8 flex items-center justify-center gap-3 lg:hidden">
                        <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-600">
                            <img src="{{ asset('images/svg/logo.svg') }}" alt="" class="h-6 w-6 brightness-0 invert">
                        </span>
                        <span class="text-lg font-semibold tracking-tight text-gray-900">Mini Issue Tracker</span>
                    </a>

                    <div class="rounded-2xl bg-white p-8 shadow-xl shadow-gray-200/60 ring-1 ring-gray-100 sm:p-10">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
