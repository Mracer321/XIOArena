@extends('layouts.app')

@section('content')

<!-- HERO SECTION -->

<section class="relative h-[420px] md:h-[480px] rounded-3xl overflow-hidden mb-10">

    <!-- Background Image -->
    <img
        src="https://images.unsplash.com/photo-1542751371-adc38448a05e"
        class="absolute inset-0 w-full h-full object-cover">

    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-[#0b0f17]/80"></div>

    <!-- Left Gradient -->
    <div class="absolute inset-0 bg-gradient-to-r from-[#0b0f17] via-[#0b0f17]/80 to-transparent"></div>

    <!-- Content -->

    <div class="relative z-10 h-full flex items-center px-6 md:px-12">

        <div class="max-w-xl">

            <!-- Verified Badge -->

            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full
                        bg-emerald-500/10 border border-emerald-500/30
                        text-emerald-400 text-sm mb-4">

                <i data-lucide="shield-check" class="w-4 h-4"></i>

                Verified Tournament

            </div>


            <!-- Title -->

            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-4">

                BGMI ROYALE
                <br>
                Championship

            </h1>


            <!-- Prize Pool -->

            <p class="text-lg text-gray-300 mb-4">

                Prize Pool:
                <span class="text-3xl font-bold bg-gradient-to-r
                from-blue-400 to-purple-500 text-transparent bg-clip-text">

                    ₹2,00,000

                </span>

            </p>


            <!-- Meta Info -->

            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-300 mb-8">

                <div class="flex items-center gap-2">

                    <i data-lucide="calendar"></i>
                    Reveal Soon

                </div>

                <div class="flex items-center gap-2">

                    <i data-lucide="trophy"></i>
                    Limited Slots

                </div>

                <div class="px-3 py-1 rounded-full bg-blue-500/20 text-blue-400">

                    Free Entry

                </div>

            </div>


            <!-- Button -->

            <button
                class="flex items-center gap-2
                bg-gradient-to-r from-blue-500 to-purple-500
                hover:from-blue-600 hover:to-purple-600
                px-6 py-3 rounded-xl font-semibold
                shadow-lg shadow-purple-500/30
                transition">

                Coming Soon

                <i data-lucide="arrow-right"></i>

            </button>

        </div>

    </div>

</section>

<!-- Featured Section -->
<div class="flex items-end justify-between mb-6">

    <!-- Left Side -->
    <div>

        <h2 class="text-xl md:text-2xl font-semibold text-white">

            Featured Tournaments

        </h2>

        <p class="text-sm text-gray-400 mt-1">

            Join now and compete for prizes

        </p>

    </div>

    <!-- Right Side -->

    <a href="/tournaments"
        class="flex items-center gap-1 text-sm font-medium
        text-blue-400 hover:text-blue-300 transition">

        View All

        <i data-lucide="chevron-right" class="w-4 h-4"></i>

    </a>

</div>


<div class="flex gap-4 overflow-x-auto pb-4 
snap-x snap-mandatory
lg:grid lg:grid-cols-4 lg:gap-6 lg:overflow-visible">

    @forelse($featured as $tournament)

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
<!-- Tournament Grid -->
<div class="flex items-end justify-between mb-6">

    <!-- Left Side -->
    <div>

        <h2 class="text-xl md:text-2xl font-semibold text-white">

            Open Tournaments

        </h2>

        <p class="text-sm text-gray-400 mt-1">

            Join now and compete for prizes

        </p>

    </div>

    <!-- Right Side -->

    <a href="/tournaments"
        class="flex items-center gap-1 text-sm font-medium
        text-blue-400 hover:text-blue-300 transition">

        View All

        <i data-lucide="chevron-right" class="w-4 h-4"></i>

    </a>

</div>
<div class="flex gap-4 overflow-x-auto pb-4 
snap-x snap-mandatory
lg:grid lg:grid-cols-4 lg:gap-6 lg:overflow-visible">

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


<div class="mt-14">

    <div class="flex items-end justify-between mb-6">

        <div>

            <h2 class="text-xl md:text-2xl font-semibold text-white">

                Top Tournament Hosts

            </h2>

            <p class="text-sm text-gray-400">

                Verified and premium organizations hosting top tournaments

            </p>

        </div>

        <a href="/orgs"
            class="flex items-center gap-1 text-sm text-blue-400 hover:text-blue-300">

            View All

            <i data-lucide="chevron-right" class="w-4 h-4"></i>

        </a>

    </div>


    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

        @foreach($orgs as $org)

        <a href="{{ route('org.show',$org->slug) }}">

            <div class="bg-[#111827] border border-gray-800
hover:border-blue-500/40
rounded-xl p-5 text-center
transition">

                <div class="relative inline-block mb-3">

                    <img
                        src="{{ $org->logo ? asset('storage/'.$org->logo) : 'https://picsum.photos/200' }}"
                        class="w-16 h-16 rounded-xl object-cover mx-auto">

                    @if($org->trust_status === 'trusted')

                    <span class="absolute -bottom-1 -right-1
bg-green-500 text-white
rounded-full p-1">

                        <i data-lucide="shield-check" class="w-3 h-3"></i>

                    </span>

                    @endif

                </div>

                <h3 class="font-semibold text-sm mb-1">

                    {{ $org->name }}

                </h3>


                @if($org->membership === 'premium')

                <span class="text-xs px-2 py-1 rounded-full
bg-purple-500/20 text-purple-400">

                    Premium

                </span>

                @elseif($org->trust_status === 'trusted')

                <span class="text-xs px-2 py-1 rounded-full
bg-green-500/20 text-green-400">

                    Trusted

                </span>

                @else

                <span class="text-xs px-2 py-1 rounded-full
bg-gray-700 text-gray-300">

                    Organizer

                </span>

                @endif

            </div>

        </a>

        @endforeach

    </div>

</div>

<div class="mt-14">

    <div class="flex items-end justify-between mb-6">

        <div>
            <h2 class="text-xl md:text-2xl font-semibold text-white">
                Featured Creators
            </h2>

            <p class="text-sm text-gray-400 mt-1">
                Explore gaming creators available for promotions and collaborations
            </p>
        </div>

        <a href="{{ route('creators.index') }}"
            class="flex items-center gap-1 text-sm font-medium text-blue-400 hover:text-blue-300 transition">
            View All
            <i data-lucide="chevron-right" class="w-4 h-4"></i>
        </a>

    </div>

    <div class="flex gap-4 overflow-x-auto pb-4 snap-x snap-mandatory lg:grid lg:grid-cols-3 lg:gap-6 lg:overflow-visible">

        @forelse($featuredCreators as $creator)
        <a href="{{ route('creator.show', $creator->slug) }}"
            class="min-w-[300px] lg:min-w-0 snap-start bg-[#111827] border border-gray-800 hover:border-blue-500/40 rounded-2xl p-5 transition block">

            <div class="flex items-start gap-4">
                <img
                    src="{{ $creator->profile_image ? asset('storage/' . $creator->profile_image) : 'https://picsum.photos/200' }}"
                    class="w-16 h-16 rounded-full object-cover shrink-0">

                <div class="min-w-0 flex-1">
                    <h3 class="text-xl font-semibold text-white truncate">
                        {{ $creator->name }}
                    </h3>

                    <p class="text-sm text-gray-400 mt-1">
                        {{ $creator->games->pluck('game_name')->implode(', ') ?: 'Gaming Creator' }}
                    </p>
                </div>
            </div>

            <div class="mt-6 space-y-3 text-sm">
                <div class="flex items-center justify-between text-gray-300">
                    <span>Subscribers</span>
                    <span class="font-semibold text-white creator-youtube-count" data-slug="{{ $creator->slug }}">--</span>
                </div>

                <div class="flex items-center justify-between text-gray-300">
                    <span>Followers</span>
                    <span class="font-semibold text-white creator-instagram-count" data-slug="{{ $creator->slug }}">--</span>
                </div>
            </div>

            <div class="mt-6">
                <span class="block w-full text-center bg-blue-500 hover:bg-blue-600 px-4 py-3 rounded-xl font-semibold transition">
                    View Profile
                </span>
            </div>
        </a>
        @empty
        <p class="text-gray-400 text-sm col-span-3">
            No creators available.
        </p>
        @endforelse

    </div>

</div>

<!-- CTA Section -->
<section class="mt-16">

    <div class="relative overflow-hidden rounded-3xl
bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600
p-8 md:p-12">

        <!-- Background glow -->

        <div class="absolute -top-20 -left-20 w-72 h-72 bg-white/10 blur-3xl rounded-full"></div>
        <div class="absolute -bottom-20 -right-20 w-72 h-72 bg-white/10 blur-3xl rounded-full"></div>

        <div class="relative flex flex-col md:flex-row md:items-center md:justify-between gap-8">

            <!-- Left Content -->

            <div class="max-w-xl">

                <h2 class="text-2xl md:text-3xl font-bold text-white mb-3">

                    Join the XIOArena Community

                </h2>

                <p class="text-white/90 text-sm md:text-base">

                    Connect with players, find teammates, get tournament updates and participate in exclusive community scrims on our Discord server.

                </p>

            </div>


            <!-- Button -->

            <a href="https://discord.gg/YOURINVITELINK"
                target="_blank"
                class="inline-flex items-center gap-2
bg-white text-blue-600
font-semibold
px-6 py-3 rounded-xl
hover:scale-105
transition">

                <i data-lucide="discord" class="w-5 h-5"></i>

                Join Discord

                <i data-lucide="arrow-right" class="w-4 h-4"></i>

            </a>

        </div>

    </div>

</section>
@endsection