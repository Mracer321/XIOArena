@php
$creator = $creator ?? null;
$games = old('games', $creator ? $creator->games->pluck('game_name')->toArray() : ['']);
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-6">

    <!-- Creator Name -->
    <div>
        <label class="block text-sm font-medium text-gray-300 mb-2">Creator Name</label>
        <input
            type="text"
            name="name"
            value="{{ old('name', $creator->name ?? '') }}"
            placeholder="Enter creator name"
            class="w-full rounded-xl border border-gray-700 bg-[#0b1220] px-4 py-3 text-white placeholder:text-gray-500 outline-none focus:border-blue-500"
            required>
    </div>

    <!-- Profile Image -->
    <div>
        <label class="block text-sm font-medium text-gray-300 mb-2">Profile Image</label>
        <input
            type="file"
            name="profile_image"
            accept="image/*"
            class="w-full rounded-xl border border-gray-700 bg-[#0b1220] px-4 py-3 text-sm text-gray-300 file:mr-4 file:rounded-lg file:border-0 file:bg-blue-600 file:px-4 file:py-2 file:text-white hover:file:bg-blue-700">

        @if(!empty($creator?->profile_image))
        <div class="mt-3">
            <img src="{{ asset('storage/' . $creator->profile_image) }}"
                class="w-16 h-16 rounded-full object-cover border border-gray-700">
        </div>
        @endif
    </div>

    <!-- Bio -->
    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-300 mb-2">Bio</label>
        <textarea
            name="bio"
            rows="4"
            placeholder="Write creator bio..."
            class="w-full rounded-xl border border-gray-700 bg-[#0b1220] px-4 py-3 text-white placeholder:text-gray-500 outline-none focus:border-blue-500 resize-y">{{ old('bio', $creator->bio ?? '') }}</textarea>
    </div>

    <!-- YouTube -->
    <div>
        <label class="block text-sm font-medium text-gray-300 mb-2">YouTube URL</label>
        <input
            type="url"
            name="youtube"
            value="{{ old('youtube', $creator->youtube ?? '') }}"
            placeholder="https://youtube.com/@channel"
            class="w-full rounded-xl border border-gray-700 bg-[#0b1220] px-4 py-3 text-white placeholder:text-gray-500 outline-none focus:border-blue-500">
    </div>

    <!-- Instagram -->
    <div>
        <label class="block text-sm font-medium text-gray-300 mb-2">Instagram URL</label>
        <input
            type="url"
            name="instagram"
            value="{{ old('instagram', $creator->instagram ?? '') }}"
            placeholder="https://instagram.com/username"
            class="w-full rounded-xl border border-gray-700 bg-[#0b1220] px-4 py-3 text-white placeholder:text-gray-500 outline-none focus:border-blue-500">
    </div>

    <!-- Discord -->
    <div>
        <label class="block text-sm font-medium text-gray-300 mb-2">Discord URL</label>
        <input
            type="url"
            name="discord"
            value="{{ old('discord', $creator->discord ?? '') }}"
            placeholder="https://discord.gg/xxxx"
            class="w-full rounded-xl border border-gray-700 bg-[#0b1220] px-4 py-3 text-white placeholder:text-gray-500 outline-none focus:border-blue-500">
    </div>

    <!-- Email -->
    <div>
        <label class="block text-sm font-medium text-gray-300 mb-2">Email</label>
        <input
            type="email"
            name="contact_email"
            value="{{ old('contact_email', $creator->contact_email ?? '') }}"
            placeholder="Enter email"
            class="w-full rounded-xl border border-gray-700 bg-[#0b1220] px-4 py-3 text-white placeholder:text-gray-500 outline-none focus:border-blue-500">
    </div>

    <!-- Phone -->
    <div>
        <label class="block text-sm font-medium text-gray-300 mb-2">Phone</label>
        <input
            type="text"
            name="contact_phone"
            value="{{ old('contact_phone', $creator->contact_phone ?? '') }}"
            placeholder="Enter phone number"
            class="w-full rounded-xl border border-gray-700 bg-[#0b1220] px-4 py-3 text-white placeholder:text-gray-500 outline-none focus:border-blue-500">
    </div>

    <!-- Games -->
    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-300 mb-2">Games</label>

        <div id="games-wrapper" class="space-y-3">
            @foreach($games as $index => $game)
            <div class="flex flex-col sm:flex-row gap-3">
                <input
                    type="text"
                    name="games[]"
                    value="{{ $game }}"
                    placeholder="Enter game name"
                    class="flex-1 rounded-xl border border-gray-700 bg-[#0b1220] px-4 py-3 text-white placeholder:text-gray-500 outline-none focus:border-blue-500">

                <button
                    type="button"
                    class="remove-game px-4 py-3 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 hover:bg-red-500/20 sm:w-auto w-full">
                    Remove
                </button>
            </div>
            @endforeach
        </div>

        <button
            type="button"
            id="add-game"
            class="mt-4 inline-flex items-center justify-center rounded-xl bg-[#1f2937] hover:bg-[#374151] px-4 py-3 text-sm font-medium text-white border border-gray-700">
            Add Game
        </button>
    </div>

    <!-- Toggles -->
    <div class="md:col-span-2">
        <div class="flex flex-col sm:flex-row gap-4 sm:gap-6 pt-2">
            <label class="inline-flex items-center gap-3 text-sm text-gray-300">
                <input
                    type="checkbox"
                    name="is_featured"
                    value="1"
                    {{ old('is_featured', $creator->is_featured ?? false) ? 'checked' : '' }}
                    class="rounded border-gray-600 bg-[#0b1220] text-blue-600 focus:ring-blue-500">
                <span>Featured</span>
            </label>

            <label class="inline-flex items-center gap-3 text-sm text-gray-300">
                <input
                    type="checkbox"
                    name="is_active"
                    value="1"
                    {{ old('is_active', $creator->is_active ?? true) ? 'checked' : '' }}
                    class="rounded border-gray-600 bg-[#0b1220] text-blue-600 focus:ring-blue-500">
                <span>Active</span>
            </label>
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const wrapper = document.getElementById('games-wrapper');
        const addBtn = document.getElementById('add-game');

        if (addBtn) {
            addBtn.addEventListener('click', function() {
                const row = document.createElement('div');
                row.className = 'flex flex-col sm:flex-row gap-3';
                row.innerHTML = `
                <input
                    type="text"
                    name="games[]"
                    placeholder="Enter game name"
                    class="flex-1 rounded-xl border border-gray-700 bg-[#0b1220] px-4 py-3 text-white placeholder:text-gray-500 outline-none focus:border-blue-500"
                >
                <button
                    type="button"
                    class="remove-game px-4 py-3 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 hover:bg-red-500/20 sm:w-auto w-full">
                    Remove
                </button>
            `;
                wrapper.appendChild(row);
            });
        }

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-game')) {
                e.target.closest('div.flex').remove();
            }
        });
    });
</script>