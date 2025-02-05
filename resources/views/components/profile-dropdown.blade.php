<div
    x-data="{ open: false }"
    class="menu hidden sm:block"
    @click.away="open = false"
    @keydown.escape.window="open = false"
>
    <button
        @click="open = !open"
        :class="{
            'relative flex max-w-xs items-center p-2 text-sm hover:bg-slate-800 hover:text-white focus:outline-none': true,
            'rounded-b-none rounded-t bg-slate-800 text-white': open,
            'text-muted rounded': !open
        }"
        type="button"
    >
        <span class="sr-only">Open user menu</span>
        <div class="h-8 w-8">
            <x-user-avatar :user="auth()->user()" />
        </div>
    </button>

    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute right-0 z-40 mt-0 w-48 origin-top-right divide-y divide-slate-700"
        style="display: none;"
    >
        <div>
            <a
                href="{{ route('users.show', ['username' => auth()->user()->username]) }}"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
            >
                Profile
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    type="submit"
                    class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100"
                >
                    Log out
                </button>
            </form>
        </div>

        @if(auth()->user()->admin)
            <div>
                <a
                    href="{{ route('admin') }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                >
                    Admin
                </a>
            </div>
        @endif
    </div>
</div>
