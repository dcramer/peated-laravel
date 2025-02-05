<x-list-item no-hover>
    <div class="flex w-full items-center">
        {{-- Skeleton Icon --}}
        <div class="m-2 hidden h-10 w-10 animate-pulse rounded-full bg-slate-700 sm:block"></div>

        <div class="min-w-0 flex-auto">
            {{-- Title --}}
            <div class="h-4 w-48 animate-pulse rounded bg-slate-700"></div>

            {{-- Subtitle --}}
            <div class="mt-2 h-3 w-32 animate-pulse rounded bg-slate-700"></div>
        </div>

        {{-- Right side details --}}
        <div class="hidden sm:flex sm:flex-col sm:items-end">
            <div class="h-4 w-16 animate-pulse rounded bg-slate-700"></div>
            <div class="mt-2 h-3 w-12 animate-pulse rounded bg-slate-700"></div>
        </div>
    </div>
</x-list-item>
