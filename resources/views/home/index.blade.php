@extends('layout.layout')

@section('title', 'Ordering and Billing')

@section('script')

@endsection

@section('content')
    <div class="w-full h-full">
        <div class="flex min-h-screen">
            <div
                class="w-1/2 bg-gradient-to-br from-indigo-200 to-violet-900 text-white flex flex-col items-center justify-center p-6">
                <div class="text-center">
                    <img src="{{ asset('image/business_logo.png') }}" alt="business logo">
                    <h1 class="text-5xl font-bold mb-4" style="font-family: 'Montserrat', sans-serif;"> Start Small
                    </h1>
                    <p class="text-xl" style="font-family: 'Open Sans', sans-serif;">
                        Small business sales and inventory management system
                    </p>
                </div>
            </div>

            <div class="w-1/2 bg-white text-gray-800 flex flex-col items-center justify-center p-8">
                @include('layout.all-notif')

                <div class="w-full max-w-md">

                    <!-- Login Form -->
                    @include('home.login')

                    {{-- Register Form --}}
                    @include('home.register')
                </div>
            </div>
        </div>

    </div>

@endsection