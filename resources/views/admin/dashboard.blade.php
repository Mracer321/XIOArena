@extends('admin.layouts.app')

@section('content')

<h2 class="text-xl font-semibold mb-6">
    Dashboard
</h2>

<div class="grid grid-cols-3 gap-6">

    <div class="bg-[#111827] p-6 rounded-xl">
        <p class="text-sm text-gray-400">Total Tournaments</p>
        <p class="text-2xl font-bold mt-2">120</p>
    </div>

    <div class="bg-[#111827] p-6 rounded-xl">
        <p class="text-sm text-gray-400">Total Organizations</p>
        <p class="text-2xl font-bold mt-2">45</p>
    </div>

    <div class="bg-[#111827] p-6 rounded-xl">
        <p class="text-sm text-gray-400">Premium Partners</p>
        <p class="text-2xl font-bold mt-2">8</p>
    </div>

</div>

@endsection