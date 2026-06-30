@php
    $user = Auth::user();
    $initials = collect(explode(' ', trim($user->name)))
        ->filter()
        ->take(2)
        ->map(fn ($word) => mb_strtoupper(mb_substr($word, 0, 1)))
        ->implode('');
@endphp

<nav x-data="{ open: false }" class="sticky top-0 z-40 border-b border-gray-200 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
            <!-- Left: nav links -->
            <div class="flex items-center">
                <div class="hidden sm:flex sm:gap-6">
                    <x-nav-item :href="route('projects.index')" :active="request()->routeIs('projects.*')">
                        {{ __('Projects') }}
                    </x-nav-item>
                    <x-nav-item :href="route('tags.index')" :active="request()->routeIs('tags.*')">
                        {{ __('Tags') }}
                    </x-nav-item>
                </div>
            </div>

            <!-- Center: brand -->
            <a href="{{ route('projects.index') }}"
               class="absolute inset-y-0 left-1/2 flex -translate-x-1/2 items-center gap-2">
                <img src="{{ asset('images/svg/logo.svg') }}" alt="Issue Tracker" class="h-8 w-auto">
                <span class="text-base font-semibold text-gray-900">Issue Tracker</span>
            </a>

            <!-- Right: user menu (desktop) / hamburger (mobile) -->
            <div class="flex items-center">
                <div class="hidden sm:block">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center gap-2 rounded-full py-1 pl-1 pr-2 transition hover:bg-gray-100">
                                <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-indigo-100 text-sm font-semibold text-indigo-700">
                                    {{ $initials }}
                                </span>
                                <span class="hidden text-sm font-medium text-gray-700 md:block">{{ $user->name }}</span>
                                <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="border-b border-gray-100 px-4 py-3">
                                <p class="text-sm font-semibold text-gray-900">{{ $user->name }}</p>
                                <p class="truncate text-xs text-gray-500">{{ $user->email }}</p>
                            </div>
                            <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                <div class="sm:hidden">
                    <button @click="open = ! open"
                            class="inline-flex items-center justify-center rounded-md p-2 text-gray-500 transition hover:bg-gray-100 hover:text-gray-700 focus:outline-none">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden border-t border-gray-200 sm:hidden">
        <div class="space-y-1 px-3 py-3">
            <a href="{{ route('projects.index') }}"
               class="block rounded-lg px-3 py-2 text-base font-medium {{ request()->routeIs('projects.*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-100' }}">
                {{ __('Projects') }}
            </a>
            <a href="{{ route('tags.index') }}"
               class="block rounded-lg px-3 py-2 text-base font-medium {{ request()->routeIs('tags.*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-100' }}">
                {{ __('Tags') }}
            </a>
        </div>

        <div class="border-t border-gray-200 px-4 py-4">
            <div class="flex items-center gap-3">
                <span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-indigo-100 text-sm font-semibold text-indigo-700">
                    {{ $initials }}
                </span>
                <div>
                    <div class="text-sm font-semibold text-gray-900">{{ $user->name }}</div>
                    <div class="text-xs text-gray-500">{{ $user->email }}</div>
                </div>
            </div>
            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-900">
                    {{ __('Profile') }}
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                       class="block rounded-lg px-3 py-2 text-sm font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-900">
                        {{ __('Log Out') }}
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>
