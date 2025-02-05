@extends('layouts.app')

@section('title', 'Search')

@section('content')
    <x-search-panel :initial-value="$query" />
@endsection
