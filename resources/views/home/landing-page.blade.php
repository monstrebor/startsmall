@extends('layout.layout')

@section('title', 'Landing Page')

@section('script')
@endsection

@section('content')

    <div class="w-full min-h-screen bg-gray-50">
        @include('partials.home-navbar')

        <div class="max-w-6xl mx-auto px-4 py-8">

            <div class="container mx-auto px-4 py-6">
                @include('layout.all-notif')
                <h2 class="text-2xl font-bold mb-6">Our Products</h2>
                <div class="">
                    @include('home.quotes')
                </div>
            </div>

            @if (auth()->check() && auth()->user()->is_new)
                <div class="mt-10">
                    @include('settings.change-password')
                </div>
            @endif
        </div>

    </div>
    <script src="{{ asset('js/randomQuotes.js') }}"></script>
@endsection