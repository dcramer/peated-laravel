@props(['user' => null, 'size' => null])

@if(isset($attributes['skeleton']))
    <div
        {{ $attributes->merge(['class' => 'h-full w-full animate-pulse rounded bg-slate-800']) }}
        @if($size)
        style="width: {{ $size }}px; height: {{ $size }}px;"
        @endif
    ></div>
@else
    @if($user && $user->picture_url)
        <img
            src="{{ $user->picture_url }}"
            {{ $attributes->merge(['class' => 'h-full w-full rounded bg-slate-900 object-cover']) }}
            alt="avatar"
            @if($size)
            style="width: {{ $size }}px; height: {{ $size }}px;"
            @endif
        />
    @else
        <svg
            {{ $attributes->merge(['class' => 'text-muted h-full w-full rounded bg-slate-900']) }}
            @if($size)
            style="width: {{ $size }}px; height: {{ $size }}px;"
            @endif
            viewBox="0 0 24 24"
            fill="currentColor"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path
                fill-rule="evenodd"
                d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm0 3a3 3 0 100 6 3 3 0 000-6zm5 9v1h-1.264c-.589-2.113-2.529-3.659-4.736-3.659s-4.147 1.546-4.736 3.659H5v-1c0-2.206 2.686-4 6-4s6 1.794 6 4z"
                clip-rule="evenodd"
            />
        </svg>
    @endif
@endif
