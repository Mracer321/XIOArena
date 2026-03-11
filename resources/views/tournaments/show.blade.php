@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto">

    <!-- Top Section -->
    <div class="bg-[#111827] rounded-2xl p-6 mb-8">

        <div class="grid md:grid-cols-2 gap-6">

            <!-- Poster -->
            @if($tournament->poster)
            <img src="{{ asset('storage/'.$tournament->poster) }}"
                class="w-full h-full object-cover">
            @else
            <img src="https://picsum.photos/600"
                class="w-full h-full object-cover">
            @endif

            <!-- Details -->
            <div>

                <h1 class="text-2xl md:text-3xl font-bold mb-4">
                    BGMI Elite Championship
                </h1>

                <p class="text-gray-400 mb-2">
                    Prize Pool: ₹100,000
                </p>

                <p class="text-gray-400 mb-2">
                    Entry: Paid
                </p>

                <p class="text-gray-400 mb-2">
                    Registration: Open
                </p>

                <p class="text-gray-400 mb-4">
                    Organized by:

                    <a href="{{ route('org.show', ['slug' => $tournament->organization->slug]) }}"
                        class="text-blue-400 hover:text-blue-300 font-semibold">
                        {{ $tournament->organization->name }}
                    </a>
                </p>

                <button class="bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded-lg">
                    Register Now
                </button>

            </div>

        </div>

    </div>

    @if($tournament->additional_images && count($tournament->additional_images))

    <div class="bg-[#111827] rounded-xl p-6">

        <h3 class="text-xl font-semibold mb-2">Gallery</h3>

        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            @foreach($tournament->additional_images as $img)

            <div class="bg-[#111827] p-3 rounded-xl shadow-md hover:shadow-lg transition duration-300">

                <div class="aspect-[3/4] bg-[#0b0f17] rounded-lg overflow-hidden flex items-center justify-center cursor-pointer">
                    <img
                        src="{{ asset('storage/'.$img) }}"
                        onclick="openModal(this.src)"
                        class="max-h-full max-w-full object-contain transition duration-300 hover:scale-105">
                </div>

            </div>

            @endforeach

        </div>
    </div>

    <!-- Modal -->
    <div id="imageModal"
        class="hidden fixed inset-0 bg-black/95 flex items-center justify-center z-[9999]">

        <span
            onclick="closeModal()"
            class="absolute top-6 right-8 text-white text-4xl cursor-pointer">
            ✕
        </span>

        <img id="modalImage"
            class="max-h-[90vh] max-w-[90vw] object-contain rounded-xl shadow-2xl">

    </div>

    @endif
    <!-- About Section -->
    <div class="bg-[#111827] rounded-xl p-6 mb-6 mt-6">
        <h2 class="text-lg font-semibold mb-3">About Tournament</h2>
        <p class="text-gray-400 text-sm leading-relaxed">
            This is a high-level BGMI tournament featuring top teams from across India.
            Matches will be played in custom rooms with official observers.
        </p>
    </div>

    <!-- Rules Section -->
    <div class="bg-[#111827] rounded-xl p-6">
        <h2 class="text-lg font-semibold mb-3">Rules</h2>
        <ul class="list-disc list-inside text-gray-400 text-sm space-y-1">
            <li>No emulator allowed</li>
            <li>Players must join on time</li>
            <li>Cheating leads to permanent ban</li>
        </ul>
    </div>

</div>


<script>
    function openModal(src) {
        document.getElementById('modalImage').src = src;
        document.getElementById('imageModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('imageModal').classList.add('hidden');
    }
</script>

@endsection