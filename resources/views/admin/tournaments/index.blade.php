@extends('admin.layouts.app')

@section('content')

<div class="flex items-center justify-between mb-6">

    <h2 class="text-2xl font-semibold text-white">
        Manage Tournaments
    </h2>

    <a href="/admin/tournaments/create"
        class="bg-indigo-600 hover:bg-indigo-700 
              text-white text-sm font-medium 
              px-4 py-2 rounded-lg 
              shadow-md transition duration-200">
        + Create Tournament
    </a>

</div>

<div class="bg-[#111827] rounded-xl p-6 overflow-x-auto">

    @if(session('success'))
    <div class="bg-green-600 p-3 rounded mb-4 text-sm">
        {{ session('success') }}
    </div>
    @endif

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

            <tr class="border-b border-gray-800">

                <!-- Poster -->
                <td class="py-3">
                    @if($tournament->poster)
                    <img src="{{ asset('storage/'.$tournament->poster) }}"
                        class="w-14 h-14 rounded object-cover">
                    @else
                    <img src="https://picsum.photos/100"
                        class="w-14 h-14 rounded object-cover">
                    @endif
                </td>

                <!-- Title -->
                <td class="py-3 text-white">
                    {{ $tournament->title }}

                    @if($tournament->is_scammed)
                    <span class="ml-2 text-xs text-red-500">(SCAMMED)</span>
                    @endif

                    @if($tournament->pp_pending)
                    <span class="ml-2 text-xs text-yellow-400">(PP Pending)</span>
                    @endif
                </td>

                <!-- Organization -->
                <td class="py-3 text-gray-300">
                    {{ $tournament->organization->name ?? '-' }}
                </td>

                <!-- Type -->
                <td class="py-3">
                    <span class="text-xs px-2 py-1 rounded
                    {{ $tournament->type == 'offline' ? 'bg-blue-600' : 'bg-green-600' }}">
                        {{ ucfirst($tournament->type) }}
                    </span>
                </td>

                <!-- Featured -->
                <td class="py-3">
                    @if($tournament->is_featured)
                    <span class="text-purple-400 text-xs">Yes</span>
                    @else
                    <span class="text-gray-500 text-xs">No</span>
                    @endif
                </td>

                <!-- Visibility -->
                <td class="py-3">
                    @if($tournament->is_visible)
                    <span class="text-green-400 text-xs">Visible</span>
                    @else
                    <span class="text-red-400 text-xs">Hidden</span>
                    @endif
                </td>

                <!-- Actions -->
                <td class="py-3 flex gap-3">

                    <a href="/admin/tournaments/{{ $tournament->id }}/edit"
                        class="text-blue-400 text-xs hover:underline">
                        Edit
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