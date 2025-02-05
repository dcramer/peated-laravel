<div>
    <x-header>
        <div class="relative flex-auto">
            <input
                wire:model.live.debounce.300ms="query"
                type="search"
                name="q"
                placeholder="Search for bottles, brands, and people"
                class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6"
                autofocus
            />
        </div>
    </x-header>

    <div>
        @if($loading)
            <ul role="list" class="divide-y divide-slate-800 border-slate-800 lg:border-b lg:border-r">
                @for($i = 0; $i < 5; $i++)
                    <x-search.skeleton-item />
                @endfor
            </ul>
        @else
            <x-search.results
                :query="$query"
                :results="$results"
                :can-suggest-add="!str_contains($query, '@') || !auth()->check()"
                :direct-to-tasting="$directToTasting"
            />
        @endif
    </div>
</div>
