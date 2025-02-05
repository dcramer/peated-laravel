@props(['bottle'])

<div class="overflow-hidden rounded-lg bg-slate-800 shadow">
    <div class="px-4 py-5 sm:p-6">
        <div class="space-y-6">
            {{-- Basic Info --}}
            <div>
                <h3 class="text-lg font-medium text-white">{{ $bottle->fullName }}</h3>
                <div class="mt-2 flex flex-wrap gap-2">
                    @foreach($bottle->distillers as $distiller)
                        <x-chip>{{ $distiller->name }}</x-chip>
                    @endforeach
                </div>
            </div>

            {{-- Details --}}
            <div class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                @if($bottle->statedAge)
                    <div>
                        <dt class="text-sm font-medium text-gray-400">Age Statement</dt>
                        <dd class="mt-1 text-sm text-white">{{ $bottle->statedAge }} years</dd>
                    </div>
                @endif

                @if($bottle->bottlers->isNotEmpty())
                    <div>
                        <dt class="text-sm font-medium text-gray-400">Bottler</dt>
                        <dd class="mt-1 text-sm text-white">
                            {{ $bottle->bottlers->pluck('name')->join(', ') }}
                        </dd>
                    </div>
                @endif

                @if($bottle->category)
                    <div>
                        <dt class="text-sm font-medium text-gray-400">Category</dt>
                        <dd class="mt-1 text-sm text-white">{{ $bottle->category }}</dd>
                    </div>
                @endif
            </div>

            {{-- Description --}}
            @if($bottle->description)
                <div class="prose prose-invert max-w-none">
                    {!! Str::markdown($bottle->description) !!}
                </div>
            @endif
        </div>
    </div>
</div>
