@extends('admin.layouts.app')

@section('content')

<h2 class="text-xl font-semibold mb-6">
    Create New Admin
</h2>

@if($errors->any())
<div class="bg-red-600 p-3 rounded mb-4 text-sm">
    {{ $errors->first() }}
</div>
@endif

<form method="POST" action="/admin/users/create" class="bg-[#111827] p-6 rounded-xl max-w-md">

    @csrf

    <div class="mb-4">
        <input type="text" name="name" placeholder="Name"
            class="w-full bg-[#0b0f17] border border-gray-700 rounded px-3 py-2 text-sm">
    </div>

    <div class="mb-4">
        <input type="email" name="email" placeholder="Email"
            class="w-full bg-[#0b0f17] border border-gray-700 rounded px-3 py-2 text-sm">
    </div>

    <div class="mb-6">
        <input type="password" name="password" placeholder="Password"
            class="w-full bg-[#0b0f17] border border-gray-700 rounded px-3 py-2 text-sm">
    </div>

    <button class="w-full bg-blue-600 py-2 rounded">
        Create Admin
    </button>

</form>

@endsection