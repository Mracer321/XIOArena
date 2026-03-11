<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Xolt Esports</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#0b0f17] text-gray-200">

    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-[#111827] p-6 border-r border-gray-800">

            <h1 class="text-lg font-bold text-blue-500 mb-10">
                Admin Panel
            </h1>

            <nav class="space-y-4 text-sm">

                <a href="/admin" class="block px-3 py-2 rounded hover:bg-gray-800">
                    Dashboard
                </a>

                <a href="/admin/tournaments" class="block px-3 py-2 rounded hover:bg-gray-800">
                    Tournaments
                </a>
                <a href="/admin/orgs" class="block px-3 py-2 rounded hover:bg-gray-800">
                    Organizations
                </a>
                <a href="/admin/users" class="block px-3 py-2 rounded hover:bg-gray-800">
                    Admin List
                </a>

            </nav>
            <form method="POST" action="/logout" class="mt-10">
                @csrf
                <button class="w-full text-left px-3 py-2 rounded hover:bg-red-600 text-sm">
                    Logout
                </button>
            </form>
        </aside>

        <!-- Content -->
        <main class="flex-1 p-8">
            @yield('content')
        </main>

    </div>

</body>

</html>