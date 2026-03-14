@extends('layouts.app')

@section('content')

<!-- PAGE HEADER -->
<div class="mb-6">

    <h1 class="text-2xl md:text-3xl font-bold text-white">
        All Tournaments
    </h1>

    <p class="text-gray-400 text-sm">
        Browse and join competitive tournaments
    </p>

</div>


<!-- FILTER TOGGLE -->
<div class="flex items-center justify-between mb-4">

    <p class="text-sm text-gray-400">
        Showing {{ $tournaments->total() }} tournaments
    </p>

    <button id="filterToggle"
        class="flex items-center gap-2 bg-[#111827] border border-gray-700
px-4 py-2 rounded-lg text-sm hover:bg-[#1f2937] transition">

        <i data-lucide="filter" class="w-4 h-4"></i>

        Filters

    </button>

</div>



<!-- FILTER PANEL -->
<div id="filterPanel"
    class="hidden bg-[#0f172a] border border-gray-800 rounded-2xl p-5 mb-6">

    <form method="GET" id="filterForm">

        <div class="grid md:grid-cols-3 gap-6">


            <!-- SEARCH -->
            <div>

                <label class="text-xs text-gray-400 mb-2 block">
                    Search
                </label>

                <input type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search tournaments..."
                    class="w-full bg-[#020617] border border-gray-700 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500">

            </div>



            <!-- ENTRY TYPE -->
            <div>

                <label class="text-xs text-gray-400 mb-2 block">
                    Entry Type
                </label>

                <div class="flex gap-2 flex-wrap">

                    <a href="/tournaments"
                        class="px-4 py-2 text-sm rounded-lg
{{ request('entry_type')==''?'bg-blue-600':'bg-[#1e293b]' }}">
                        All
                    </a>

                    <a href="?entry_type=free"
                        class="px-4 py-2 text-sm rounded-lg
{{ request('entry_type')=='free'?'bg-blue-600':'bg-[#1e293b]' }}">
                        Free
                    </a>

                    <a href="?entry_type=paid"
                        class="px-4 py-2 text-sm rounded-lg
{{ request('entry_type')=='paid'?'bg-blue-600':'bg-[#1e293b]' }}">
                        Paid
                    </a>

                </div>

            </div>



            <!-- TYPE -->
            <div>

                <label class="text-xs text-gray-400 mb-2 block">
                    Tournament Type
                </label>

                <div class="flex gap-2 flex-wrap">

                    <a href="/tournaments"
                        class="px-4 py-2 text-sm rounded-lg
{{ request('type')==''?'bg-blue-600':'bg-[#1e293b]' }}">
                        All
                    </a>

                    <a href="?type=online"
                        class="px-4 py-2 text-sm rounded-lg
{{ request('type')=='online'?'bg-blue-600':'bg-[#1e293b]' }}">
                        Online
                    </a>

                    <a href="?type=offline"
                        class="px-4 py-2 text-sm rounded-lg
{{ request('type')=='offline'?'bg-blue-600':'bg-[#1e293b]' }}">
                        LAN
                    </a>

                </div>

            </div>


        </div>

    </form>

</div>



<!-- TOURNAMENT GRID -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-5">

    @forelse($tournaments as $tournament)

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
        No tournaments found.
    </p>

    @endforelse

</div>



<!-- PAGINATION -->
<div class="mt-10">

    {{ $tournaments->links() }}

</div>



<!-- FILTER TOGGLE SCRIPT -->
<script>
    const toggleBtn = document.getElementById("filterToggle");
    const panel = document.getElementById("filterPanel");

    toggleBtn.addEventListener("click", () => {

        panel.classList.toggle("hidden");

    });
</script>



<!-- AUTO SEARCH -->
<script>
    let timer;

    document.querySelector("input[name='search']")
        .addEventListener("keyup", function() {

            clearTimeout(timer);

            timer = setTimeout(() => {

                document.getElementById("filterForm").submit();

            }, 600);

        });
</script>

@endsection