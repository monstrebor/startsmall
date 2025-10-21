@extends('layout.layout')

@section('title', 'Expenses Dashboard')

@section('content')
    <div class="w-full min-h-screen bg-gray-50">
        @include('partials.admin.navbar')
        @include('partials.admin.sidebar')

        @include('admin.expenses.table')
    </div>
    
    <script src="{{ asset('js/editExpenseModal.js') }}"></script>
@endsection