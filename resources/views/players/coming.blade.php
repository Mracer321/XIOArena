@extends('layouts.app')

@section('content')

<div class="relative min-h-screen bg-black overflow-hidden flex items-start justify-center pt-16 sm:pt-24 px-4">

    <!-- Background Glow -->
    <div class="absolute inset-0 bg-gradient-to-br from-purple-900 via-black to-blue-900 opacity-80"></div>
    <div class="absolute inset-0 animate-pulse bg-[radial-gradient(circle_at_center,rgba(0,255,255,0.15),transparent_70%)]"></div>

    <div class="relative z-10 w-full max-w-6xl text-center">

        <!-- Heading -->
        <h1 class="text-4xl sm:text-6xl md:text-7xl font-extrabold text-transparent bg-clip-text 
                   bg-gradient-to-r from-cyan-400 via-purple-500 to-pink-500 
                   drop-shadow-[0_0_20px_rgba(0,255,255,0.8)] mb-6">
            PLAYER ZONE
        </h1>

        <p class="text-gray-300 text-base sm:text-lg mb-12 tracking-widest">
            FUTURISTIC VERIFIED PLAYER SYSTEM
        </p>

        <!-- Countdown -->
        <div class="countdown-wrapper 
                    grid grid-cols-2 sm:grid-cols-4 
                    gap-4 sm:gap-6 
                    text-white text-2xl sm:text-3xl font-bold 
                    max-w-4xl mx-auto">

            <div class="bg-[#0f172a] border border-cyan-500 px-4 py-5 rounded-2xl shadow-[0_0_25px_rgba(0,255,255,0.6)] text-center">
                <div id="days">00</div>
                <div class="text-xs sm:text-sm text-cyan-400 mt-2">DAYS</div>
            </div>

            <div class="bg-[#0f172a] border border-purple-500 px-4 py-5 rounded-2xl shadow-[0_0_25px_rgba(168,85,247,0.6)] text-center">
                <div id="hours">00</div>
                <div class="text-xs sm:text-sm text-purple-400 mt-2">HOURS</div>
            </div>

            <div class="bg-[#0f172a] border border-pink-500 px-4 py-5 rounded-2xl shadow-[0_0_25px_rgba(236,72,153,0.6)] text-center">
                <div id="minutes">00</div>
                <div class="text-xs sm:text-sm text-pink-400 mt-2">MINUTES</div>
            </div>

            <div class="bg-[#0f172a] border border-yellow-400 px-4 py-5 rounded-2xl shadow-[0_0_25px_rgba(250,204,21,0.6)] text-center">
                <div id="seconds">00</div>
                <div class="text-xs sm:text-sm text-yellow-300 mt-2">SECONDS</div>
            </div>

        </div>

        <!-- Launch Message -->
        <div id="launchMessage" class="mt-10 text-3xl font-bold text-green-400 hidden">
            🚀 Launching Soon
        </div>

        <!-- Benefits Section -->
        <div class="mt-20">

            <h2 class="text-2xl sm:text-3xl font-bold text-white mb-10">
                Why Become a <span class="text-cyan-400">Verified Player?</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-left">

                <div class="bg-[#0f172a] p-6 rounded-2xl border border-cyan-500 shadow-lg">
                    <h3 class="text-lg font-semibold text-cyan-400 mb-2">
                        ⚡ Faster Team Selection
                    </h3>
                    <p class="text-gray-300 text-sm">
                        Verified players get priority preference from teams looking for serious long-term members.
                    </p>
                </div>

                <div class="bg-[#0f172a] p-6 rounded-2xl border border-purple-500 shadow-lg">
                    <h3 class="text-lg font-semibold text-purple-400 mb-2">
                        🛡 No Spam from Random Orgs
                    </h3>
                    <p class="text-gray-300 text-sm">
                        Unwanted or non-serious organizations will be automatically filtered out.
                    </p>
                </div>

                <div class="bg-[#0f172a] p-6 rounded-2xl border border-pink-500 shadow-lg">
                    <h3 class="text-lg font-semibold text-pink-400 mb-2">
                        🎯 Quick Permanent Team
                    </h3>
                    <p class="text-gray-300 text-sm">
                        Higher chances of finding a stable and permanent competitive team.
                    </p>
                </div>

                <div class="bg-[#0f172a] p-6 rounded-2xl border border-yellow-400 shadow-lg">
                    <h3 class="text-lg font-semibold text-yellow-300 mb-2">
                        🚀 Future Sponsorship Perks
                    </h3>
                    <p class="text-gray-300 text-sm">
                        Upcoming updates will include sponsorship exposure, priority listings, and exclusive rewards.
                    </p>
                </div>

            </div>

        </div>

        <!-- CTA -->
        <div class="mt-16 mb-32">

            <h3 class="text-xl sm:text-2xl font-semibold text-gray-300 mb-6 tracking-wider">
                Be A <span class="text-cyan-400">Verified Player</span>
            </h3>

            <a href="https://discord.gg/YOUR_INVITE_LINK"
                target="_blank"
                class="inline-block px-8 py-4 text-lg font-bold 
                      text-white uppercase tracking-wider 
                      rounded-xl 
                      bg-gradient-to-r from-cyan-500 via-purple-500 to-pink-500
                      shadow-[0_0_25px_rgba(0,255,255,0.7)]
                      hover:scale-105 transition duration-300">

                Join Our Discord
            </a>

        </div>

    </div>

</div>


<script>
    const launchDate = new Date("2026-03-08T00:00:00+05:30").getTime();

    const timer = setInterval(function() {

        const now = new Date().getTime();
        const distance = launchDate - now;

        if (distance <= 0) {
            clearInterval(timer);
            document.querySelector('.countdown-wrapper').classList.add('hidden');
            document.getElementById('launchMessage').classList.remove('hidden');
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("days").innerHTML = days;
        document.getElementById("hours").innerHTML = hours;
        document.getElementById("minutes").innerHTML = minutes;
        document.getElementById("seconds").innerHTML = seconds;

    }, 1000);
</script>

@endsection