@extends('admin.layouts.app')

@section('content')

<div class="flex items-center justify-between mb-6">

    <h2 class="text-2xl font-semibold text-white">
        Manage Organizations
    </h2>

    <a href="/admin/orgs/create"
        class="bg-indigo-600 hover:bg-indigo-700 
              text-white text-sm font-medium 
              px-4 py-2 rounded-lg 
              shadow-md transition duration-200">
        + Create Organization
    </a>

</div>

<div class="bg-[#111827] p-6 rounded-xl overflow-x-auto">

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
            <tr class="border-b border-gray-800">
                <td class="py-3">{{ $org->name }}</td>
                <td class="py-3 flex items-center gap-3">
                    @if($org->logo)
                    <img src="{{ asset('storage/'.$org->logo) }}"
                        class="w-10 h-10 rounded-full object-cover">
                    @endif
                </td>
                <td class="py-3 capitalize">{{ $org->membership }}</td>
                <td class="py-3 capitalize">{{ $org->trust_status }}</td>
                <td class="py-3 flex gap-3 text-xs">

                    <form method="POST" action="/admin/orgs/{{ $org->id }}/membership">
                        @csrf

                        @if($org->membership === 'verified')
                        <input type="hidden" name="membership" value="free">
                        <button class="text-yellow-400">Make Free</button>
                        @else
                        <input type="hidden" name="membership" value="verified">
                        <button class="text-blue-400">Make Verified</button>
                        @endif

                    </form>

                    <form method="POST" action="/admin/orgs/{{ $org->id }}/trust">
                        @csrf

                        @if($org->trust_status === 'trusted')
                        <input type="hidden" name="trust_status" value="new">
                        <button class="text-purple-400">Make Untrusted</button>
                        @else
                        <input type="hidden" name="trust_status" value="trusted">
                        <button class="text-green-400">Make Trusted</button>
                        @endif

                    </form>

                    @if($org->trust_status != 'banned')
                    <form method="POST" action="/admin/orgs/{{ $org->id }}/ban">
                        @csrf
                        <button class="text-red-400">Ban</button>
                    </form>
                    @endif

                </td>
            </tr>
            @endforeach

        </tbody>

    </table>

</div>

@endsection