@extends('admin.layouts.app')

@section('content')

<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

    <h2 class="text-xl md:text-2xl font-semibold text-white">
        Manage Organizations
    </h2>

    <a href="/admin/orgs/create"
        class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded-lg shadow-md transition">
        Create Organization
    </a>

</div>



<!-- ================= MOBILE VIEW ================= -->

<div class="space-y-4 lg:hidden">

    @foreach($orgs as $org)

    <div class="bg-[#111827] p-5 rounded-xl">

        <div class="flex items-center gap-3">

            @if($org->logo)
            <img src="{{ asset('storage/'.$org->logo) }}"
                class="w-11 h-11 rounded-full object-cover">
            @endif

            <div>

                <p class="text-white font-semibold">
                    {{ $org->name }}
                </p>

                <div class="flex gap-2 mt-1">

                    <span class="text-xs px-2 py-0.5 rounded
@if($org->membership == 'verified') bg-blue-600
@else bg-gray-600
@endif">

                        {{ ucfirst($org->membership) }}

                    </span>

                    <span class="text-xs px-2 py-0.5 rounded
@if($org->trust_status == 'trusted') bg-green-600
@elseif($org->trust_status == 'banned') bg-red-600
@else bg-gray-600
@endif">

                        {{ ucfirst($org->trust_status) }}

                    </span>

                </div>

            </div>

        </div>


        <!-- ACTION BUTTONS -->

        <div class="mt-4 grid grid-cols-3 gap-3">

            <form method="POST" action="/admin/orgs/{{ $org->id }}/membership">
                @csrf

                @if($org->membership === 'verified')

                <input type="hidden" name="membership" value="free">

                <button class="w-full bg-yellow-500 hover:bg-yellow-600 text-black text-sm py-2 rounded-md">
                    Free
                </button>

                @else

                <input type="hidden" name="membership" value="verified">

                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm py-2 rounded-md">
                    Verified
                </button>

                @endif

            </form>


            <form method="POST" action="/admin/orgs/{{ $org->id }}/trust">
                @csrf

                @if($org->trust_status === 'trusted')

                <input type="hidden" name="trust_status" value="new">

                <button class="w-full bg-purple-600 hover:bg-purple-700 text-white text-sm py-2 rounded-md">
                    Untrust
                </button>

                @else

                <input type="hidden" name="trust_status" value="trusted">

                <button class="w-full bg-green-600 hover:bg-green-700 text-white text-sm py-2 rounded-md">
                    Trust
                </button>

                @endif

            </form>


            @if($org->trust_status != 'banned')

            <form method="POST" action="/admin/orgs/{{ $org->id }}/ban">
                @csrf

                <button class="w-full bg-red-600 hover:bg-red-700 text-white text-sm py-2 rounded-md">
                    Ban
                </button>

            </form>

            @endif

        </div>

    </div>

    @endforeach

</div>



<!-- ================= DESKTOP TABLE ================= -->

<div class="hidden lg:block bg-[#111827] p-6 rounded-xl overflow-x-auto">

    <table class="w-full text-sm">

        <thead>
            <tr class="text-left text-gray-400 border-b border-gray-700">
                <th class="pb-3">Org Name</th>
                <th class="pb-3">Logo</th>
                <th class="pb-3">Membership</th>
                <th class="pb-3">Trust</th>
                <th class="pb-3">Action</th>
            </tr>
        </thead>

        <tbody>

            @foreach($orgs as $org)

            <tr class="border-b border-gray-800 hover:bg-[#1f2937]">

                <td class="py-3 text-white">
                    {{ $org->name }}
                </td>

                <td class="py-3">

                    @if($org->logo)
                    <img src="{{ asset('storage/'.$org->logo) }}"
                        class="w-10 h-10 rounded-full object-cover">
                    @endif

                </td>

                <td class="py-3">

                    <span class="text-xs px-2 py-1 rounded
@if($org->membership == 'verified') bg-blue-600
@else bg-gray-600
@endif">

                        {{ ucfirst($org->membership) }}

                    </span>

                </td>

                <td class="py-3">

                    <span class="text-xs px-2 py-1 rounded
@if($org->trust_status == 'trusted') bg-green-600
@elseif($org->trust_status == 'banned') bg-red-600
@else bg-gray-600
@endif">

                        {{ ucfirst($org->trust_status) }}

                    </span>

                </td>

                <td class="py-3 flex gap-2 text-xs">

                    <form method="POST" action="/admin/orgs/{{ $org->id }}/membership">
                        @csrf

                        @if($org->membership === 'verified')

                        <input type="hidden" name="membership" value="free">

                        <button class="bg-yellow-500 hover:bg-yellow-600 text-black px-3 py-1 rounded">
                            Free
                        </button>

                        @else

                        <input type="hidden" name="membership" value="verified">

                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">
                            Verified
                        </button>

                        @endif

                    </form>


                    <form method="POST" action="/admin/orgs/{{ $org->id }}/trust">
                        @csrf

                        @if($org->trust_status === 'trusted')

                        <input type="hidden" name="trust_status" value="new">

                        <button class="bg-purple-600 hover:bg-purple-700 text-white px-3 py-1 rounded">
                            Untrust
                        </button>

                        @else

                        <input type="hidden" name="trust_status" value="trusted">

                        <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">
                            Trust
                        </button>

                        @endif

                    </form>


                    @if($org->trust_status != 'banned')

                    <form method="POST" action="/admin/orgs/{{ $org->id }}/ban">
                        @csrf

                        <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                            Ban
                        </button>

                    </form>

                    @endif

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>

@endsection