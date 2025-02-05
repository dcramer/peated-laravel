@props(['initialValue' => ''])

<div
    x-data="{
        query: '{{ $initialValue }}',
        results: [],
        loading: false,
        async search() {
            this.loading = true;
            try {
                const response = await fetch(`/api/search?q=${encodeURIComponent(this.query)}`);
                this.results = await response.json();
            } catch (e) {
                console.error('Search failed:', e);
            } finally {
                this.loading = false;
            }
        }
    }"
    x-init="$watch('query', value => search())"
    class="w-full"
>
    <div class="relative">
        <input
            type="search"
            x-model="query"
            placeholder="Search for bottles, brands, and people"
            class="w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6"
        />

        <div x-show="loading" class="mt-4 text-center">
            <div class="inline-block h-8 w-8 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]"></div>
        </div>

        <template x-if="!loading">
            <div class="mt-4 space-y-4">
                <template x-for="result in results" :key="result.id">
                    <div class="rounded-lg bg-white/5 p-4">
                        <a :href="result.url" class="block hover:bg-white/10">
                            <h3 x-text="result.title" class="text-lg font-medium"></h3>
                            <p x-text="result.description" class="mt-1 text-sm text-gray-400"></p>
                        </a>
                    </div>
                </template>
            </div>
        </template>
    </div>
</div>
