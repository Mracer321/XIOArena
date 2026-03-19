@extends('layouts.app')

@section('content')

<div class="mb-10">

    <div class="mb-6">
        <h1 class="text-2xl md:text-3xl font-bold text-white">Creators</h1>
        <p class="text-sm text-gray-400 mt-2">
            Explore gaming creators for tournament promotions, collaborations and brand campaigns
        </p>
    </div>

    <!-- Search -->
    <form method="GET" action="{{ route('creators.index') }}" class="mb-6">
        <div class="relative">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search creators by name or game..."
                class="w-full rounded-2xl bg-[#111827] border border-gray-800 px-5 py-4 pr-14 text-white placeholder:text-gray-500 outline-none focus:border-blue-500">
            <i data-lucide="search" class="w-5 h-5 text-gray-400 absolute right-5 top-1/2 -translate-y-1/2"></i>
        </div>

        @if(request('game'))
        <input type="hidden" name="game" value="{{ request('game') }}">
        @endif
    </form>

    <!-- Filters -->
    <div class="flex gap-3 overflow-x-auto pb-2 mb-8">
        <a href="{{ route('creators.index', ['search' => request('search'), 'game' => 'all']) }}"
            class="whitespace-nowrap px-5 py-3 rounded-full text-sm transition
            {{ (!request('game') || request('game') == 'all') ? 'bg-white text-black' : 'bg-[#111827] text-white hover:bg-[#1f2937]' }}">
            All ({{ $gameCounts['all'] }})
        </a>

        <a href="{{ route('creators.index', ['search' => request('search'), 'game' => 'BGMI']) }}"
            class="whitespace-nowrap px-5 py-3 rounded-full text-sm transition
            {{ request('game') == 'BGMI' ? 'bg-white text-black' : 'bg-[#111827] text-white hover:bg-[#1f2937]' }}">
            BGMI ({{ $gameCounts['BGMI'] }})
        </a>

        <a href="{{ route('creators.index', ['search' => request('search'), 'game' => 'Free Fire']) }}"
            class="whitespace-nowrap px-5 py-3 rounded-full text-sm transition
            {{ request('game') == 'Free Fire' ? 'bg-white text-black' : 'bg-[#111827] text-white hover:bg-[#1f2937]' }}">
            Free Fire ({{ $gameCounts['Free Fire'] }})
        </a>

        <a href="{{ route('creators.index', ['search' => request('search'), 'game' => 'Valorant']) }}"
            class="whitespace-nowrap px-5 py-3 rounded-full text-sm transition
            {{ request('game') == 'Valorant' ? 'bg-white text-black' : 'bg-[#111827] text-white hover:bg-[#1f2937]' }}">
            Valorant ({{ $gameCounts['Valorant'] }})
        </a>

        <a href="{{ route('creators.index', ['search' => request('search'), 'game' => 'Call of Duty']) }}"
            class="whitespace-nowrap px-5 py-3 rounded-full text-sm transition
            {{ request('game') == 'Call of Duty' ? 'bg-white text-black' : 'bg-[#111827] text-white hover:bg-[#1f2937]' }}">
            Call of Duty ({{ $gameCounts['Call of Duty'] }})
        </a>

        <a href="{{ route('creators.index', ['search' => request('search'), 'game' => 'others']) }}"
            class="whitespace-nowrap px-5 py-3 rounded-full text-sm transition
            {{ request('game') == 'others' ? 'bg-white text-black' : 'bg-[#111827] text-white hover:bg-[#1f2937]' }}">
            Others ({{ $gameCounts['others'] }})
        </a>
    </div>

    <!-- Featured Creators -->
    @if($featuredCreators->count() && (!request('search') && (!request('game') || request('game') == 'all')))
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

    <!-- Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
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
                    <span>Subscribers</span>
                    <span class="font-semibold text-white creator-youtube-count" data-slug="{{ $creator->slug }}">--</span>
                </div>

                <div class="flex items-center justify-between text-gray-300">
                    <span>Followers</span>
                    <span class="font-semibold text-white creator-instagram-count" data-slug="{{ $creator->slug }}">--</span>
                </div>
            </div>

            <div class="mt-6">
                <span class="block w-full text-center bg-[#1e293b] hover:bg-blue-500 px-4 py-3 rounded-xl font-semibold transition">
                    View Profile
                </span>
            </div>
        </a>
        @empty
        <div class="col-span-full text-center py-16 bg-[#111827] border border-gray-800 rounded-2xl">
            <h3 class="text-lg font-semibold text-white">No creators found</h3>
            <p class="text-sm text-gray-400 mt-2">Try another name or game filter.</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($creators->hasPages())
    <div class="mt-8">
        {{ $creators->links() }}
    </div>
    @endif

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