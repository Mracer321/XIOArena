<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>xioArena</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#0b0f17] text-gray-200">

    <!-- Mobile Top Header -->
    <header class="md:hidden bg-[#111827] p-4 flex justify-between items-center border-b border-gray-800 sticky top-0 z-50">
        <h1 class="text-lg font-bold text-blue-500">xioArena</h1>
        <button id="menuToggle" class="text-xl">☰</button>
    </header>

    <!-- Mobile Slide Menu -->
    <div id="mobileMenu" class="fixed inset-0 bg-black bg-opacity-60 hidden z-40">
        <div class="bg-[#111827] w-64 h-full p-6">

            <h2 class="text-lg font-bold text-blue-500 mb-8">Menu</h2>

            <nav class="space-y-4">
                <a href="/" class="block px-3 py-2 rounded-lg hover:bg-gray-800">Home</a>
                <a href="/tournaments" class="block px-3 py-2 rounded-lg hover:bg-gray-800">Tournaments</a>
                <a href="/orgs" class="block px-3 py-2 rounded-lg hover:bg-gray-800">Organizations</a>
                <a href="/players" class="block px-3 py-2 rounded-lg hover:bg-gray-800">Players</a>
            </nav>

        </div>
    </div>

    <div class="flex min-h-screen">

        <!-- Desktop Sidebar -->
        <aside class="hidden md:flex w-64 bg-[#111827] flex-col p-6 border-r border-gray-800">

            <h1 class="text-xl font-bold text-blue-500 mb-10">
                xioArena
            </h1>

            <nav class="space-y-4 text-sm">
                <a href="/" class="block px-3 py-2 rounded-lg hover:bg-gray-800">Dashboard</a>
                <a href="/tournaments" class="block px-3 py-2 rounded-lg hover:bg-gray-800">Tournaments</a>
                <a href="/orgs" class="block px-3 py-2 rounded-lg hover:bg-gray-800">Organizations</a>
                <a href="/players" class="block px-3 py-2 rounded-lg hover:bg-gray-800">Players</a>
            </nav>

            <div class="mt-auto text-xs text-gray-500">
                © {{ date('Y') }} xioArena
            </div>

        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-4 md:p-8 pb-24 md:pb-8">

            @yield('content')

            <!-- Footer -->
            <footer class="mt-16 border-t border-gray-800 pt-8 pb-6 text-center">

                <div class="flex justify-center gap-6 mb-4 text-xl">

                    <a href="https://youtube.com" target="_blank"
                        class="hover:text-red-500 transition">
                        🎥
                    </a>

                    <a href="https://discord.com" target="_blank"
                        class="hover:text-indigo-400 transition">
                        💬
                    </a>

                    <a href="https://instagram.com" target="_blank"
                        class="hover:text-pink-500 transition">
                        📸
                    </a>

                </div>

                <p class="text-xs text-gray-500">
                    © {{ date('Y') }} xioArena. All rights reserved.
                </p>

            </footer>

        </main>

    </div>

    <!-- Mobile Bottom Navigation -->
    <nav class="fixed bottom-0 left-0 right-0 bg-[#111827] border-t border-gray-800 md:hidden flex justify-around py-3 text-sm z-50">

        <a href="/" class="flex flex-col items-center">
            🏠
            <span>Home</span>
        </a>

        <a href="/tournaments" class="flex flex-col items-center">
            🎮
            <span>Tournaments</span>
        </a>

        <a href="/orgs" class="flex flex-col items-center">
            🏢
            <span>Orgs</span>
        </a>

    </nav>

    <script>
        const toggle = document.getElementById('menuToggle');
        const menu = document.getElementById('mobileMenu');

        if (toggle) {
            toggle.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });
        }

        if (menu) {
            menu.addEventListener('click', (e) => {
                if (e.target === menu) {
                    menu.classList.add('hidden');
                }
            });
        }
    </script>

</body>

</html>