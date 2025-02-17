@extends('layouts.customer.app')

@section('title', '500 - Internal Server Error')

@section('content')
<div class="flex flex-col items-center justify-center h-screen bg-gray-100">
    <div class="text-center">
        <h1 class="text-6xl font-bold text-red-500">500</h1>
        <h2 class="text-2xl font-semibold text-gray-700 mt-4">Internal Server Error</h2>
        <p class="text-gray-500 mt-2">Oops! Something went wrong on our end.</p>
        
        <a href="{{ url('/') }}" class="mt-6 inline-block px-6 py-3 text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700">
            Go Back Home
        </a>
    </div>
</div>
@endsection
