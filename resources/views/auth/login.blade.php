@extends('layouts.app')

@section('content')

<div class="max-w-md mx-auto mt-20 bg-[#111827] p-6 rounded-xl">

    <h2 class="text-xl font-semibold mb-6 text-center">
        Admin Login
    </h2>

    @if(session('error'))
    <p class="text-red-500 text-sm mb-4">
        {{ session('error') }}
    </p>
    @endif

    <form method="POST" action="/login">
        @csrf

        <div class="mb-4">
            <input type="email" name="email" placeholder="Email"
                class="w-full bg-[#0b0f17] border border-gray-700 rounded px-3 py-2 text-sm">
        </div>

        <div class="mb-6">
            <input type="password" name="password" placeholder="Password"
                class="w-full bg-[#0b0f17] border border-gray-700 rounded px-3 py-2 text-sm">
        </div>

        <button class="w-full bg-blue-600 py-2 rounded">
            Login
        </button>

    </form>

</div>

@endsection