@extends('admin.layouts.app')

@section('content')

<h2 class="text-xl font-semibold mb-6">
    Create Organization
</h2>

@if(session('success'))
<div class="bg-green-600 p-3 rounded mb-4 text-sm">
    {{ session('success') }}
</div>
@endif

<form method="POST" action="/admin/orgs" enctype="multipart/form-data"
    class="bg-[#111827] p-6 rounded-xl max-w-lg">

    @csrf

    <!-- Org Name -->
    <div class="mb-4">
        <label class="text-sm block mb-2">Organization Name</label>
        <input type="text" name="name"
            class="w-full bg-[#0b0f17] border border-gray-700 rounded px-3 py-2 text-sm">
    </div>

    <!-- Logo URL (static phase) -->
    <div class="mb-4">
        <label class="text-sm block mb-2">Upload Logo</label>
        <input type="file" name="logo"
            class="w-full text-sm bg-[#0b0f17] border border-gray-700 rounded px-3 py-2">
    </div>

    <!-- Social Links -->
    <div class="mb-4">
        <input type="text" name="instagram" placeholder="Instagram URL"
            class="w-full bg-[#0b0f17] border border-gray-700 rounded px-3 py-2 text-sm mb-2">

        <input type="text" name="discord" placeholder="Discord URL"
            class="w-full bg-[#0b0f17] border border-gray-700 rounded px-3 py-2 text-sm mb-2">

        <input type="text" name="youtube" placeholder="YouTube URL"
            class="w-full bg-[#0b0f17] border border-gray-700 rounded px-3 py-2 text-sm mb-2">

        <input type="text" name="website" placeholder="Website URL"
            class="w-full bg-[#0b0f17] border border-gray-700 rounded px-3 py-2 text-sm">
    </div>

    <!-- Description -->
    <div class="mb-4">
        <label class="text-sm block mb-2">Description</label>
        <textarea name="description" rows="4"
            class="w-full bg-[#0b0f17] border border-gray-700 rounded px-3 py-2 text-sm"></textarea>

        <!-- Membership -->
        <div class="mb-4">
            <label class="text-sm block mb-2">Membership Package</label>
            <select name="membership"
                class="w-full bg-[#0b0f17] border border-gray-700 rounded px-3 py-2 text-sm">
                <option value="free">Free</option>
                <option value="verified">Verified (Paid)</option>
                <option value="premium">Premium Partner</option>
            </select>
        </div>

        <!-- Trust Status -->
        <div class="mb-6">
            <label class="text-sm block mb-2">Trust Status</label>
            <select name="trust_status"
                class="w-full bg-[#0b0f17] border border-gray-700 rounded px-3 py-2 text-sm">
                <option value="normal">Normal</option>
                <option value="trusted">Trusted (Manual)</option>
                <option value="banned">Banned</option>
            </select>
        </div>

        <button class="w-full bg-blue-600 py-2 rounded">
            Create Organization
        </button>

</form>

@endsection