<div class="flex flex-auto items-center gap-x-2">
    {{-- Search Form --}}
    <form
        action="{{ route('search') }}"
        method="GET"
        class="relative flex-auto"
        x-data="{
            searchOpen: false,
            query: '{{ request()->get('q', '') }}',
            toggleSearch() { this.searchOpen = !this.searchOpen }
        }"
    >
        <x-search-header-form
            placeholder="Search for bottles, brands, and people"
            :value="request()->get('q')"
            @focus="toggleSearch"
        >
            <template x-if="searchOpen">
                <x-modal
                    x-show="searchOpen"
                    @close="searchOpen = false"
                >

                </x-modal>
            </template>
        </x-search-header-form>
    </form>

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
