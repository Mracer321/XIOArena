@extends('layouts.app')

@section('content')

<div class="space-y-8">

    <section class="bg-[#111827] border border-gray-800 rounded-3xl p-6 md:p-8">
        <div class="flex flex-col lg:flex-row lg:items-start gap-6">
            <div class="flex items-start gap-5 flex-1">
                <img
                    src="{{ $creator->profile_image ? asset('storage/' . $creator->profile_image) : 'https://picsum.photos/200' }}"
                    class="w-24 h-24 md:w-28 md:h-28 rounded-full object-cover shrink-0">

                <div class="min-w-0">
                    <h1 class="text-3xl md:text-4xl font-bold text-white">{{ $creator->name }}</h1>
                    <p class="text-gray-400 mt-2">Content Creator</p>

                    <div class="flex flex-wrap gap-2 mt-4">
                        @foreach($creator->games as $game)
                        <span class="px-3 py-1 rounded-full bg-blue-500/20 text-blue-400 text-sm">
                            {{ $game->game_name }}
                        </span>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-auto">
                <a href="/contact"
                    class="w-full lg:w-auto inline-flex items-center justify-center bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 px-6 py-3 rounded-xl font-semibold shadow-lg shadow-purple-500/20 transition">
                    Contact Creator
                </a>
            </div>
        </div>
    </section>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <div class="bg-[#111827] border border-gray-800 rounded-2xl p-6">
            <h2 class="text-2xl font-semibold text-white mb-5">Audience</h2>

            <div class="space-y-4">
                <div class="bg-[#0b1220] rounded-2xl px-4 py-4 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <i data-lucide="youtube" class="w-5 h-5 text-red-400"></i>
                        <span class="font-medium text-white">Subscribers</span>
                    </div>
                    <span id="youtubeCount" class="text-2xl font-bold text-white">--</span>
                </div>

                <div class="bg-[#0b1220] rounded-2xl px-4 py-4 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <i data-lucide="users" class="w-5 h-5 text-blue-400"></i>
                        <span class="font-medium text-white">Followers</span>
                    </div>
                    <span id="instagramCount" class="text-2xl font-bold text-white">--</span>
                </div>

                <div class="bg-[#0b1220] rounded-2xl px-4 py-4 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <i data-lucide="message-circle" class="w-5 h-5 text-indigo-400"></i>
                        <span class="font-medium text-white">Discord Members</span>
                    </div>
                    <span id="discordCount" class="text-2xl font-bold text-white">--</span>
                </div>
            </div>
        </div>

        <div class="bg-[#111827] border border-gray-800 rounded-2xl p-6">
            <h2 class="text-2xl font-semibold text-white mb-5">Platforms</h2>

            <div class="space-y-4">
                <a href="{{ $creator->youtube ?: '#' }}" target="_blank"
                    class="block bg-[#0b1220] rounded-2xl px-4 py-4 hover:border hover:border-red-500/40">
                    <div class="flex items-center gap-3">
                        <i data-lucide="youtube" class="w-5 h-5 text-red-400"></i>
                        <span class="font-medium text-white">YouTube</span>
                    </div>
                </a>

                <a href="{{ $creator->instagram ?: '#' }}" target="_blank"
                    class="block bg-[#0b1220] rounded-2xl px-4 py-4 hover:border hover:border-pink-500/40">
                    <div class="flex items-center gap-3">
                        <i data-lucide="instagram" class="w-5 h-5 text-pink-400"></i>
                        <span class="font-medium text-white">Instagram</span>
                    </div>
                </a>

                <a href="{{ $creator->discord ?: '#' }}" target="_blank"
                    class="block bg-[#0b1220] rounded-2xl px-4 py-4 hover:border hover:border-indigo-500/40">
                    <div class="flex items-center gap-3">
                        <i data-lucide="message-circle" class="w-5 h-5 text-indigo-400"></i>
                        <span class="font-medium text-white">Discord</span>
                    </div>
                </a>
            </div>
        </div>

        <div class="bg-[#111827] border border-gray-800 rounded-2xl p-6">
            <h2 class="text-2xl font-semibold text-white mb-5">Games Covered</h2>

            <div class="flex flex-wrap gap-3">
                @forelse($creator->games as $game)
                <span class="px-4 py-2 rounded-xl bg-[#0b1220] text-white border border-gray-800">
                    {{ $game->game_name }}
                </span>
                @empty
                <p class="text-gray-400">No games added yet.</p>
                @endforelse
            </div>
        </div>

        <div class="bg-[#111827] border border-gray-800 rounded-2xl p-6">
            <h2 class="text-2xl font-semibold text-white mb-5">About</h2>

            <p class="text-gray-300 leading-7">
                {{ $creator->bio ?: 'No creator bio available right now.' }}
            </p>
        </div>

    </div>

    <section class="rounded-3xl bg-gradient-to-r from-blue-500 to-purple-500 p-8 md:p-10 text-center">
        <h2 class="text-2xl md:text-3xl font-bold text-white">Want to Collaborate?</h2>
        <p class="text-white/90 mt-3 max-w-2xl mx-auto">
            Get in touch with {{ $creator->name }} for tournament coverage, creator promotions and gaming collaborations.
        </p>

        <a href="/contact"
            class="inline-flex items-center justify-center mt-6 bg-white text-blue-600 font-semibold px-6 py-3 rounded-xl hover:scale-105 transition">
            Contact Creator
        </a>
    </section>

</div>

<script>
    function formatCount(num) {
        if (num === null || num === undefined || num === '') return '--';
        num = Number(num);

        if (num >= 1000000) return (num / 1000000).toFixed(1).replace('.0', '') + 'M';
        if (num >= 1000) return (num / 1000).toFixed(1).replace('.0', '') + 'K';
        return num;
    }

    async function loadStats() {
        try {
            const response = await fetch('/creators/{{ $creator->slug }}/social-stats');
            const data = await response.json();

            document.getElementById('youtubeCount').textContent = formatCount(data.youtube);
            document.getElementById('instagramCount').textContent = formatCount(data.instagram);
            document.getElementById('discordCount').textContent = formatCount(data.discord);
        } catch (error) {
            document.getElementById('youtubeCount').textContent = '--';
            document.getElementById('instagramCount').textContent = '--';
            document.getElementById('discordCount').textContent = '--';
        }
    }

    document.addEventListener('DOMContentLoaded', loadStats);
</script>

@endsection