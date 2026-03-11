<a href="{{ route('tournament.show', $slug) }}">
    <div class="bg-[#111827] rounded-xl p-3 md:p-4 hover:scale-105 transition duration-300 shadow-md">

        <!-- Poster -->
        <div class="aspect-square rounded-lg overflow-hidden mb-3 relative">
            <img src="{{ $image ? asset('storage/' . $image) : 'https://picsum.photos/1080' }}"
                class="w-full h-full object-cover object-top"
                alt="{{ $title }}">

            <!-- Registration Status Badge -->
            <span class="absolute top-2 left-2 text-xs px-2 py-1 rounded
            {{ ($registration ?? 'open') === 'open' 
                ? 'bg-green-600' 
                : 'bg-red-600' }}">
                {{ ucfirst($registration ?? 'Open') }}
            </span>
        </div>

        <!-- Title -->
        <h4 class="font-semibold text-sm md:text-base mb-1">
            {{ $title ?? 'BGMI Championship' }}
        </h4>

        <!-- Prize -->
        <p class="text-xs md:text-sm text-gray-400 mb-2">
            Prize Pool ₹{{ $prize ?? '50,000' }}
        </p>

        <!-- Entry Type -->
        <div class="flex justify-between items-center text-xs">

            <span class="px-2 py-1 rounded
            {{ ($entry ?? 'free') === 'paid' 
                ? 'bg-yellow-600' 
                : 'bg-blue-600' }}">
                {{ ucfirst($entry ?? 'Free') }}
            </span>

            <span class="text-gray-400">
                View →
            </span>

        </div>

    </div>
</a>