@extends('admin.layouts.app')

@section('content')

<div class="flex items-center justify-between mb-6">
    <h2 class="text-xl md:text-2xl font-semibold">Creators</h2>

    <a href="/admin/creators/create"
        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg text-sm font-medium">
        Add Creator
    </a>
</div>

@if(session('success'))
<div class="mb-4 rounded-lg border border-green-500/20 bg-green-500/10 text-green-400 px-4 py-3">
    {{ session('success') }}
</div>
@endif

<form method="GET" action="/admin/creators" class="mb-6">
    <div class="flex gap-3">
        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Search creators..."
            class="w-full bg-[#111827] border border-gray-800 rounded-xl px-4 py-3 outline-none focus:border-blue-500">
        <button class="px-5 py-3 bg-[#1d4ed8] rounded-xl hover:bg-blue-700">
            Search
        </button>
    </div>
</form>

<div class="bg-[#111827] border border-gray-800 rounded-2xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-[#0f172a] text-gray-400">
                <tr>
                    <th class="text-left px-4 py-3">Image</th>
                    <th class="text-left px-4 py-3">Name</th>
                    <th class="text-left px-4 py-3">Games</th>
                    <th class="text-left px-4 py-3">Featured</th>
                    <th class="text-left px-4 py-3">Status</th>
                    <th class="text-left px-4 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($creators as $creator)
                <tr class="border-t border-gray-800">
                    <td class="px-4 py-4">
                        @if($creator->profile_image)
                        <img src="{{ asset('storage/' . $creator->profile_image) }}"
                            class="w-14 h-14 rounded-full object-cover">
                        @else
                        <div class="w-14 h-14 rounded-full bg-gray-800"></div>
                        @endif
                    </td>

                    <td class="px-4 py-4">
                        <p class="font-semibold">{{ $creator->name }}</p>
                        <p class="text-gray-400 text-xs">{{ $creator->slug }}</p>
                    </td>

                    <td class="px-4 py-4 text-gray-300">
                        {{ $creator->games->pluck('game_name')->implode(', ') ?: '—' }}
                    </td>

                    <td class="px-4 py-4">
                        @if($creator->is_featured)
                        <span class="px-2 py-1 text-xs rounded-lg bg-blue-500/20 text-blue-400">Featured</span>
                        @else
                        <span class="px-2 py-1 text-xs rounded-lg bg-gray-700 text-gray-300">No</span>
                        @endif
                    </td>

                    <td class="px-4 py-4">
                        @if($creator->is_active)
                        <span class="px-2 py-1 text-xs rounded-lg bg-green-500/20 text-green-400">Active</span>
                        @else
                        <span class="px-2 py-1 text-xs rounded-lg bg-red-500/20 text-red-400">Inactive</span>
                        @endif
                    </td>

                    <td class="px-4 py-4">
                        <div class="flex flex-wrap gap-2">
                            <a href="/admin/creators/{{ $creator->id }}"
                                class="px-3 py-2 rounded-lg bg-gray-800 hover:bg-gray-700 text-xs">View</a>

                            <a href="/admin/creators/{{ $creator->id }}/edit"
                                class="px-3 py-2 rounded-lg bg-yellow-500/20 hover:bg-yellow-500/30 text-yellow-400 text-xs">Edit</a>

                            <form method="POST" action="/admin/creators/{{ $creator->id }}/delete"
                                onsubmit="return confirm('Delete this creator?')">
                                @csrf
                                <button class="px-3 py-2 rounded-lg bg-red-500/20 hover:bg-red-500/30 text-red-400 text-xs">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-6 text-center text-gray-400">
                        No creators found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">
    {{ $creators->links() }}
</div>

@endsection