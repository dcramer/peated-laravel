<x-app-layout>
    <x-slot name="title">Home</x-slot>
    <x-slot name="header">
        <x-app-header />
    </x-slot>

    <div class="space-y-8">
        {{-- Hero Section --}}
        <div class="relative overflow-hidden rounded-xl bg-slate-800 px-6 py-12 shadow-2xl sm:px-12 sm:py-24">
            <div class="relative">
                <div class="text-center">
                    <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl">Track Your Whisky Journey</h1>
                    <p class="mt-6 text-lg leading-8 text-gray-300">
                        Record tastings, discover new bottles, and connect with other whisky enthusiasts.
                    </p>
                    <div class="mt-10 flex items-center justify-center gap-x-6">
                        <a href="{{ route('search', ['tasting' => '']) }}" class="rounded-md bg-highlight px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-highlight-dark focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-highlight">
                            Record a Tasting
                        </a>
                        <a href="{{ route('bottles.index') }}" class="text-sm font-semibold leading-6 text-white">
                            Browse Bottles <span aria-hidden="true">→</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Stats Section --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
            <div class="overflow-hidden rounded-lg bg-slate-800 px-4 py-5 shadow sm:p-6">
                <dt class="truncate text-sm font-medium text-gray-400">Total Bottles</dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-white">{{ number_format($stats['total_bottles']) }}</dd>
            </div>
            <div class="overflow-hidden rounded-lg bg-slate-800 px-4 py-5 shadow sm:p-6">
                <dt class="truncate text-sm font-medium text-gray-400">Total Tastings</dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-white">{{ number_format($stats['total_tastings']) }}</dd>
            </div>
            <div class="overflow-hidden rounded-lg bg-slate-800 px-4 py-5 shadow sm:p-6">
                <dt class="truncate text-sm font-medium text-gray-400">Active Users</dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-white">{{ number_format($stats['total_users']) }}</dd>
            </div>
        </div>

        {{-- Recent Activity --}}
        <div class="overflow-hidden rounded-lg bg-slate-800 shadow">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-white">Recent Tastings</h2>
                <div class="mt-6 flow-root">
                    <ul role="list" class="-my-5 divide-y divide-slate-700">
                        @foreach($recentTastings as $tasting)
                            <li class="py-5">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <x-user-avatar :user="$tasting->createdBy" />
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="truncate text-sm font-medium text-white">
                                            {{ $tasting->createdBy->username }} tasted {{ $tasting->bottle->name }}
                                        </p>
                                        <p class="text-sm text-gray-400">
                                        </p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        {{-- Popular Bottles --}}
        <div class="overflow-hidden rounded-lg bg-slate-800 shadow">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-white">Popular Bottles</h2>
                <div class="mt-6">
                    <ul role="list" class="divide-y divide-slate-700">
                        @foreach($popularBottles as $bottle)
                            <li class="py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="min-w-0 flex-1">
                                        <p class="truncate text-sm font-medium text-white">
                                            <a href="{{ route('bottles.show', $bottle) }}" class="hover:text-highlight">
                                                {{ $bottle->name }}
                                            </a>
                                        </p>
                                        <p class="text-sm text-gray-400">
                                            {{ $bottle->tastings_count }} tastings
                                        </p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
