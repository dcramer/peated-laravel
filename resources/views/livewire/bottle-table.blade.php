<div>
    @if($bottles->count() > 0)
        <div class="overflow-hidden rounded-lg bg-slate-800 shadow">
            <table class="min-w-full divide-y divide-slate-700">
                <thead>
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-400">
                            <button wire:click="$set('sort', '{{ $sort === 'name' ? '-name' : 'name' }}')" class="group inline-flex">
                                Name
                                <span class="ml-2 flex-none rounded text-gray-400">
                                    @if($sort === 'name')
                                        ↑
                                    @elseif($sort === '-name')
                                        ↓
                                    @endif
                                </span>
                            </button>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-400">
                            <button wire:click="$set('sort', '{{ $sort === 'tastings' ? '-tastings' : 'tastings' }}')" class="group inline-flex">
                                Tastings
                                <span class="ml-2 flex-none rounded text-gray-400">
                                    @if($sort === 'tastings')
                                        ↑
                                    @elseif($sort === '-tastings')
                                        ↓
                                    @endif
                                </span>
                            </button>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700">
                    @foreach($bottles as $bottle)
                        <tr class="hover:bg-slate-700">
                            <td class="whitespace-nowrap px-6 py-4">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <a href="{{ route('bottles.show', $bottle) }}" class="text-sm font-medium text-white hover:text-highlight">
                                            {{ $bottle->name }}
                                        </a>
                                        <div class="text-sm text-gray-400">
                                            {{ $bottle->distillers->pluck('name')->join(', ') }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-400">
                                {{ $bottle->tastings_count }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="border-t border-slate-700 px-4 py-3">
                {{ $bottles->links() }}
            </div>
        </div>
    @else
        <div class="text-center">
            <x-empty-activity>
                Looks like there's nothing in the database yet. Weird.
            </x-empty-activity>
        </div>
    @endif
</div>
