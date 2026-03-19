<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin - XIOArena</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://unpkg.com/lucide@latest"></script>

</head>

<body class="bg-[#0b0f17] text-gray-200 overflow-hidden">

    <div class="flex h-screen">

        <!-- OVERLAY -->

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

            <!-- LOGO -->

            <div class="flex items-center gap-3 mb-10">

                <img src="/images/xio-logo.png" class="w-10 h-10 object-contain">

                <div>
                    <p class="text-sm text-gray-400">XIOArena</p>
                    <p class="text-lg font-semibold">Admin Panel</p>
                </div>

            </div>


            <!-- NAVIGATION -->

            <nav class="space-y-2 text-sm">

                <a href="/admin"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg
{{ request()->is('admin') ? 'bg-blue-600/20 text-blue-400' : 'hover:bg-gray-800' }}">

                    <i data-lucide="layout-dashboard"></i>
                    Dashboard

                </a>


                <a href="/admin/tournaments"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg
{{ request()->is('admin/tournaments*') ? 'bg-blue-600/20 text-blue-400' : 'hover:bg-gray-800' }}">

                    <i data-lucide="trophy"></i>
                    Tournaments

                </a>


                <a href="/admin/orgs"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg
{{ request()->is('admin/orgs*') ? 'bg-blue-600/20 text-blue-400' : 'hover:bg-gray-800' }}">

                    <i data-lucide="building-2"></i>
                    Organizations

                </a>

                <a href="/admin/creators"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg
{{ request()->is('admin/creators*') ? 'bg-blue-600/20 text-blue-400' : 'hover:bg-gray-800' }}">

                    <i data-lucide="users"></i>
                    Creators

                </a>

                <a href="/admin/users"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg
{{ request()->is('admin/users*') ? 'bg-blue-600/20 text-blue-400' : 'hover:bg-gray-800' }}">

                    <i data-lucide="shield"></i>
                    Admin List

                </a>

            </nav>


            <!-- LOGOUT -->

            <div class="mt-auto pt-10">

                <form method="POST" action="/logout">
                    @csrf

                    <button
                        class="flex items-center gap-3 w-full px-4 py-2 rounded-lg text-sm hover:bg-red-600/20 text-red-400">

                        <i data-lucide="log-out"></i>
                        Logout

                    </button>

                </form>

            </div>

        </aside>


        <!-- =========================
MAIN AREA
========================= -->

        <div class="flex-1 flex flex-col">

            <!-- HEADER -->

            <header class="h-16 flex items-center
bg-[#0e1625] border-b border-gray-800
px-4 md:px-6
fixed md:relative w-full z-20">

                <button id="menuBtn" class="md:hidden">

                    <i data-lucide="menu"></i>

                </button>

                <h1 class="ml-4 font-semibold text-sm text-gray-400">
                    Admin Dashboard
                </h1>

            </header>


            <!-- CONTENT -->

            <main class="flex-1 overflow-y-auto pt-20 md:pt-6 p-6">

                @yield('content')

            </main>

        </div>

    </div>


    <script>
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