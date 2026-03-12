<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>XIOArena</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <script src="https://unpkg.com/lucide@latest"></script>

</head>

<body class="bg-[#0b0f17] text-gray-200 overflow-hidden">

    <div class="flex h-screen">

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

            <div class="flex items-center gap-2 mb-10">

                <img src="/images/xio-logo.png" class="h-8">

                <!-- <span class="text-lg font-semibold text-blue-400">
                    XIOArena
                </span> -->

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


                <a href="/organizations"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg
{{ request()->is('organizations*') ? 'bg-blue-600/20 text-blue-400' : 'hover:bg-gray-800' }}">

                    <i data-lucide="building"></i>
                    Organizations

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

            <header class="h-16 flex items-center justify-between
bg-[#0e1625] border-b border-gray-800
px-4 md:px-6
fixed md:relative w-full z-30">

                <!-- LEFT -->

                <div class="flex items-center gap-4">

                    <!-- Mobile Menu Button -->

                    <button id="menuBtn" class="md:hidden">

                        <i data-lucide="menu"></i>

                    </button>

                </div>


                <!-- SEARCH -->

                <div class="flex-1 max-w-xl mx-4">

                    <div class="relative">

                        <input
                            type="text"
                            placeholder="Search tournaments..."
                            class="w-full bg-[#111827] border border-gray-700 rounded-lg py-2 pl-10 pr-4 text-sm focus:outline-none focus:border-blue-500">

                        <i data-lucide="search" class="absolute left-3 top-2.5 w-4 h-4 text-gray-400"></i>

                    </div>

                </div>


                <!-- RIGHT -->

                <div class="flex items-center gap-4">

                    <button class="relative">

                        <i data-lucide="bell"></i>

                        <span class="absolute -top-1 -right-1 w-2 h-2 bg-red-500 rounded-full"></span>

                    </button>

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
        lucide.createIcons()

        const sidebar = document.getElementById("sidebar")
        const menuBtn = document.getElementById("menuBtn")

        menuBtn.addEventListener("click", () => {

            sidebar.classList.toggle("-translate-x-full")

        })
    </script>

</body>

</html>