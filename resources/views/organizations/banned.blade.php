@extends('layouts.app')

@section('content')

<h1 class="text-xl font-bold mb-6 text-red-500">
    🚫 Blacklisted Organizations
</h1>

<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">

    @for($i=0;$i<4;$i++)
        <div class="bg-[#111827] rounded-xl p-4 text-center border border-red-500/40">

        <div class="w-20 h-20 mx-auto rounded-full overflow-hidden mb-3 relative">
            <img src="https://picsum.photos/200?random={{ $i }}" class="w-full h-full object-cover">

            <div class="absolute inset-0 bg-black bg-opacity-70 flex items-center justify-center text-red-500 text-xs font-bold">
                BANNED
            </div>
        </div>

        <h3 class="text-sm font-medium text-red-400">
            Org {{ $i }} (BANNED)
        </h3>

</div>
@endfor

</div>

@endsection