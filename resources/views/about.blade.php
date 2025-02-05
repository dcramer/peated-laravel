<x-app-layout>
    <x-slot name="title">About</x-slot>
    <x-slot name="header">
        <x-app-header />
    </x-slot>


    <div class="flex gap-4 px-2 sm:px-0">
        <div class="prose prose-invert w-9/12 py-6">
            <h1>The Mission</h1>
            <p>
                Peated, inspired by apps like Untappd and Vivino, aims to create a
                rich social experience around tasting and collecting Whiskey. We
                leverage modern and open source technology to go beyond the typical
                experiences you see elsewhere.
            </p>
            <p>
                Core to our goals is a spirit database heavily focused on
                reliability and quality of data. This database has been bootstrapped
                by collating various sources of data, and is curated by the
                community. Most importantly, its available via a modern web API, the
                same API which powers the application experiences.
            </p>
            <p>
                Peated was started by
                <a href="https://twitter.com/zeeg">David Cramer</a> and is
                <a href="{{ $githubRepo }}">Open Source on GitHub</a>. A
                <a href="{{ $discordLink }}">Discord server</a> is available if you
                want to contribute.
            </p>

            <p>
                Peated is running version
                @if($version)
                    <a href="{{ $githubRepo }}/commit/{{ $version }}">
                        {{ $version }}
                    </a>
                @else
                    <em>an unknown version</em>
                @endif
            </p>
        </div>
        <div class="hidden w-3/12 sm:block">
            <div class="prose prose-invert py-6 text-center">
                <h1>Key Data</h1>
            </div>
            <div class="hidden items-center gap-4 text-center sm:grid sm:grid-cols-1 lg:grid-cols-2">
                @foreach(['Tastings' => $stats['tastings'], 'Bottles' => $stats['bottles'], 'Entities' => $stats['entities']] as $name => $value)
                    <div>
                        <div class="text-muted leading-7">{{ $name }}</div>
                        <div class="order-first text-3xl font-semibold tracking-tight sm:text-5xl">
                            {{ number_format($value) }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
