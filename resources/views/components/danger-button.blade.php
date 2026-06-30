<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center rounded-lg bg-red-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition-colors hover:bg-red-500 focus:outline-none active:bg-red-700 disabled:opacity-50']) }}>
    {{ $slot }}
</button>
