@extends('admin.layouts.app')

@section('content')

<h2 class="text-xl md:text-2xl font-semibold mb-6">
    Create New Admin
</h2>

@if($errors->any())
<div class="bg-red-600 p-3 rounded mb-4 text-sm">
    {{ $errors->first() }}
</div>
@endif

<form method="POST"
    action="/admin/users/create"
    class="bg-[#111827] p-5 md:p-8 rounded-xl max-w-md space-y-5">

    @csrf


    <!-- Name -->
    <div>

        <label class="flex items-center gap-2 text-sm mb-2 text-gray-300">
            <i data-lucide="user" class="w-4 h-4"></i>
            Name
        </label>

        <input
            type="text"
            name="name"
            placeholder="Enter admin name"
            class="w-full bg-[#0b0f17] border border-gray-700 rounded-lg px-3 py-2 text-sm focus:border-indigo-500">

    </div>


    <!-- Email -->
    <div>

        <label class="flex items-center gap-2 text-sm mb-2 text-gray-300">
            <i data-lucide="mail" class="w-4 h-4"></i>
            Email
        </label>

        <input
            type="email"
            name="email"
            placeholder="Enter email address"
            class="w-full bg-[#0b0f17] border border-gray-700 rounded-lg px-3 py-2 text-sm focus:border-indigo-500">

    </div>


    <!-- Password -->
    <div>

        <label class="flex items-center gap-2 text-sm mb-2 text-gray-300">
            <i data-lucide="lock" class="w-4 h-4"></i>
            Password
        </label>

        <input
            type="password"
            name="password"
            placeholder="Enter password"
            class="w-full bg-[#0b0f17] border border-gray-700 rounded-lg px-3 py-2 text-sm focus:border-indigo-500">

    </div>


    <button
        class="w-full bg-indigo-600 hover:bg-indigo-700 transition py-2 rounded-lg text-sm font-medium">

        Create Admin

    </button>

</form>

@endsection