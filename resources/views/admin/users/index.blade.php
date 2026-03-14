@extends('admin.layouts.app')

@section('content')

<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

    <h2 class="text-xl md:text-2xl font-semibold text-white">
        Admin List
    </h2>

    <a href="/admin/users/create"
        class="bg-indigo-600 hover:bg-indigo-700 
        text-white text-sm font-medium px-4 py-2 rounded-lg shadow-md transition">

        Create Admin

    </a>

</div>


<!-- ================= MOBILE VIEW ================= -->

<div class="space-y-4 lg:hidden">

    @foreach($admins as $admin)

    <div class="bg-[#111827] p-4 rounded-xl">

        <div class="flex justify-between items-start mb-3">

            <div>
                <p class="text-white font-semibold text-sm">
                    {{ $admin->name }}
                </p>

                <p class="text-gray-400 text-xs">
                    {{ $admin->email }}
                </p>
            </div>

            <span class="text-xs px-2 py-1 rounded
        @if($admin->status == 'active') bg-green-600
        @elseif($admin->status == 'inactive') bg-yellow-600
        @else bg-red-600
        @endif">

                {{ ucfirst($admin->status) }}

            </span>

        </div>


        <!-- ACTION BUTTONS -->

        <div class="flex flex-wrap gap-2">

            <form method="POST" action="/admin/users/{{ $admin->id }}/status">
                @csrf
                <input type="hidden" name="status" value="active">

                <button class="bg-green-600 hover:bg-green-700 text-white text-xs px-3 py-1.5 rounded-md">
                    Active
                </button>
            </form>


            <form method="POST" action="/admin/users/{{ $admin->id }}/status">
                @csrf
                <input type="hidden" name="status" value="inactive">

                <button class="bg-yellow-500 hover:bg-yellow-600 text-black text-xs px-3 py-1.5 rounded-md">
                    Inactive
                </button>
            </form>


            <form method="POST" action="/admin/users/{{ $admin->id }}/status">
                @csrf
                <input type="hidden" name="status" value="banned">

                <button class="bg-red-600 hover:bg-red-700 text-white text-xs px-3 py-1.5 rounded-md">
                    Ban
                </button>
            </form>

        </div>

    </div>

    @endforeach

</div>



<!-- ================= DESKTOP TABLE ================= -->

<div class="hidden lg:block bg-[#111827] rounded-xl p-6 overflow-x-auto">

    <table class="w-full text-sm">

        <thead>
            <tr class="text-left text-gray-400 border-b border-gray-700">
                <th class="pb-3">Name</th>
                <th class="pb-3">Email</th>
                <th class="pb-3">Status</th>
                <th class="pb-3">Action</th>
            </tr>
        </thead>

        <tbody>

            @foreach($admins as $admin)

            <tr class="border-b border-gray-800 hover:bg-[#1f2937]">

                <td class="py-3 text-white">
                    {{ $admin->name }}
                </td>

                <td class="py-3 text-gray-300">
                    {{ $admin->email }}
                </td>

                <td class="py-3">

                    <span class="text-xs px-2 py-1 rounded
@if($admin->status == 'active') bg-green-600
@elseif($admin->status == 'inactive') bg-yellow-600
@else bg-red-600
@endif">

                        {{ ucfirst($admin->status) }}

                    </span>

                </td>

                <td class="py-3 flex gap-2">

                    <!-- Active -->

                    <form method="POST" action="/admin/users/{{ $admin->id }}/status">
                        @csrf
                        <input type="hidden" name="status" value="active">

                        <button
                            @if($admin->status == 'active') disabled @endif
                            class="bg-green-600 hover:bg-green-700 text-white text-xs px-3 py-1.5 rounded-md min-w-[70px]
                            @if($admin->status == 'active') opacity-40 cursor-not-allowed @endif">

                            Active

                        </button>

                    </form>
                    <!-- Inactive -->

                    <form method="POST" action="/admin/users/{{ $admin->id }}/status">
                        @csrf
                        <input type="hidden" name="status" value="inactive">

                        <button
                            @if($admin->status == 'inactive') disabled @endif
                            class="bg-yellow-500 hover:bg-yellow-600 text-black text-xs px-3 py-1.5 rounded-md min-w-[70px]
                            @if($admin->status == 'inactive') opacity-40 cursor-not-allowed @endif">

                            Inactive

                        </button>

                    </form>
                    <!-- Ban -->

                    <form method="POST" action="/admin/users/{{ $admin->id }}/status">
                        @csrf
                        <input type="hidden" name="status" value="banned">

                        <button
                            @if($admin->status == 'banned') disabled @endif
                            class="bg-red-600 hover:bg-red-700 text-white text-xs px-3 py-1.5 rounded-md min-w-[70px]
                            @if($admin->status == 'banned') opacity-40 cursor-not-allowed @endif">

                            Ban

                        </button>

                    </form>


                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>

@endsection