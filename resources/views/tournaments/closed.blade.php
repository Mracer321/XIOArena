@extends('layouts.app')

@section('content')

<h1 class="text-xl md:text-2xl font-bold mb-6">
    📜 Previous / Closed Tournaments
</h1>

<div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4">

    @foreach($tournaments as $tournament)

    <div class="bg-[#111827] rounded-xl p-3 relative">

        <div class="aspect-square rounded-lg overflow-hidden mb-3 relative">

            @if($tournament->poster)
            <img src="{{ asset('storage/'.$tournament->poster) }}"
                class="w-full h-full object-cover">
            @endif

            @if($tournament->is_scammed)
            <div class="absolute inset-0 bg-red-700/80 flex items-center justify-center text-white font-bold">
                SCAMMED
            </div>
            @endif

            @if($tournament->pp_pending)
            <div class="absolute inset-0 bg-yellow-500/80 flex items-center justify-center text-black font-bold">
                PP PENDING
            </div>
            @endif

        </div>

        <h4 class="text-sm font-semibold">
            {{ $tournament->title }}
        </h4>

    </div>

    @endforeach

</div>

<div class="mt-8">
    {{ $tournaments->links() }}
</div>

@endsection