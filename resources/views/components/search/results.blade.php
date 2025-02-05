@props(['query', 'results', 'canSuggestAdd' => false, 'directToTasting' => false])

<ul role="list" class="divide-y divide-slate-800 border-slate-800 lg:border-b lg:border-r">
    @if($query && $canSuggestAdd)
        <x.list-item color="highlight">
            <svg class="hidden h-12 w-12 flex-none rounded p-2 sm:block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
            </svg>

            <div class="min-w-0 flex-auto">
                <div class="font-semibold leading-6">
                    <a href="{{ route('bottles.create', ['name' => Str::title($query)]) }}">
                        <span class="absolute inset-x-0 -top-px bottom-0"></span>
                        {{ $results->isEmpty()
                            ? "We couldn't find anything matching your search query."
                            : "Can't find a bottle?"
                        }}
                    </a>
                </div>
                <div class="text-highlight-dark mt-1 flex gap-x-1 leading-5">
                    @if($query !== '')
                        <span>
                            Tap here to add <strong class="truncate">{{ Str::title($query) }}</strong> to the database.
                        </span>
                    @else
                        <span>Tap here to add a new bottle to the database.</span>
                    @endif
                </div>
            </div>
        </x.list-item>
    @endif

    @foreach($results as $result)
        <x.list-item>
            <x-search.result :result="$result" :direct-to-tasting="$directToTasting" />
        </x.list-item>
    @endforeach

    @if(!$canSuggestAdd && $results->isEmpty() && $query !== '')
        <x.list-item no-hover>
            <p class="text-muted p-5">
                We couldn't find anything matching your search query.
            </p>
        </x.list-item>
    @endif
</ul>
