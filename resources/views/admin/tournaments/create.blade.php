@extends('admin.layouts.app')

@section('content')

<h2 class="text-xl font-semibold mb-6">
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
    class="bg-[#111827] p-6 rounded-xl max-w-xl">

    @csrf

    <!-- Organization -->
    <div class="mb-4">
        <label class="text-sm block mb-2">Select Organization</label>
        <select name="organization_id"
            class="w-full bg-[#0b0f17] border border-gray-700 rounded px-3 py-2 text-sm">
            @foreach($orgs as $org)
            <option value="{{ $org->id }}">
                {{ $org->name }} ({{ $org->membership }})
            </option>
            @endforeach
        </select>
    </div>

    <!-- Title -->
    <div class="mb-4">
        <input type="text" name="title"
            placeholder="Tournament Title"
            class="w-full bg-[#0b0f17] border border-gray-700 rounded px-3 py-2 text-sm">
    </div>

    <!-- Poster -->
    <div class="mb-4">
        <label class="text-sm block mb-2">Tournament Poster</label>
        <input type="file" name="poster"
            class="w-full text-sm bg-[#0b0f17] border border-gray-700 rounded px-3 py-2">
    </div>

    <!-- Prize Pool -->
    <div class="mb-4">
        <input type="number" name="prize_pool"
            placeholder="Prize Pool"
            class="w-full bg-[#0b0f17] border border-gray-700 rounded px-3 py-2 text-sm">
    </div>

    <!-- Total Slots -->
    <div class="mb-4">
        <input type="number" name="total_slots"
            placeholder="Total Slots"
            class="w-full bg-[#0b0f17] border border-gray-700 rounded px-3 py-2 text-sm">
    </div>

    <!-- Entry Type -->
    <div class="mb-4">
        <select name="entry_type"
            class="w-full bg-[#0b0f17] border border-gray-700 rounded px-3 py-2 text-sm">
            <option value="free">Free</option>
            <option value="paid">Paid</option>
        </select>
    </div>

    <!-- Registration -->
    <div class="mb-4">
        <select name="registration_status"
            class="w-full bg-[#0b0f17] border border-gray-700 rounded px-3 py-2 text-sm">
            <option value="open">Open</option>
            <option value="closed">Closed</option>
        </select>
    </div>

    <!-- About -->
    <div class="mb-4">
        <textarea name="about"
            placeholder="About Tournament"
            rows="4"
            class="w-full bg-[#0b0f17] border border-gray-700 rounded px-3 py-2 text-sm"></textarea>
    </div>

    <!-- Additional Images -->
    <div class="mb-6">
        <label class="text-sm block mb-2">Additional Images (Roadmap, PP Structure)</label>
        <input type="file" name="additional_images[]" multiple
            class="w-full text-sm bg-[#0b0f17] border border-gray-700 rounded px-3 py-2">
    </div>

    <button class="w-full bg-blue-600 py-2 rounded">
        Create Tournament
    </button>

</form>

@endsection