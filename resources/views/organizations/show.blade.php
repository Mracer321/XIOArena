@extends('layouts.app')

@section('content')

<div class="relative bg-gradient-to-br from-[#0f172a] via-[#111827] to-black 
            p-6 md:p-10 rounded-3xl mb-10 overflow-hidden border border-white/5">

    <!-- Glow Effects -->
    <div class="absolute -top-16 -right-16 w-64 h-64 bg-cyan-500 opacity-10 blur-3xl rounded-full"></div>
    <div class="absolute -bottom-16 -left-16 w-64 h-64 bg-purple-600 opacity-10 blur-3xl rounded-full"></div>

    <div class="relative flex flex-col md:flex-row gap-8 items-center md:items-start">

        <!-- Logo -->
        <div class="w-28 h-28 md:w-36 md:h-36 rounded-full 
                    bg-black flex items-center justify-center
                    shadow-[0_0_40px_rgba(0,255,255,0.3)]">

            @if($org->logo)
            <img src="{{ asset('storage/'.$org->logo) }}"
                class="w-20 md:w-24 object-contain">
            @endif

        </div>

        <!-- Content -->
        <div class="flex-1 text-center md:text-left">

            <h1 class="text-3xl md:text-4xl font-extrabold mb-3">
                {{ $org->name }}
            </h1>

            <!-- Badges -->
            <div class="flex flex-wrap justify-center md:justify-start gap-3 mb-5">

                <span class="px-4 py-1 text-xs font-semibold rounded-full
                    {{ $org->membership == 'verified'
                        ? 'bg-blue-600 shadow-blue-500/40 shadow-lg'
                        : 'bg-gray-600' }}">
                    {{ ucfirst($org->membership) }}
                </span>

                <span class="px-4 py-1 text-xs font-semibold rounded-full
                    {{ $org->trust_status == 'trusted'
                        ? 'bg-green-600 shadow-green-500/40 shadow-lg'
                        : 'bg-gray-600' }}">
                    {{ ucfirst($org->trust_status) }}
                </span>

            </div>

            <p class="text-gray-400 leading-relaxed max-w-2xl mx-auto md:mx-0">
                {{ $org->description }}
            </p>

            <!-- Social Icons -->
            <div class="flex gap-5 mt-6 text-xl justify-center md:justify-start">

                @if($org->instagram)
                <a href="{{ $org->instagram }}" target="_blank"
                    class="text-pink-400 hover:scale-110 
                          hover:drop-shadow-[0_0_8px_currentColor] transition">
                    <i data-lucide="instagram"></i>
                </a>
                @endif

                @if($org->discord)
                <a href="{{ $org->discord }}" target="_blank"
                    class="text-indigo-400 hover:scale-110 
                          hover:drop-shadow-[0_0_8px_currentColor] transition">
                    <i data-lucide="message-circle"></i>
                </a>
                @endif

                @if($org->youtube)
                <a href="{{ $org->youtube }}" target="_blank"
                    class="text-red-500 hover:scale-110 
                          hover:drop-shadow-[0_0_8px_currentColor] transition">
                    <i data-lucide="youtube"></i>
                </a>
                @endif

                @if($org->website)
                <a href="{{ $org->website }}" target="_blank"
                    class="text-green-400 hover:scale-110 
                          hover:drop-shadow-[0_0_8px_currentColor] transition">
                    <i data-lucide="globe"></i>
                </a>
                @endif

            </div>

        </div>

    </div>

</div>


<!-- Org Stats -->
<!-- <div class="grid grid-cols-2 md:grid-cols-2 gap-6 mb-12">

    <div class="bg-gradient-to-br from-[#111827] to-black 
                p-6 rounded-2xl text-center border border-white/5">

        <p class="text-3xl font-bold text-cyan-400">
            {{ $org->tournaments->count() }}
        </p>
        <p class="text-xs uppercase tracking-widest text-gray-400">
            Total Tournaments
        </p>
    </div>

    <div class="bg-gradient-to-br from-[#111827] to-black 
                p-6 rounded-2xl text-center border border-white/5">

        <p class="text-3xl font-bold text-purple-400">
            ₹{{ number_format($org->tournaments->sum('prize_pool')) }}
        </p>
        <p class="text-xs uppercase tracking-widest text-gray-400">
            Total Prize Pool
        </p>
    </div>

</div> -->

<!-- Active Tournaments -->
<h2 class="text-lg font-semibold mb-4">Active Tournaments</h2>

<div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-10">

    @foreach($org->tournaments->where('registration_status','open') as $tournament)

    <a href="{{ route('tournament.show',$tournament->slug) }}"
        class="bg-[#111827] rounded-xl p-3 hover:scale-105 transition shadow-md">

        <!-- Poster -->
        <div class="aspect-square rounded-lg overflow-hidden mb-3">
            @if($tournament->poster)
            <img src="{{ asset('storage/'.$tournament->poster) }}"
                class="w-full h-full object-cover">
            @else
            <img src="https://picsum.photos/400"
                class="w-full h-full object-cover">
            @endif
        </div>

        <h4 class="text-sm font-semibold">
            {{ $tournament->title }}
        </h4>

    </a>

    @endforeach
</div>


<!-- Past Tournaments -->
<h2 class="text-lg font-semibold mb-4">Past Tournaments</h2>

<div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4">

    @foreach($org->tournaments->where('registration_status','closed') as $tournament)

    <div class="bg-[#111827] rounded-xl p-3 relative">

        <h4 class="text-sm font-semibold">
            {{ $tournament->title }}
        </h4>

        @if($tournament->is_scammed)
        <div class="absolute inset-0 bg-red-700/80 flex items-center justify-center text-white text-xs font-bold">
            SCAMMED
        </div>
        @endif

    </div>

    @endforeach

</div>

@endsection