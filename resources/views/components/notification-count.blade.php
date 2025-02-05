@if($count = auth()->user()->unreadNotifications()->count())
    <div class="absolute -right-1 -top-1 flex h-5 w-5 items-center justify-center rounded-full bg-red-600 text-xs text-white">
        {{ $count }}
    </div>
@endif
