<div class="flex flex-auto items-center gap-x-2">
    {{-- Search Component --}}
    <div
        class="relative flex-auto"
        x-data="{
            searchOpen: false,
            toggleSearch() { this.searchOpen = !this.searchOpen }
        }"
    >
        <input
            type="search"
            placeholder="Search for bottles, brands, and people"
            class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6"
            @focus="toggleSearch"
            value="{{ request()->get('q', '') }}"
        />

        <div
            x-show="searchOpen"
            x-cloak
            class="fixed inset-0 z-50"
            @keydown.escape.window="searchOpen = false"
        >
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-start justify-center p-4 text-center sm:p-0">
                    <div
                        class="relative transform overflow-hidden rounded-lg bg-slate-950 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl"
                        @click.away="searchOpen = false"
                    >
                        <livewire:search-panel
                            :initial-value="request()->get('q', '')"
                            :direct-to-tasting="request()->has('tasting')"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- User Navigation --}}
    @auth
        <div class="flex items-center gap-x-2">
            <div class="hidden sm:block">
                <x-notifications-panel />
            </div>
            <div class="block sm:hidden">
                <a href="{{ route('users.show', ['username' => auth()->user()->username]) }}" class="block">
                    <div class="h-8 w-8">
                        <x-user-avatar :user="auth()->user()" />
                    </div>
                </a>
            </div>
            <x-profile-dropdown />
        </div>
    @else
        <div class="flex items-center gap-x-2">
            <a href="{{ route('login', ['redirect' => url()->current()]) }}" class="block">
                <div class="h-8 w-8">
                    <x-user-avatar />
                </div>
            </a>
        </div>
    @endauth
</div>
