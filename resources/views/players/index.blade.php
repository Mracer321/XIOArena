@extends('layouts.app')

@section('content')

<h1 class="text-xl font-bold mb-6">
    Player Finder
</h1>

<!-- Search -->
<div class="mb-6">
    <input type="text"
        placeholder="Search player name..."
        class="w-full bg-[#111827] border border-gray-700 rounded-lg px-4 py-2 text-sm">
</div>

<!-- Filters -->
<div class="grid grid-cols-2 gap-4 mb-6 text-sm">

    <select class="bg-[#111827] border border-gray-700 rounded px-3 py-2">
        <option>Role</option>
        <option>IGL</option>
        <option>Assaulter</option>
        <option>Sniper</option>
        <option>Support</option>
    </select>

    <select class="bg-[#111827] border border-gray-700 rounded px-3 py-2">
        <option>Rating</option>
        <option>8+ Rating</option>
        <option>7+ Rating</option>
        <option>6+ Rating</option>
    </select>

</div>

<!-- Player Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    @for($i = 0; $i < 8; $i++)
        <div class="bg-[#111827] rounded-xl p-4">
        <a href="{{ url('/player/test-player') }}">
            Player Card
        </a>
</div>
@endfor

</div>

@endsection