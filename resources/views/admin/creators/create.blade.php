@extends('admin.layouts.app')

@section('content')

<h2 class="text-xl md:text-2xl font-semibold mb-6">Add Creator</h2>

@if ($errors->any())
<div class="mb-4 rounded-lg border border-red-500/20 bg-red-500/10 text-red-400 px-4 py-3">
    <ul class="list-disc ml-5">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="/admin/creators" method="POST" enctype="multipart/form-data"
    class="bg-[#111827] border border-gray-800 rounded-2xl p-6 space-y-6">
    @csrf

    @include('admin.creators.form')

    <button type="submit"
        class="px-5 py-3 bg-blue-600 hover:bg-blue-700 rounded-xl font-medium">
        Save Creator
    </button>
</form>

@endsection