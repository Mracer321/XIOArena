@extends('layouts.app')

@section('content')

<div class="mb-8">

    <h1 class="text-3xl font-bold mb-1">Organizations</h1>
    <p class="text-gray-400 text-sm">
        Explore tournament organizers and esports communities
    </p>

</div>


<!-- Search -->
<form method="GET" class="mb-6">

    <div class="relative">

        <input type="text"
            name="search"
            value="{{request('search')}}"
            placeholder="Search organizations..."
            class="w-full bg-[#0f172a] border border-gray-700 rounded-xl px-4 py-3 text-sm">

    </div>

</form>


<!-- Tabs -->
<div class="flex gap-3 mb-8 overflow-x-auto">

    <a href="{{route('orgs.index')}}"
        class="px-5 py-2 rounded-full text-sm
{{!request('filter') ? 'bg-white text-black':'bg-[#111827]'}}">
        All ({{$counts['all']}})
    </a>

    <a href="?filter=trusted"
        class="px-5 py-2 rounded-full text-sm
{{request('filter')=='trusted' ? 'bg-green-500 text-black':'bg-[#111827]'}}">
        Trusted ({{$counts['trusted']}})
    </a>

    <a href="?filter=verified"
        class="px-5 py-2 rounded-full text-sm
{{request('filter')=='verified' ? 'bg-blue-500 text-black':'bg-[#111827]'}}">
        Verified ({{$counts['verified']}})
    </a>

    <a href="?filter=normal"
        class="px-5 py-2 rounded-full text-sm
{{request('filter')=='normal' ? 'bg-purple-500 text-black':'bg-[#111827]'}}">
        New ({{$counts['normal']}})
    </a>

</div>


<!-- ORG GRID -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-6">

    @foreach($orgs as $org)

    <a href="{{route('org.show',$org->slug)}}"
        class="bg-[#111827] border border-white/5 rounded-2xl p-5 hover:scale-105 transition">

        <div class="flex items-center gap-3 mb-4">

            <div class="w-12 h-12 rounded-lg overflow-hidden">

                @if($org->logo)
                <img src="{{asset('storage/'.$org->logo)}}"
                    class="w-full h-full object-cover">
                @endif

            </div>

            <div>
                <h3 class="font-semibold">{{$org->name}}</h3>

                @if($org->trust_status == 'trusted')
                <span class="text-xs bg-green-500/20 text-green-400 px-2 py-1 rounded">
                    Trusted
                </span>
                @endif

                @if($org->trust_status == 'verified')
                <span class="text-xs bg-blue-500/20 text-blue-400 px-2 py-1 rounded">
                    Verified
                </span>
                @endif

                @if($org->trust_status == 'normal')
                <span class="text-xs bg-purple-500/20 text-purple-400 px-2 py-1 rounded">
                    New
                </span>
                @endif

            </div>

        </div>


        @if($org->tournaments_count > 0)

        <div class="flex items-center gap-2 text-sm text-gray-400">

            <i data-lucide="trophy" class="w-4 h-4"></i>

            {{$org->tournaments_count}} Tournaments Hosted

        </div>

        @endif


        <div class="mt-4">

            <button
                class="w-full bg-[#1f2937] py-2 rounded-lg text-sm hover:bg-[#374151]">

                View Profile

            </button>

        </div>

    </a>

    @endforeach

</div>


<!-- Pagination -->
<div class="mt-10">
    {{$orgs->links()}}
</div>

@endsection