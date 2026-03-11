@extends('admin.layouts.app')

@section('content')

<h2 class="text-xl font-semibold mb-6">
    Edit Tournament
</h2>

<form method="POST"
    action="/admin/tournaments/{{ $tournament->id }}/update"
    class="bg-[#111827] p-6 rounded-xl max-w-lg">

    @csrf

    <!-- Tournament Type -->
    <div class="mb-4">
        <label class="block text-sm mb-2">Tournament Type</label>
        <select name="type"
            class="w-full bg-[#0b0f17] border border-gray-700 rounded px-3 py-2 text-sm">
            <option value="online" {{ $tournament->type == 'online' ? 'selected' : '' }}>Online</option>
            <option value="offline" {{ $tournament->type == 'offline' ? 'selected' : '' }}>Offline (LAN)</option>
        </select>
    </div>

    <!-- Featured -->
    <div class="mb-4 flex items-center gap-2">
        <input type="checkbox" name="is_featured"
            {{ $tournament->is_featured ? 'checked' : '' }}>
        <label class="text-sm">Featured</label>
    </div>

    <!-- Featured Until -->
    <div class="mb-4">
        <label class="block text-sm mb-2">Featured Until</label>
        <input type="datetime-local" name="featured_until"
            value="{{ $tournament->featured_until }}"
            class="w-full bg-[#0b0f17] border border-gray-700 rounded px-3 py-2 text-sm">
    </div>

    <!-- Priority -->
    <div class="mb-4">
        <label class="block text-sm mb-2">Priority</label>
        <input type="number" name="priority"
            value="{{ $tournament->priority }}"
            class="w-full bg-[#0b0f17] border border-gray-700 rounded px-3 py-2 text-sm">
    </div>

    <!-- Visibility -->
    <div class="mb-4 flex items-center gap-2">
        <input type="checkbox" name="is_visible"
            {{ $tournament->is_visible ? 'checked' : '' }}>
        <label class="text-sm">Visible</label>
    </div>

    <!-- Scammed -->
    <div class="mb-4 flex items-center gap-2">
        <input type="checkbox" name="is_scammed"
            {{ $tournament->is_scammed ? 'checked' : '' }}>
        <label class="text-sm text-red-400">Mark as Scammed</label>
    </div>

    <!-- PP Pending -->
    <div class="mb-6 flex items-center gap-2">
        <input type="checkbox" name="pp_pending"
            {{ $tournament->pp_pending ? 'checked' : '' }}>
        <label class="text-sm text-yellow-400">PP Pending</label>
    </div>

    <button class="w-full bg-blue-600 py-2 rounded">
        Update Tournament
    </button>

</form>

@endsection