@extends('layout.layout')

@section('title', 'Landing Page')

@section('script')
@endsection

@section('content')

<div class="w-full min-h-screen bg-gray-50">
    @include('partials.home-navbar')

    <div class="max-w-6xl mx-auto px-4 py-8">

        <div class="container mx-auto px-4 py-6">
            @include('layout.all_notif')
            <h2 class="text-2xl font-bold mb-6">Our Products</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            </div>
        </div>

        @if (auth()->check() && auth()->user()->is_new)
        <div class="mt-10">
            @include('settings.change-password')
        </div>
        @endif
    </div>

</div>

@endsection
