@extends('admin.layouts.app')

@section('content')

<h2 class="text-xl md:text-2xl font-semibold mb-6">
    Dashboard
</h2>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

    <!-- Total Tournaments -->
    <div class="bg-[#111827] p-6 rounded-xl flex items-center justify-between hover:bg-[#1f2937] transition">

        <div>
            <p class="text-sm text-gray-400">Total Tournaments</p>
            <p class="text-2xl font-bold mt-2">120</p>
        </div>

        <div class="bg-blue-500/20 p-3 rounded-lg">
            <i data-lucide="trophy" class="w-6 h-6 text-blue-400"></i>
        </div>

    </div>

    <!-- Total Organizations -->
    <div class="bg-[#111827] p-6 rounded-xl flex items-center justify-between hover:bg-[#1f2937] transition">

        <div>
            <p class="text-sm text-gray-400">Total Organizations</p>
            <p class="text-2xl font-bold mt-2">45</p>
        </div>

        <div class="bg-purple-500/20 p-3 rounded-lg">
            <i data-lucide="building-2" class="w-6 h-6 text-purple-400"></i>
        </div>

    </div>

    <!-- Premium Partners -->
    <div class="bg-[#111827] p-6 rounded-xl flex items-center justify-between hover:bg-[#1f2937] transition">

        <div>
            <p class="text-sm text-gray-400">Premium Partners</p>
            <p class="text-2xl font-bold mt-2">8</p>
        </div>

        <div class="bg-yellow-500/20 p-3 rounded-lg">
            <i data-lucide="star" class="w-6 h-6 text-yellow-400"></i>
        </div>

    </div>

</div>

@endsection