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
    <li>
        <div class="text-center">
            <h1 class="text-4xl font-bold text-gray-800">Welcome, {{ Auth::user()->name }}!</h1>
            <p class="text-lg text-gray-600 mt-4">You are logged in.</p>
            
            <!-- Form logout -->
            <form action="{{ route('logout.auth') }}" method="POST">
                @csrf
                <button type="submit" class="mt-6 inline-block bg-purple-500 text-white py-2 px-4 rounded hover:bg-purple-600">
                    Logout
                </button>
            </form>
        </div>
    </li>
@else
    <li>
        <div class="text-center">
            <h1 class="text-4xl font-bold text-gray-800">Welcome, Guest!</h1>
            <p class="text-lg text-gray-600 mt-4">You are logged in as a guest user.</p>
            <a href="{{ route('login.page') }}" class="mt-6 inline-block bg-purple-500 text-white py-2 px-4 rounded hover:bg-purple-600">Login</a>
        </div>
    </li>
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