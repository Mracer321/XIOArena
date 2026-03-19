@extends('layouts.app')

@section('content')

<div class="mb-10">

    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-white">Creators</h1>
            <p class="text-sm text-gray-400 mt-2">
                Discover gaming creators for tournament promotions, collaborations and content campaigns
            </p>
        </div>
    </div>

    <form method="GET" action="{{ route('creators.index') }}" class="mb-8">
        <div class="relative">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search creators by name or game..."
                class="w-full rounded-2xl bg-[#111827] border border-gray-800 px-5 py-4 pr-14 text-white placeholder:text-gray-500 outline-none focus:border-blue-500">
            <i data-lucide="search" class="w-5 h-5 text-gray-400 absolute right-5 top-1/2 -translate-y-1/2"></i>
        </div>
    </form>

    @if($featuredCreators->count())
    <div class="mb-10">
        <div class="flex items-end justify-between mb-5">
            <div>
                <h2 class="text-xl md:text-2xl font-semibold text-white">Featured Creators</h2>
                <p class="text-sm text-gray-400 mt-1">Top picked creators on XIOArena</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
            @foreach($featuredCreators as $creator)
            <a href="{{ route('creator.show', $creator->slug) }}"
                class="bg-[#111827] border border-gray-800 hover:border-blue-500/40 rounded-2xl p-5 transition block">

                <div class="flex items-start gap-4">
                    <img
                        src="{{ $creator->profile_image ? asset('storage/' . $creator->profile_image) : 'https://picsum.photos/200' }}"
                        class="w-16 h-16 rounded-full object-cover shrink-0">

                    <div class="min-w-0 flex-1">
                        <h3 class="text-2xl font-semibold text-white truncate">{{ $creator->name }}</h3>
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
            @endforeach
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        @forelse($creators as $creator)
        <a href="{{ route('creator.show', $creator->slug) }}"
            class="bg-[#111827] border border-gray-800 hover:border-blue-500/40 rounded-2xl p-5 transition block">

            <div class="flex items-start gap-4">
                <img
                    src="{{ $creator->profile_image ? asset('storage/' . $creator->profile_image) : 'https://picsum.photos/200' }}"
                    class="w-16 h-16 rounded-full object-cover shrink-0">

                <div class="min-w-0 flex-1">
                    <h3 class="text-xl font-semibold text-white truncate">{{ $creator->name }}</h3>
                    <p class="text-sm text-gray-400 mt-1">
                        {{ $creator->games->pluck('game_name')->implode(', ') ?: 'Gaming Creator' }}
                    </p>
                </div>
            </div>

            <div class="mt-6 space-y-3 text-sm">
                <div class="flex items-center justify-between text-gray-300">
                    <span class="flex items-center gap-2">
                        <i data-lucide="youtube" class="w-4 h-4"></i>
                        Subscribers
                    </span>
                    <span class="font-semibold text-white creator-youtube-count" data-slug="{{ $creator->slug }}">--</span>
                </div>

                <div class="flex items-center justify-between text-gray-300">
                    <span class="flex items-center gap-2">
                        <i data-lucide="users" class="w-4 h-4"></i>
                        Followers
                    </span>
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
        <div class="col-span-full text-center py-16 bg-[#111827] border border-gray-800 rounded-2xl">
            <h3 class="text-lg font-semibold text-white">No creators found</h3>
            <p class="text-sm text-gray-400 mt-2">Try another name or game keyword.</p>
        </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $creators->links() }}
    </div>

</div>

<script>
    function formatCount(num) {
        if (num === null || num === undefined || num === '') return '--';
        num = Number(num);

        if (num >= 1000000) return (num / 1000000).toFixed(1).replace('.0', '') + 'M';
        if (num >= 1000) return (num / 1000).toFixed(1).replace('.0', '') + 'K';
        return num;
    }

    async function loadCreatorStats(slug) {
        try {
            const response = await fetch(`/creators/${slug}/social-stats`);
            const data = await response.json();

            document.querySelectorAll(`.creator-youtube-count[data-slug="${slug}"]`).forEach(el => {
                el.textContent = formatCount(data.youtube);
            });

            document.querySelectorAll(`.creator-instagram-count[data-slug="${slug}"]`).forEach(el => {
                el.textContent = formatCount(data.instagram);
            });
        } catch (error) {
            document.querySelectorAll(`.creator-youtube-count[data-slug="${slug}"]`).forEach(el => {
                el.textContent = '--';
            });

            document.querySelectorAll(`.creator-instagram-count[data-slug="${slug}"]`).forEach(el => {
                el.textContent = '--';
            });
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const slugs = [...new Set(
            Array.from(document.querySelectorAll('[data-slug]')).map(el => el.dataset.slug)
        )];

        slugs.forEach(slug => loadCreatorStats(slug));
    });
</script>

@endsection