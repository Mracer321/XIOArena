@extends('admin.layouts.app')

@section('content')

<div class="max-w-6xl mx-auto">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
        <div>
            <h2 class="text-xl md:text-2xl font-semibold">Creator Details</h2>
            <p class="text-sm text-gray-400 mt-1">View creator profile and platform links.</p>
        </div>

        <div class="flex flex-col sm:flex-row gap-3">
            <a href="/admin/creators"
                class="inline-flex items-center justify-center px-4 py-2 rounded-xl bg-[#111827] border border-gray-800 hover:bg-[#1f2937] text-sm">
                Back to Creators
            </a>

            <a href="/admin/creators/{{ $creator->id }}/edit"
                class="inline-flex items-center justify-center px-4 py-2 rounded-xl bg-yellow-500/20 text-yellow-400 border border-yellow-500/20 hover:bg-yellow-500/30 text-sm">
                Edit Creator
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Left Card -->
        <div class="bg-[#111827] border border-gray-800 rounded-2xl p-6">
            @if($creator->profile_image)
            <img src="{{ asset('storage/' . $creator->profile_image) }}"
                class="w-24 h-24 rounded-full object-cover mb-4 border border-gray-700">
            @else
            <div class="w-24 h-24 rounded-full bg-[#0b1220] border border-gray-700 mb-4"></div>
            @endif

            <h3 class="text-xl font-semibold">{{ $creator->name }}</h3>
            <p class="text-gray-400 mt-1">{{ $creator->contact_email ?: 'No email added' }}</p>

            <div class="flex flex-wrap gap-2 mt-4">
                @forelse($creator->games as $game)
                <span class="px-3 py-1 rounded-full bg-blue-500/20 text-blue-400 text-xs">
                    {{ $game->game_name }}
                </span>
                @empty
                <span class="text-sm text-gray-500">No games added</span>
                @endforelse
            </div>
        </div>

        <!-- Right Details -->
        <div class="lg:col-span-2 bg-[#111827] border border-gray-800 rounded-2xl p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 text-sm">

                <div>
                    <p class="text-gray-400 mb-1">Slug</p>
                    <p class="text-white break-all">{{ $creator->slug }}</p>
                </div>

                <div>
                    <p class="text-gray-400 mb-1">Phone</p>
                    <p class="text-white">{{ $creator->contact_phone ?: '—' }}</p>
                </div>

                <div>
                    <p class="text-gray-400 mb-1">Featured</p>
                    <p class="text-white">{{ $creator->is_featured ? 'Yes' : 'No' }}</p>
                </div>

                <div>
                    <p class="text-gray-400 mb-1">Status</p>
                    <p class="text-white">{{ $creator->is_active ? 'Active' : 'Inactive' }}</p>
                </div>
            </div>

            <div class="mt-6">
                <p class="text-gray-400 mb-2">Bio</p>
                <div class="rounded-xl border border-gray-800 bg-[#0b1220] p-4 text-gray-300 leading-7">
                    {{ $creator->bio ?: 'No bio added.' }}
                </div>
            </div>

            <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ $creator->youtube ?: '#' }}" target="_blank"
                    class="rounded-xl border border-gray-800 bg-[#0b1220] p-4 block hover:border-blue-500/40">
                    <p class="text-gray-400 text-sm">YouTube</p>
                    <p class="mt-1 text-white truncate">{{ $creator->youtube ? 'Open Link' : 'Not added' }}</p>
                </a>

                <a href="{{ $creator->instagram ?: '#' }}" target="_blank"
                    class="rounded-xl border border-gray-800 bg-[#0b1220] p-4 block hover:border-pink-500/40">
                    <p class="text-gray-400 text-sm">Instagram</p>
                    <p class="mt-1 text-white truncate">{{ $creator->instagram ? 'Open Link' : 'Not added' }}</p>
                </a>

                <a href="{{ $creator->discord ?: '#' }}" target="_blank"
                    class="rounded-xl border border-gray-800 bg-[#0b1220] p-4 block hover:border-indigo-500/40">
                    <p class="text-gray-400 text-sm">Discord</p>
                    <p class="mt-1 text-white truncate">{{ $creator->discord ? 'Open Link' : 'Not added' }}</p>
                </a>
            </div>
        </div>

    </div>

</div>

@endsection