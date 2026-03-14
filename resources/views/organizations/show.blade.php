@extends('layouts.app')

@section('content')

@php

$banner = $org->banner
?? ($org->logo ? asset('storage/'.$org->logo)
: 'https://images.unsplash.com/photo-1542751371-adc38448a05e');

$ongoing = $org->tournaments->where('registration_status','open');
$past = $org->tournaments->where('registration_status','closed');

@endphp


<!-- HERO -->
<div class="relative mb-14">

    <!-- Banner -->
    <div class="h-72 md:h-96 w-full overflow-hidden rounded-3xl relative">

        <img src="{{ $banner }}"
            class="absolute w-full h-full object-cover scale-110 blur-sm opacity-40">

        <div class="absolute inset-0 bg-gradient-to-b from-black/20 via-black/60 to-black"></div>

    </div>


    <!-- HERO CONTENT -->
    <div class="absolute bottom-0 left-0 w-full px-6 pb-8">

        <div class="flex flex-col md:flex-row md:items-end gap-6">

            <!-- LOGO -->
            <div class="w-24 h-24 md:w-28 md:h-28 rounded-xl overflow-hidden border border-white/20 shadow-xl">

                @if($org->logo)

                <img src="{{ asset('storage/'.$org->logo) }}"
                    class="w-full h-full object-cover">

                @else

                <img src="https://picsum.photos/200"
                    class="w-full h-full object-cover">

                @endif

            </div>


            <!-- NAME + BADGE + SOCIAL -->
            <div class="flex-1">

                <h1 class="text-3xl md:text-4xl font-bold mb-2">
                    {{ $org->name }}
                </h1>


                <!-- BADGES -->
                <div class="flex items-center gap-2 mb-3">

                    @if($org->trust_status == 'trusted')

                    <span class="flex items-center gap-1 text-xs 
                    bg-green-500/10 text-green-400 
                    border border-green-400/30 
                    px-3 py-1 rounded-full">

                        <i data-lucide="shield-check" class="w-3 h-3"></i>

                        Trusted

                    </span>

                    @endif


                    @if($org->trust_status == 'verified')

                    <span class="flex items-center gap-1 text-xs 
                    bg-blue-500/10 text-blue-400 
                    border border-blue-400/30 
                    px-3 py-1 rounded-full">

                        <i data-lucide="badge-check" class="w-3 h-3"></i>

                        Verified

                    </span>

                    @endif

                </div>


                <!-- SOCIAL BUTTONS -->
                <div class="flex items-center gap-3">

                    @if($org->instagram)

                    <a href="{{$org->instagram}}" target="_blank"
                        class="w-9 h-9 flex items-center justify-center rounded-lg 
                    bg-pink-500/10 text-pink-400 
                    hover:bg-pink-500 hover:text-white transition">

                        <i data-lucide="instagram" class="w-4 h-4"></i>

                    </a>

                    @endif


                    @if($org->discord)

                    <a href="{{$org->discord}}" target="_blank"
                        class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 
                    rounded-lg text-sm font-semibold">

                        Join Discord

                    </a>

                    @endif


                    @if($org->youtube)

                    <a href="{{$org->youtube}}" target="_blank"
                        class="w-9 h-9 flex items-center justify-center rounded-lg 
                    bg-red-500/10 text-red-400 
                    hover:bg-red-500 hover:text-white transition">

                        <i data-lucide="youtube" class="w-4 h-4"></i>

                    </a>

                    @endif


                    @if($org->website)

                    <a href="{{$org->website}}" target="_blank"
                        class="w-9 h-9 flex items-center justify-center rounded-lg 
                    bg-green-500/10 text-green-400 
                    hover:bg-green-500 hover:text-white transition">

                        <i data-lucide="globe" class="w-4 h-4"></i>

                    </a>

                    @endif

                </div>

            </div>


            <!-- FOLLOW BUTTON -->
            @if($org->instagram)

            <a href="{{ $org->instagram }}"
                target="_blank"
                class="bg-blue-600 hover:bg-blue-700 
            px-6 py-3 rounded-xl font-semibold transition">

                Follow

            </a>

            @endif

        </div>

    </div>

</div>



<!-- ABOUT -->
<div class="bg-[#0f172a] rounded-2xl p-6 border border-white/5 mb-12">

    <h2 class="text-lg font-semibold mb-3 flex items-center gap-2">

        <i data-lucide="info"></i>

        About

    </h2>

    <p class="text-gray-400 leading-relaxed">

        {{ $org->description ?? 'No description available.' }}

    </p>

</div>
<!-- ONGOING TOURNAMENTS -->
@if($ongoing->count())

<h2 class="text-xl font-semibold mb-5 flex items-center gap-2">

    <i data-lucide="zap"></i>

    Ongoing Tournaments

</h2>


<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-14">

    @foreach($ongoing as $tournament)

    <a href="{{ route('tournament.show',$tournament->slug) }}"
        class="bg-[#111827] rounded-xl p-3 hover:scale-105 transition">

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

@endif




<!-- PAST TOURNAMENTS -->

@if($past->count())

<h2 class="text-xl font-semibold mb-5 flex items-center gap-2">

    <i data-lucide="archive"></i>

    Past Tournaments

</h2>


<div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

    @foreach($past as $tournament)

    <a href="{{ route('tournament.show',$tournament->slug) }}"
        class="bg-[#111827] rounded-xl p-3 hover:scale-105 transition relative">

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


        @if($tournament->is_scammed)

        <div class="absolute inset-0 bg-red-700/80 flex items-center justify-center text-white text-xs font-bold">

            SCAMMED

        </div>

        @endif

    </a>

    @endforeach

</div>

@endif


@endsection