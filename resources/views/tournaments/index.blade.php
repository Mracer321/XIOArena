@extends('layouts.app')

@section('content')

<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl md:text-3xl font-extrabold 
               bg-gradient-to-r from-cyan-400 to-purple-500 
               bg-clip-text text-transparent tracking-wide">
        Open Tournaments
    </h2>

    <div class="h-[2px] flex-1 ml-6 bg-gradient-to-r 
                from-cyan-500/50 to-transparent"></div>
</div>
<!-- Filters -->
<form method="GET" class="mb-6 grid grid-cols-2 md:grid-cols-4 gap-3">

    <input type="text" name="search"
        value="{{ request('search') }}"
        placeholder="Search..."
        class="bg-[#111827] border border-gray-700 rounded px-3 py-2 text-sm">

    <select name="type"
        class="bg-[#111827] border border-gray-700 rounded px-3 py-2 text-sm">
        <option value="">All Type</option>
        <option value="online" {{ request('type')=='online'?'selected':'' }}>Online</option>
        <option value="offline" {{ request('type')=='offline'?'selected':'' }}>Offline (LAN)</option>
    </select>

    <select name="entry_type"
        class="bg-[#111827] border border-gray-700 rounded px-3 py-2 text-sm">
        <option value="">All Entry</option>
        <option value="free" {{ request('entry_type')=='free'?'selected':'' }}>Free</option>
        <option value="paid" {{ request('entry_type')=='paid'?'selected':'' }}>Paid</option>
    </select>

    <button class="bg-indigo-600 text-white rounded px-4 py-2 text-sm">
        Filter
    </button>

</form>

<!-- Grid -->
<div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4">

    @foreach($tournaments as $tournament)

    <a href="/tournament/{{ $tournament->slug }}"
        class="bg-[#111827] rounded-xl p-3 hover:scale-105 transition shadow-md relative">

        <div class="aspect-square rounded-lg overflow-hidden mb-3">
            @if($tournament->poster)
            <img src="{{ asset('storage/'.$tournament->poster) }}"
                class="w-full h-full object-cover">
            @else
            <img src="https://picsum.photos/500"
                class="w-full h-full object-cover">
            @endif
        </div>

        <h4 class="text-sm font-semibold mb-1">
            {{ $tournament->title }}
        </h4>

        <p class="text-xs text-gray-400">
            ₹{{ number_format($tournament->prize_pool) }}
        </p>

        <!-- Org Type Badge -->
        @php
        $orgType = $tournament->organization->trust_status ?? 'normal';
        @endphp

        <span class="text-xs px-2 py-1 rounded mt-2 inline-block
        {{ $orgType == 'trusted' ? 'bg-purple-600' : ($orgType == 'verified' ? 'bg-blue-600' : 'bg-gray-600') }}">
            {{ ucfirst($orgType) }}
        </span>

    </a>

    @endforeach

</div>

<div class="mt-8">
    {{ $tournaments->links() }}
</div>

@endsection