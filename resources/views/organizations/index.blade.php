@extends('layouts.app')

@section('content')

<form method="GET" class="mb-6 grid grid-cols-2 md:grid-cols-4 gap-3">

    <!-- Search -->
    <input type="text" name="search"
        value="{{ request('search') }}"
        placeholder="Search organization..."
        class="bg-[#111827] border border-gray-700 rounded px-3 py-2 text-sm">

    <!-- Filter -->
    <select name="filter"
        class="bg-[#111827] border border-gray-700 rounded px-3 py-2 text-sm">
        <option value="">All</option>
        <option value="trusted" {{ request('filter')=='trusted'?'selected':'' }}>Trusted</option>
        <option value="normal" {{ request('filter')=='normal'?'selected':'' }}>New</option>
    </select>

    <button class="bg-indigo-600 text-white rounded px-4 py-2 text-sm">
        Search
    </button>

</form>

<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl md:text-3xl font-extrabold 
               bg-gradient-to-r from-purple-400 to-pink-500 
               bg-clip-text text-transparent tracking-wide">
        Organizations
    </h2>

    <div class="h-[2px] flex-1 ml-6 bg-gradient-to-r 
                from-purple-500/50 to-transparent"></div>
</div>

<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">

    @foreach($orgs as $org)

    <a href="{{ route('org.show',$org->slug) }}"
        class="bg-[#111827] rounded-xl p-4 hover:scale-105 transition shadow-md">

        <div class="w-20 h-20 mx-auto rounded-full overflow-hidden mb-3">
            @if($org->logo)
            <img src="{{ asset('storage/'.$org->logo) }}"
                class="w-full h-full object-cover">
            @else
            <img src="https://picsum.photos/200"
                class="w-full h-full object-cover">
            @endif
        </div>

        <h3 class="text-center text-sm font-medium">
            {{ $org->name }}
        </h3>

        <p class="text-center text-xs mt-1
        {{ $org->trust_status == 'trusted' ? 'text-purple-400' :
           ($org->trust_status == 'verified' ? 'text-blue-400' : 'text-gray-400') }}">
            {{ ucfirst($org->trust_status) }}
        </p>

    </a>

    @endforeach

</div>

<div class="mt-8">
    {{ $orgs->links() }}
</div>

@endsection