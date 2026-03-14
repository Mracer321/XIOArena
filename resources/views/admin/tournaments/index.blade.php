@extends('admin.layouts.app')

@section('content')

<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

    <h2 class="text-xl md:text-2xl font-semibold text-white">
        Manage Tournaments
    </h2>

    <a href="/admin/tournaments/create"
        class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 
              text-white text-sm font-medium 
              px-4 py-2 rounded-lg 
              shadow-md transition">

        <i data-lucide="plus" class="w-4 h-4"></i>
        Create Tournament

    </a>

</div>

@if(session('success'))
<div class="bg-green-600 p-3 rounded mb-4 text-sm">
    {{ session('success') }}
</div>
@endif


<!-- ================= MOBILE VIEW ================= -->

<div class="space-y-4 lg:hidden">

    @forelse($tournaments as $tournament)

    <div class="bg-[#111827] p-4 rounded-xl flex gap-4">

        <!-- Poster -->
        <div class="flex-shrink-0">

            @if($tournament->poster)
            <img src="{{ asset('storage/'.$tournament->poster) }}"
                class="w-16 h-16 rounded-lg object-cover">
            @else
            <img src="https://picsum.photos/100"
                class="w-16 h-16 rounded-lg object-cover">
            @endif

        </div>

        <!-- Info -->
        <div class="flex-1">

            <h3 class="text-white font-semibold text-sm">
                {{ $tournament->title }}
            </h3>

            <p class="text-gray-400 text-xs mt-1">
                {{ $tournament->organization->name ?? '-' }}
            </p>

            <div class="flex flex-wrap gap-2 mt-2">

                <span class="text-xs px-2 py-1 rounded
                {{ $tournament->type == 'offline' ? 'bg-blue-600' : 'bg-green-600' }}">
                    {{ ucfirst($tournament->type) }}
                </span>

                @if($tournament->is_featured)
                <span class="text-xs bg-purple-600 px-2 py-1 rounded">Featured</span>
                @endif

                @if(!$tournament->is_visible)
                <span class="text-xs bg-red-600 px-2 py-1 rounded">Hidden</span>
                @endif

            </div>

        </div>

        <!-- Actions -->
        <div class="flex items-center">

            <a href="/admin/tournaments/{{ $tournament->id }}/edit"
                class="text-blue-400 hover:text-blue-300">

                <i data-lucide="pencil" class="w-5 h-5"></i>

            </a>

        </div>

    </div>

    @empty

    <div class="text-center text-gray-500 py-10">
        No tournaments found.
    </div>

    @endforelse

</div>


<!-- ================= DESKTOP TABLE ================= -->

<div class="hidden lg:block bg-[#111827] rounded-xl p-6 overflow-x-auto">

    <table class="w-full text-sm">

        <thead>
            <tr class="text-left text-gray-400 border-b border-gray-700">
                <th class="pb-3">Poster</th>
                <th class="pb-3">Title</th>
                <th class="pb-3">Org</th>
                <th class="pb-3">Type</th>
                <th class="pb-3">Featured</th>
                <th class="pb-3">Status</th>
                <th class="pb-3">Actions</th>
            </tr>
        </thead>

        <tbody>

            @forelse($tournaments as $tournament)

            <tr class="border-b border-gray-800 hover:bg-[#1f2937]">

                <td class="py-3">

                    @if($tournament->poster)
                    <img src="{{ asset('storage/'.$tournament->poster) }}"
                        class="w-14 h-14 rounded object-cover">
                    @else
                    <img src="https://picsum.photos/100"
                        class="w-14 h-14 rounded object-cover">
                    @endif

                </td>

                <td class="py-3 text-white">

                    {{ $tournament->title }}

                    @if($tournament->is_scammed)
                    <span class="ml-2 text-xs text-red-500">(SCAMMED)</span>
                    @endif

                    @if($tournament->pp_pending)
                    <span class="ml-2 text-xs text-yellow-400">(PP Pending)</span>
                    @endif

                </td>

                <td class="py-3 text-gray-300">
                    {{ $tournament->organization->name ?? '-' }}
                </td>

                <td class="py-3">

                    <span class="text-xs px-2 py-1 rounded
{{ $tournament->type == 'offline' ? 'bg-blue-600' : 'bg-green-600' }}">

                        {{ ucfirst($tournament->type) }}

                    </span>

                </td>

                <td class="py-3">

                    @if($tournament->is_featured)
                    <span class="text-purple-400 text-xs">Yes</span>
                    @else
                    <span class="text-gray-500 text-xs">No</span>
                    @endif

                </td>

                <td class="py-3">

                    @if($tournament->is_visible)
                    <span class="text-green-400 text-xs">Visible</span>
                    @else
                    <span class="text-red-400 text-xs">Hidden</span>
                    @endif

                </td>

                <td class="py-3">

                    <a href="/admin/tournaments/{{ $tournament->id }}/edit"
                        class="text-blue-400 hover:text-blue-300">

                        <i data-lucide="pencil" class="w-4 h-4"></i>

                    </a>

                </td>

            </tr>

            @empty

            <tr>
                <td colspan="7" class="py-6 text-center text-gray-500">
                    No tournaments found.
                </td>
            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection