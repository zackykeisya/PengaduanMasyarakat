<!-- templates/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ngadu-App')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-1/4 bg-gradient-to-r from-blue-900 via-indigo-700 to-purple-600 text-white p-6">
            <h2 class="text-2xl font-bold mb-4">Menu</h2>
            <ul class="space-y-4">
                <li><a href="{{ route('pengaduan.create') }}" class="hover:text-yellow-300">Create</a></li>
                <li><a href="#" class="hover:text-yellow-300">Profile</a></li>
                <li><a href="#" class="hover:text-yellow-300">Settings</a></li>
                @if (Auth::check())
                <li><a href="{{ route('logout') }}" class="hover:text-yellow-300">Logout</a></li>
                @endif
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8 bg-gray-50">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>