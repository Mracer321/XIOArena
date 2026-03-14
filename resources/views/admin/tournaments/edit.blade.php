@extends('admin.layouts.app')

@section('content')

<h2 class="text-xl md:text-2xl font-semibold mb-6">
    Edit Tournament
</h2>

<form method="POST"
    action="/admin/tournaments/{{ $tournament->id }}/update"
    class="bg-[#111827] p-5 md:p-8 rounded-xl max-w-2xl">

    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        <!-- Tournament Type -->
        <div class="md:col-span-2">
            <label class="flex items-center gap-2 text-sm mb-2 text-gray-300">
                <i data-lucide="trophy" class="w-4 h-4"></i>
                Tournament Type
            </label>

            <select name="type"
                class="w-full bg-[#0b0f17] border border-gray-700 rounded-lg px-3 py-2 text-sm focus:border-indigo-500">

                <option value="online" {{ $tournament->type == 'online' ? 'selected' : '' }}>
                    Online
                </option>

                <option value="offline" {{ $tournament->type == 'offline' ? 'selected' : '' }}>
                    Offline (LAN)
                </option>

            </select>
        </div>


        <!-- Featured Toggle -->
        <div class="flex items-center gap-3 bg-[#0b0f17] p-3 rounded-lg border border-gray-700">

            <input type="checkbox"
                name="is_featured"
                class="w-4 h-4"
                {{ $tournament->is_featured ? 'checked' : '' }}>

            <label class="flex items-center gap-2 text-sm text-gray-300">
                <i data-lucide="star" class="w-4 h-4"></i>
                Featured Tournament
            </label>

        </div>


        <!-- Visible Toggle -->
        <div class="flex items-center gap-3 bg-[#0b0f17] p-3 rounded-lg border border-gray-700">

            <input type="checkbox"
                name="is_visible"
                class="w-4 h-4"
                {{ $tournament->is_visible ? 'checked' : '' }}>

            <label class="flex items-center gap-2 text-sm text-gray-300">
                <i data-lucide="eye" class="w-4 h-4"></i>
                Visible
            </label>

        </div>


        <!-- Featured Until -->
        <div>
            <label class="flex items-center gap-2 text-sm mb-2 text-gray-300">
                <i data-lucide="calendar" class="w-4 h-4"></i>
                Featured Until
            </label>

            <input type="datetime-local"
                name="featured_until"
                value="{{ $tournament->featured_until }}"
                class="w-full bg-[#0b0f17] border border-gray-700 rounded-lg px-3 py-2 text-sm focus:border-indigo-500">
        </div>


        <!-- Priority -->
        <div>
            <label class="flex items-center gap-2 text-sm mb-2 text-gray-300">
                <i data-lucide="arrow-up" class="w-4 h-4"></i>
                Priority
            </label>

            <input type="number"
                name="priority"
                value="{{ $tournament->priority }}"
                class="w-full bg-[#0b0f17] border border-gray-700 rounded-lg px-3 py-2 text-sm focus:border-indigo-500">
        </div>


        <!-- Scammed -->
        <div class="flex items-center gap-3 bg-[#0b0f17] p-3 rounded-lg border border-red-700">

            <input type="checkbox"
                name="is_scammed"
                class="w-4 h-4"
                {{ $tournament->is_scammed ? 'checked' : '' }}>

            <label class="flex items-center gap-2 text-sm text-red-400">
                <i data-lucide="alert-triangle" class="w-4 h-4"></i>
                Mark as Scammed
            </label>

        </div>


        <!-- PP Pending -->
        <div class="flex items-center gap-3 bg-[#0b0f17] p-3 rounded-lg border border-yellow-700">

            <input type="checkbox"
                name="pp_pending"
                class="w-4 h-4"
                {{ $tournament->pp_pending ? 'checked' : '' }}>

            <label class="flex items-center gap-2 text-sm text-yellow-400">
                <i data-lucide="clock" class="w-4 h-4"></i>
                PP Pending
            </label>

        </div>

    </div>


    <!-- Submit Button -->

    <button
        class="mt-6 w-full md:w-auto px-6 py-2 bg-indigo-600 hover:bg-indigo-700 rounded-lg text-sm font-medium">

        Update Tournament

    </button>

</form>

@endsection