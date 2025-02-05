<div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-64 lg:flex-col">
    <div class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-slate-800 bg-slate-950 px-6 pb-4">
        <div class="text-highlight flex h-16 shrink-0 items-center hover:text-white">
            <x-header-logo />
        </div>
        <nav class="flex flex-1 flex-col">
            <ul role="list" class="flex flex-1 flex-col gap-y-7">
                <li>
                    <x-button href="{{ route('search', ['tasting' => '']) }}" full-width color="highlight">
                        Record Tasting
                    </x-button>
                </li>
                <li>
                    <ul role="list" class="-mx-2 space-y-1">
                        <x-sidebar-link
                            href="{{ route('home') }}"
                            :active="request()->routeIs('home') || request()->routeIs('activity.*')"
                            icon="home"
                        >
                            Activity
                        </x-sidebar-link>
                        <x-sidebar-link
                            href="{{ route('favorites') }}"
                            :active="request()->routeIs('favorites.*')"
                            icon="star"
                        >
                            Favorites
                        </x-sidebar-link>
                        <x-sidebar-link
                            href="{{ route('friends') }}"
                            :active="request()->routeIs('friends.*')"
                            icon="users"
                        >
                            Friends
                        </x-sidebar-link>
                    </ul>
                </li>
                <li>
                    <ul role="list" class="-mx-2 space-y-1">
                        <x-sidebar-link
                            href="{{ route('flights') }}"
                            :active="request()->routeIs('flights.*')"
                            icon="gift"
                        >
                            Flights
                        </x-sidebar-link>
                    </ul>
                </li>
                <li>
                    <ul role="list" class="-mx-2 space-y-1">
                        <x-sidebar-link
                            href="{{ route('bottles.index') }}"
                            :active="request()->routeIs('bottles.*')"
                            icon="bottle"
                        >
                            Bottles
                        </x-sidebar-link>
                        <x-sidebar-link
                            href="{{ route('locations') }}"
                            :active="request()->routeIs('locations.*')"
                            icon="map"
                        >
                            Locations
                        </x-sidebar-link>
                    </ul>
                </li>
                <li>
                    <ul role="list" class="-mx-2 space-y-1">
                        <x-sidebar-link
                            href="{{ route('distillers') }}"
                            :active="request()->routeIs('distillers.*')"
                            icon="distiller"
                        >
                            Distillers
                        </x-sidebar-link>
                        <x-sidebar-link
                            href="{{ route('brands') }}"
                            :active="request()->routeIs('brands.*')"
                            icon="brand"
                        >
                            Brands
                        </x-sidebar-link>
                        <x-sidebar-link
                            href="{{ route('bottlers') }}"
                            :active="request()->routeIs('bottlers.*')"
                            icon="bottler"
                        >
                            Bottlers
                        </x-sidebar-link>
                    </ul>
                </li>
                <li>
                    <ul role="list" class="-mx-2 space-y-1">
                        <x-sidebar-link
                            href="{{ config('app.github_repo') }}"
                            icon="code"
                        >
                            GitHub
                        </x-sidebar-link>
                        <x-sidebar-link
                            href="{{ config('app.discord_link') }}"
                            icon="chat"
                        >
                            Discord
                        </x-sidebar-link>
                        <x-sidebar-link
                            href="{{ route('about') }}"
                            :active="request()->routeIs('about.*')"
                            icon="info"
                        >
                            About
                        </x-sidebar-link>
                        <x-feedback-sidebar-link />
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
