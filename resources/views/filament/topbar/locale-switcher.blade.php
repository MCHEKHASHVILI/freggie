@php
    $labels = [
        'en' => 'English',
        'ka' => 'ქართული',
    ];
@endphp

<div class="ms-4 flex items-center">
    <x-filament::dropdown placement="bottom-end">
        <x-slot name="trigger">
            <button type="button" class="fi-topbar-item-btn">
                <span class="fi-topbar-item-label">
                    {{ $labels[app()->getLocale()] ?? app()->getLocale() }}
                </span>
            </button>
        </x-slot>

        <x-filament::dropdown.list>
            @foreach (config('app.supported_locales') as $locale)
                <x-filament::dropdown.list.item
                    tag="a"
                    :href="route('admin.locale.update', ['locale' => $locale])"
                    :color="app()->getLocale() === $locale ? 'primary' : 'gray'"
                >
                    {{ $labels[$locale] ?? $locale }}
                </x-filament::dropdown.list.item>
            @endforeach
        </x-filament::dropdown.list>
    </x-filament::dropdown>
</div>
