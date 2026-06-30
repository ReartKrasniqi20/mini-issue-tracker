<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition-colors hover:bg-indigo-500 focus:outline-none active:bg-indigo-700 disabled:opacity-50']) }}>
    {{ $slot }}
</button>
