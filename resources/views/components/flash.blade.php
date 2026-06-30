@php
    $message = session('status') ?? session('error');
    $isError = session('error') !== null;
    $undo = session('undo');
@endphp

@if ($message)
    <div x-data="{ show: true }"
         x-show="show"
         x-init="setTimeout(() => show = false, 5000)"
         x-transition.opacity.duration.500ms
         class="flex items-start justify-between gap-3 rounded-md border px-4 py-3 text-sm {{ $isError ? 'border-red-200 bg-red-50 text-red-800' : 'border-green-200 bg-green-50 text-green-800' }}">
        <span>{{ $message }}</span>

        <div class="flex shrink-0 items-center gap-3">
            @if ($undo)
                <form method="POST" action="{{ $undo }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="font-semibold underline hover:no-underline">Undo</button>
                </form>
            @endif

            <button type="button" x-on:click="show = false" aria-label="Dismiss"
                    class="-mr-1 rounded p-0.5 hover:bg-black/5 focus:outline-none">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M7 17L16.8995 7.10051" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M7 7.00001L16.8995 16.8995" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </button>
        </div>
    </div>
@endif
