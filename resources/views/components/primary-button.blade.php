<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-brand-green border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-brand-deep-green focus:bg-brand-deep-green active:bg-brand-deep-green focus:outline-none focus:ring-2 focus:ring-brand-green/30 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
