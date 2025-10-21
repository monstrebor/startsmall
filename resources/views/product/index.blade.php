@extends('layout.layout')

@section('title', 'Product Dashboard')

@section('script')

@endsection

@section('content')
<div class="w-full h-full">
    @include('partials.admin.navbar')
    @include('partials.admin.sidebar')

    <main class="ml-[100px] mt-[20px] mr-[20px]">
        @include('layout.all-notif')

        @include('product.product-table')
    </main>

    @include('product.create-modal')

    @include('product.edit-modal')
</div>

<script src="{{ asset('js/modal.js') }}"></script>
@endsection
