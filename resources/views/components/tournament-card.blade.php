<a href="{{ route('tournament.show', $slug) }}"
    class="min-w-[190px] md:min-w-[190px] lg:min-w-0 snap-start">

    <div class="bg-[#0f1b2e] rounded-2xl overflow-hidden
border border-[#1f2a40]
hover:border-purple-500/40
hover:shadow-lg hover:shadow-purple-500/10
transition duration-300">

        <!-- Poster -->

        <div class="relative aspect-[4/5] overflow-hidden bg-black">

            <img
                src="{{ $image ? asset('storage/' . $image) : 'https://picsum.photos/800/1000' }}"
                class="w-full h-full object-cover object-top
hover:scale-105 transition duration-500"
                alt="{{ $title }}">

            <!-- Dark gradient bottom for readability -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>

            <!-- Registration Status -->
            <span class="absolute top-3 left-3 text-xs px-3 py-1 rounded-full
{{ ($registration ?? 'open') === 'open'
? 'bg-green-500'
: 'bg-red-500' }} text-white">

                {{ ucfirst($registration ?? 'Open') }}

            </span>

            <!-- Entry Type -->
            <span class="absolute top-3 right-3 text-xs px-3 py-1 rounded-full
{{ ($entry ?? 'free') === 'paid'
? 'bg-black/80 text-white'
: 'bg-cyan-500 text-white' }}">

                {{ strtoupper($entry ?? 'FREE') }}

            </span>

            <!-- Verified -->
            @if($orgStatus === 'verified')

            <span class="absolute bottom-3 left-3 text-xs
px-3 py-1 rounded-full
bg-emerald-500/20
border border-emerald-500/30
text-emerald-400 flex items-center gap-1">

                <i data-lucide="shield-check" class="w-3 h-3"></i>

                Verified

            </span>

            @endif

        </div>


        <!-- Content -->

        <div class="p-4">

            <!-- Title -->
            <h3 class="text-sm md:text-base font-semibold text-white mb-1 line-clamp-2">

                {{ $title }}

            </h3>

            <!-- Org Name -->
            @if(isset($org))
            <p class="text-xs text-gray-400 mb-3">

                {{ $org }}

            </p>
            @endif


            <!-- Prize Pool -->
            <p class="text-xs text-gray-400">

                Prize Pool

            </p>

            <p class="text-lg font-bold text-blue-400 mb-4">

                ₹{{ number_format($prize) }}

            </p>


            <!-- CTA -->

            <button
                class="w-full
bg-gradient-to-r
from-blue-500 to-purple-500
hover:from-blue-600 hover:to-purple-600
text-sm font-semibold
py-2.5 rounded-xl
transition">

                Join Tournament

            </button>

        </div>

    </div>

</a>