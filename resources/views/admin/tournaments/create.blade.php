@extends('admin.layouts.app')

@section('content')

<h2 class="text-xl md:text-2xl font-semibold mb-6">
    Create Tournament
</h2>

@if(session('error'))
<div class="bg-red-600 p-3 rounded mb-4 text-sm">
    {{ session('error') }}
</div>
@endif

<form method="POST"
    action="/admin/tournaments"
    enctype="multipart/form-data"
    class="bg-[#111827] p-5 md:p-8 rounded-xl max-w-3xl">

    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        <!-- Organization -->
        <div class="md:col-span-2">
            <label class="text-sm mb-2 flex items-center gap-2 text-gray-300">
                <i data-lucide="building-2" class="w-4 h-4"></i>
                Select Organization
            </label>

            <select name="organization_id"
                class="w-full bg-[#0b0f17] border border-gray-700 rounded-lg px-3 py-2 text-sm focus:border-indigo-500">

                @foreach($orgs as $org)
                <option value="{{ $org->id }}">
                    {{ $org->name }} ({{ $org->membership }})
                </option>
                @endforeach

            </select>
        </div>


        <!-- Title -->
        <div class="md:col-span-2">
            <label class="text-sm mb-2 flex items-center gap-2 text-gray-300">
                <i data-lucide="trophy" class="w-4 h-4"></i>
                Tournament Title
            </label>

            <input type="text" name="title"
                placeholder="Enter Tournament Title"
                class="w-full bg-[#0b0f17] border border-gray-700 rounded-lg px-3 py-2 text-sm focus:border-indigo-500">
        </div>


        <!-- Prize Pool -->
        <div>
            <label class="text-sm mb-2 flex items-center gap-2 text-gray-300">
                <i data-lucide="wallet" class="w-4 h-4"></i>
                Prize Pool
            </label>

            <input type="number" name="prize_pool"
                placeholder="Prize Pool"
                class="w-full bg-[#0b0f17] border border-gray-700 rounded-lg px-3 py-2 text-sm focus:border-indigo-500">
        </div>


        <!-- Total Slots -->
        <div>
            <label class="text-sm mb-2 flex items-center gap-2 text-gray-300">
                <i data-lucide="users" class="w-4 h-4"></i>
                Total Slots
            </label>

            <input type="number" name="total_slots"
                placeholder="Total Slots"
                class="w-full bg-[#0b0f17] border border-gray-700 rounded-lg px-3 py-2 text-sm focus:border-indigo-500">
        </div>


        <!-- Entry Type -->
        <div>
            <label class="text-sm mb-2 flex items-center gap-2 text-gray-300">
                <i data-lucide="ticket" class="w-4 h-4"></i>
                Entry Type
            </label>

            <select name="entry_type"
                class="w-full bg-[#0b0f17] border border-gray-700 rounded-lg px-3 py-2 text-sm focus:border-indigo-500">

                <option value="free">Free</option>
                <option value="paid">Paid</option>

            </select>
        </div>


        <!-- Registration -->
        <div>
            <label class="text-sm mb-2 flex items-center gap-2 text-gray-300">
                <i data-lucide="lock-open" class="w-4 h-4"></i>
                Registration Status
            </label>

            <select name="registration_status"
                class="w-full bg-[#0b0f17] border border-gray-700 rounded-lg px-3 py-2 text-sm focus:border-indigo-500">

                <option value="open">Open</option>
                <option value="closed">Closed</option>

            </select>
        </div>


        <!-- Poster -->
        <div class="md:col-span-2">
            <label class="text-sm mb-2 flex items-center gap-2 text-gray-300">
                <i data-lucide="image" class="w-4 h-4"></i>
                Tournament Poster
            </label>

            <input type="file" name="poster"
                class="w-full text-sm bg-[#0b0f17] border border-gray-700 rounded-lg px-3 py-2">
        </div>


        <!-- About -->
        <div class="md:col-span-2">
            <label class="text-sm mb-2 flex items-center gap-2 text-gray-300">
                <i data-lucide="file-text" class="w-4 h-4"></i>
                About Tournament
            </label>

            <textarea name="about"
                rows="4"
                placeholder="About Tournament"
                class="w-full bg-[#0b0f17] border border-gray-700 rounded-lg px-3 py-2 text-sm focus:border-indigo-500"></textarea>
        </div>


        <!-- Additional Images -->
        <div class="md:col-span-2">
            <label class="text-sm mb-2 flex items-center gap-2 text-gray-300">
                <i data-lucide="images" class="w-4 h-4"></i>
                Additional Images (Roadmap, PP Structure)
            </label>

            <input type="file" name="additional_images[]" multiple
                class="w-full text-sm bg-[#0b0f17] border border-gray-700 rounded-lg px-3 py-2">
        </div>

    </div>


    <!-- Submit -->

    <button
        class="mt-6 w-full md:w-auto px-6 py-2 bg-indigo-600 hover:bg-indigo-700 rounded-lg text-sm font-medium">

        Create Tournament

    </button>

</form>

@endsection