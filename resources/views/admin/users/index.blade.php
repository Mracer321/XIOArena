@extends('admin.layouts.app')

@section('content')

<div class="flex items-center justify-between mb-6">

    <h2 class="text-2xl font-semibold text-white">
        Admin List
    </h2>

    <a href="/admin/users/create"
        class="bg-indigo-600 hover:bg-indigo-700 
              text-white text-sm font-medium 
              px-4 py-2 rounded-lg 
              shadow-md transition duration-200">
        + Create Admin
    </a>

</div>


<div class="bg-[#111827] rounded-xl p-6 overflow-x-auto">

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
            <tr class="border-b border-gray-800">
                <td class="py-3">{{ $admin->name }}</td>
                <td class="py-3">{{ $admin->email }}</td>
                <td class="py-3 capitalize">{{ $admin->status }}</td>
                <td class="py-3 flex gap-2">

                    <form method="POST" action="/admin/users/{{ $admin->id }}/status">
                        @csrf
                        <input type="hidden" name="status" value="active">
                        <button class="text-green-400 text-xs">Activate</button>
                    </form>

                    <form method="POST" action="/admin/users/{{ $admin->id }}/status">
                        @csrf
                        <input type="hidden" name="status" value="inactive">
                        <button class="text-yellow-400 text-xs">Deactivate</button>
                    </form>

                    <form method="POST" action="/admin/users/{{ $admin->id }}/status">
                        @csrf
                        <input type="hidden" name="status" value="banned">
                        <button class="text-red-400 text-xs">Ban</button>
                    </form>

                </td>
            </tr>
            @endforeach

        </tbody>

    </table>

</div>

@endsection