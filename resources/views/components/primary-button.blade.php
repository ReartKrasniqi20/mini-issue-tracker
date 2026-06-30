<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center rounded-lg border border-transparent bg-indigo-600 h-10 px-4 text-sm font-semibold text-white shadow-sm transition-colors hover:bg-indigo-500 focus:outline-none active:bg-indigo-700 disabled:opacity-50']) }}>
    {{ $slot }}
</button>
