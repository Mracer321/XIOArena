@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<!-- Hero Section -->
<div class="relative bg-gradient-to-br from-[#111827] via-[#1f2937] to-black 
            rounded-3xl p-6 md:p-12 mb-10 overflow-hidden">

    <!-- Background Glow -->
    <div class="absolute -top-20 -right-20 w-72 h-72 bg-cyan-500 opacity-20 blur-3xl rounded-full"></div>
    <div class="absolute -bottom-20 -left-20 w-72 h-72 bg-purple-600 opacity-20 blur-3xl rounded-full"></div>

    <div class="relative z-10 flex flex-col md:flex-row items-center gap-10">

        <!-- Left Content -->
        <div class="flex-1 text-center md:text-left">

            <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold mb-4 
                       text-transparent bg-clip-text 
                       bg-gradient-to-r from-cyan-400 via-purple-500 to-pink-500">
                XIO ARENA
            </h1>

            <h2 class="text-lg sm:text-xl font-semibold text-gray-300 mb-4">
                India’s Premier BGMI Tournament Hub
            </h2>

            <p class="text-gray-400 mb-8 max-w-lg mx-auto md:mx-0">
                Discover open registrations, track live events, and explore completed tournaments —
                all in one futuristic competitive platform.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">

                <a href="#tournaments"
                    class="bg-cyan-500 hover:bg-cyan-600 
                          px-6 py-3 rounded-xl font-semibold 
                          shadow-lg shadow-cyan-500/30 
                          transition duration-300">
                    Explore Tournaments
                </a>

                <a href="/players"
                    class="border border-purple-500 
                          hover:bg-purple-600 hover:text-white
                          px-6 py-3 rounded-xl font-semibold 
                          transition duration-300">
                    Join as Player
                </a>

            </div>

        </div>

        <!-- Right Logo Section -->
        <div class="flex-1 flex justify-center">

            <div class="relative w-64 sm:w-80 md:w-96">

                <!-- Glow Behind Logo -->
                <div class="absolute inset-0 bg-cyan-500 opacity-20 blur-3xl rounded-full"></div>

                <img src="{{ asset('images/xio-logo2.png') }}"
                    alt="XIO ARENA Logo"
                    class="relative w-full object-contain 
                            drop-shadow-[0_0_25px_rgba(0,255,255,0.6)]">

            </div>

        </div>

    </div>

</div>
<!-- Featured Section -->
<div class="flex justify-between items-center mb-4">
    <h3 class="text-lg md:text-xl font-semibold">
        🔥 Featured Tournaments
    </h3>

    <a href="/featured" class="text-sm text-blue-400 hover:text-blue-300">
        View All →
    </a>
</div>
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-10">

    @forelse($featured as $tournament)

    <div class="ring-1 ring-blue-500/40 rounded-xl">
        <x-tournament-card
            :slug="$tournament->slug"
            :title="$tournament->title"
            :prize="$tournament->prize_pool"
            :registration="$tournament->registration_status"
            :entry="$tournament->entry_type"
            :image="$tournament->poster"
            :orgStatus="$tournament->organization->trust_status ?? 'normal'" />
    </div>

    @empty
    <p class="col-span-4 text-gray-400 text-sm">
        No featured tournaments available.
    </p>
    @endforelse

</div>

<!-- Tournament Grid -->
<div class="flex justify-between items-center mb-4">
    <h3 class="text-lg md:text-xl font-semibold">
        🎮 All Tournaments
    </h3>

    <a href="/tournaments" class="text-sm text-blue-400 hover:text-blue-300">
        Show All →
    </a>

</div>
<div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">

    @forelse($latest as $tournament)

    <x-tournament-card
        :slug="$tournament->slug"
        :title="$tournament->title"
        :prize="$tournament->prize_pool"
        :registration="$tournament->registration_status"
        :entry="$tournament->entry_type"
        :image="$tournament->poster"
        :orgStatus="$tournament->organization->trust_status ?? 'normal'" />
    @empty
    <p class="col-span-4 text-gray-400 text-sm">
        No tournaments available.
    </p>
    @endforelse

</div>

@endsection