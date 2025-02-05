@props(['bottle'])

<div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
    {{-- Average Rating --}}
    <div class="overflow-hidden rounded-lg bg-slate-800 px-4 py-5 shadow sm:p-6">
        <dt class="truncate text-sm font-medium text-gray-400">Average Rating</dt>
        <dd class="mt-1 text-3xl font-semibold tracking-tight text-white">
            {{ number_format($bottle->tastings_avg_rating ?: 0, 1) }}
        </dd>
    </div>

    {{-- Total Tastings --}}
    <div class="overflow-hidden rounded-lg bg-slate-800 px-4 py-5 shadow sm:p-6">
        <dt class="truncate text-sm font-medium text-gray-400">Total Tastings</dt>
        <dd class="mt-1 text-3xl font-semibold tracking-tight text-white">
            {{ $bottle->tastings_count }}
        </dd>
    </div>

    {{-- Average Price --}}
    <div class="overflow-hidden rounded-lg bg-slate-800 px-4 py-5 shadow sm:p-6">
        <dt class="truncate text-sm font-medium text-gray-400">Average Price</dt>
        <dd class="mt-1 text-3xl font-semibold tracking-tight text-white">
            ${{ number_format($bottle->tastings_avg_price ?: 0, 2) }}
        </dd>
    </div>

    {{-- Total Favorites --}}
    <div class="overflow-hidden rounded-lg bg-slate-800 px-4 py-5 shadow sm:p-6">
        <dt class="truncate text-sm font-medium text-gray-400">Total Favorites</dt>
        <dd class="mt-1 text-3xl font-semibold tracking-tight text-white">
            {{ $bottle->favorites_count }}
        </dd>
    </div>
</div>
