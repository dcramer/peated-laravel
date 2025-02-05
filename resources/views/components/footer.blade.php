@props([
    'mobileOnly' => false
])

<footer @class([
    'h-24 flex-shrink-0 overflow-hidden text-white',
    'block lg:hidden' => $mobileOnly,
])>
    <div class="fixed bottom-0 left-0 right-0 z-10 border-t border-t-slate-700 bg-slate-950 pb-2 sm:pb-0">
        <div class="mx-auto flex min-h-14 w-full max-w-4xl items-center justify-center gap-x-6 px-3 pb-4 sm:min-h-20 sm:px-3 lg:px-0">
            {{ $slot ?? null }}
        </div>
    </div>
</footer>
