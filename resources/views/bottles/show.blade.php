@extends('layouts.app')

@section('title', $bottle->fullName)

@section('meta')
    <meta name="description" content="{{ $meta['description'] }}">
    <meta property="og:title" content="{{ $meta['title'] }}">
    <meta property="og:description" content="{{ $meta['description'] }}">
    <meta property="og:image" content="{{ $meta['image'] }}">
    <meta name="twitter:card" content="{{ $meta['twitter']['card'] }}">
    <meta name="twitter:image" content="{{ $meta['twitter']['images'][0] }}">
@endsection

@section('content')
    <div class="space-y-6">
        {{-- Stats Component --}}
        <x-bottle.stats :bottle="$bottle" />

        {{-- Overview Component --}}
        <x-bottle.overview :bottle="$bottle" />
    </div>
@endsection
