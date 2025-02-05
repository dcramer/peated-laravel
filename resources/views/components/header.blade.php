@props([
    'mobileOnly' => false,
    'color' => 'default'
])

<div>
    <header @class([
        'h-14 flex-shrink-0 overflow-hidden lg:h-16',
        'block lg:hidden' => $mobileOnly,
    ])>
        <div @class([
            'fixed left-0 right-0 z-30',
            'main-gradient backdrop-blur' => $color === 'primary',
            'border-b border-b-slate-700 bg-slate-950' => $color === 'default',
        ])>
            <div class="flex h-14 w-full max-w-7xl lg:h-16 lg:pl-64">
                <div class="flex flex-1 items-center justify-between px-3 lg:px-8">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </header>
</div>
