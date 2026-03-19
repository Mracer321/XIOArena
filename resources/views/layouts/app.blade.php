<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>XIOArena</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @keyframes loader {

            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(100%);
            }

        }
    </style>
</head>
<!-- =========================
PAGE LOADER
========================= -->

<div id="pageLoader" class="fixed inset-0 bg-[#0b0f17] z-[9999] flex items-center justify-center">

    <div class="flex flex-col items-center gap-6">

        <!-- LOGO -->

        <div class="w-20 h-20 flex items-center justify-center 
bg-[#0e1625] border border-gray-800 
rounded-2xl p-3 shadow-lg animate-pulse">

            <img src="/images/xio-logo.png"
                class="w-full h-full object-contain">

        </div>

        <!-- TEXT -->

        <div class="text-center">

            <h2 class="text-lg font-semibold tracking-wide">
                XIOArena
            </h2>

            <p class="text-xs text-gray-400">
                Loading Arena...
            </p>

        </div>

        <!-- LOADING BAR -->

        <div class="w-40 h-1 bg-gray-800 rounded-full overflow-hidden">

            <div class="h-full bg-gradient-to-r from-blue-500 to-purple-600 animate-[loader_1.5s_infinite]"></div>

        </div>

    </div>

</div>

<!-- AMAIN area -->

<body class="bg-[#0b0f17] text-gray-200 overflow-hidden">

    <div class="flex h-screen">

        <!-- OVERLAY (Mobile) -->

        <div id="overlay" class="fixed inset-0 bg-black/50 z-30 hidden md:hidden"></div>

        <!-- =========================
SIDEBAR
========================= -->

        <aside id="sidebar"
            class="fixed md:relative z-40
w-64 h-full
bg-[#0e1625] border-r border-gray-800
flex flex-col p-6
transform -translate-x-full md:translate-x-0
transition-transform duration-300">

            <!-- Logo -->

            <div class="flex items-center gap-2 mb-10 h-16">
                <img src="/images/xio-logo.png" class="w-full h-full object-contain">
            </div>

            <nav class="space-y-2 text-sm">

                <a href="/"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg
{{ request()->is('/') ? 'bg-blue-600/20 text-blue-400' : 'hover:bg-gray-800' }}">
                    <i data-lucide="home"></i>
                    Home
                </a>

                <a href="/tournaments"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg
{{ request()->is('tournaments*') ? 'bg-blue-600/20 text-blue-400' : 'hover:bg-gray-800' }}">
                    <i data-lucide="trophy"></i>
                    Tournaments
                </a>

                <a href="/orgs"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg
{{ request()->is('orgs*') ? 'bg-blue-600/20 text-blue-400' : 'hover:bg-gray-800' }}">
                    <i data-lucide="building"></i>
                    Organizations
                </a>
                <a href="/creators"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg
{{ request()->is('creators*') || request()->is('creator/*') ? 'bg-blue-600/20 text-blue-400' : 'hover:bg-gray-800' }}">
                    <i data-lucide="mic-2"></i>
                    Creators
                </a>
                <a href="/players"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg
{{ request()->is('players*') ? 'bg-blue-600/20 text-blue-400' : 'hover:bg-gray-800' }}">
                    <i data-lucide="users"></i>
                    Players
                </a>

                <a href="/contact"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg
{{ request()->is('contact*') ? 'bg-blue-600/20 text-blue-400' : 'hover:bg-gray-800' }}">
                    <i data-lucide="mail"></i>
                    Contact Us
                </a>

            </nav>

        </aside>


        <!-- =========================
MAIN AREA
========================= -->

        <div class="flex-1 flex flex-col">

            <!-- =========================
HEADER
========================= -->

            <header class="h-16 flex items-center justify-center
bg-[#0e1625] border-b border-gray-800
px-4
fixed w-full z-20
md:hidden">

                <!-- LEFT MENU -->
                <button id="menuBtn" class="absolute left-4">
                    <i data-lucide="menu"></i>
                </button>

                <!-- BRAND -->
                <div class="font-extrabold tracking-widest text-lg">
                    <span class="text-blue-500">XIO</span><span class="text-white">ARENA</span>
                </div>

            </header>

            <!-- =========================
SCROLLABLE CONTENT
========================= -->

            <main class="flex-1 overflow-y-auto pt-20 md:pt-6 p-4 md:p-6">

                @yield('content')

                <footer class="border-t border-gray-800 py-6 text-center text-xs text-gray-500 mt-10">
                    © {{ date('Y') }} XIOArena. All rights reserved.
                </footer>

            </main>

        </div>

    </div>


    <!-- =========================
SCRIPTS
========================= -->

    <script>
        // Page Loader Hide

        window.addEventListener("load", () => {

            const loader = document.getElementById("pageLoader")

            loader.style.opacity = "0"
            loader.style.transition = "opacity 0.4s ease"

            setTimeout(() => {

                loader.style.display = "none"

            }, 400)

        })

        lucide.createIcons()

        const sidebar = document.getElementById("sidebar")
        const menuBtn = document.getElementById("menuBtn")
        const overlay = document.getElementById("overlay")

        menuBtn.addEventListener("click", () => {

            sidebar.classList.toggle("-translate-x-full")
            overlay.classList.toggle("hidden")

        })

        overlay.addEventListener("click", () => {

            sidebar.classList.add("-translate-x-full")
            overlay.classList.add("hidden")

        })
    </script>

</body>

</html>