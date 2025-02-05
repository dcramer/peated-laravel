<div>
    {{-- Desktop Logo --}}
    <div class="logo relative hidden sm:block">
        <a href="{{ route('home') }}" class="items-center sm:flex">
            <svg class="h-8 w-auto" viewBox="0 0 1024 256" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                {{-- Insert Peated Logo SVG path data here --}}
                <path d="M..." />
            </svg>
            <div class="ml-2 mt-2 inline-block w-auto rounded bg-slate-700 px-2 py-1 text-xs font-medium lowercase text-white opacity-90">
                Beta
            </div>
        </a>
    </div>

    {{-- Mobile Logo (Glyph) --}}
    <div class="logo flex sm:hidden">
        <a href="{{ route('home') }}">
            <svg class="h-8 w-auto" viewBox="0 0 256 256" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                {{-- Insert Peated Glyph SVG path data here --}}
                <path d="M..." />
            </svg>
        </a>
    </div>
</div>
