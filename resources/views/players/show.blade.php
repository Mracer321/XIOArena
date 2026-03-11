@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="bg-[#111827] rounded-2xl p-6 mb-6">

        <div class="flex flex-col md:flex-row gap-6 items-center">

            <div class="w-32 h-32 rounded-full overflow-hidden">
                <img src="https://picsum.photos/300"
                    class="w-full h-full object-cover">
            </div>

            <div>
                <h1 class="text-2xl font-bold mb-2">
                    PlayerName
                </h1>

                <p class="text-gray-400 text-sm mb-2">
                    Role: Assaulter
                </p>

                <p class="text-gray-400 text-sm mb-2">
                    KD: 4.5
                </p>

                <p class="text-yellow-400 text-sm">
                    ⭐ Rating: 8.5 / 10
                </p>

            </div>

        </div>

    </div>

    <div class="bg-[#111827] rounded-xl p-6">
        <h2 class="text-lg font-semibold mb-3">
            About Player
        </h2>

        <p class="text-gray-400 text-sm">
            Experienced competitive BGMI player with strong game sense and leadership skills.
        </p>
    </div>

</div>

@endsection