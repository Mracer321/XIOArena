@extends('admin.layouts.app')

@section('content')

<div class="max-w-6xl mx-auto">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
        <div>
            <h2 class="text-xl md:text-2xl font-semibold">Edit Creator</h2>
            <p class="text-sm text-gray-400 mt-1">Update creator profile details.</p>
        </div>

        <a href="/admin/creators"
            class="inline-flex items-center justify-center px-4 py-2 rounded-xl bg-[#111827] border border-gray-800 hover:bg-[#1f2937] text-sm">
            Back to Creators
        </a>
    </div>

    @if ($errors->any())
    <div class="mb-6 rounded-2xl border border-red-500/20 bg-red-500/10 p-4 md:p-5">
        <div class="flex items-start gap-3">
            <div class="shrink-0 mt-0.5">
                <i data-lucide="alert-circle" class="w-5 h-5 text-red-400"></i>
            </div>

            <div>
                <p class="text-sm font-medium text-red-400">Please fix the following errors:</p>
                <ul class="mt-2 space-y-1 text-sm text-red-300">
                    @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif

    <div class="bg-[#111827] border border-gray-800 rounded-2xl overflow-hidden">
        <div class="px-4 md:px-6 py-4 border-b border-gray-800">
            <h3 class="text-base md:text-lg font-semibold">Creator Details</h3>
            <p class="text-sm text-gray-400 mt-1">Edit the information below.</p>
        </div>

        <form action="/admin/creators/{{ $creator->id }}/update" method="POST" enctype="multipart/form-data" class="p-4 md:p-6">
            @csrf

            @include('admin.creators.form', ['creator' => $creator])

            <div class="mt-8 flex flex-col sm:flex-row gap-3 sm:justify-end">
                <a href="/admin/creators"
                    class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-3 rounded-xl border border-gray-700 bg-[#0b1220] hover:bg-[#111827] text-sm font-medium">
                    Cancel
                </a>

                <button type="submit"
                    class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-sm font-medium">
                    Update Creator
                </button>
            </div>
        </form>
    </div>

</div>

@endsection