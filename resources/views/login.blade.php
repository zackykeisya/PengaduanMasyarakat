<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.tailwindcss.com">
</head>
<body class="h-screen flex items-center justify-center bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500">
    <!-- Login Form -->
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login</h2>
        <form action="{{ route('login.auth') }}" method="POST">
    @csrf
    @method('POST')
    @if (Session::get('failed'))
    <div class="alert alert-danger">{{Session::get('failed')}}</div>
    @endif
    @if (Session::get('logout'))
    <div class="alert alert-primary">   {{Session::get('logout')}}</div>
    @endif
    @if (Session::get('canAccess'))
    <div class="alert alert-danger">{{Session::get('canAccess')}}</div>
    @endif
    <!-- email -->
    <div class="mb-4">
        <label for="email" class="block text-sm text-gray-600 mb-2">Email</label>
        <input type="text" id="email" name="email" class="w-full border rounded-lg py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
    </div>
    <!-- Password -->
    <div class="mb-4">
        <label for="password" class="block text-sm text-gray-600 mb-2">Password</label>
        <input type="password" id="password" name="password" class="w-full border rounded-lg py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
    </div>
    <!-- Remember Me -->
    <div class="mb-4 flex items-center">
        <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-purple-500 border-gray-300 rounded focus:ring-purple-400">
        <label for="remember" class="ml-2 text-sm text-gray-600">Remember Me</label>
    </div>
    <!-- Submit Button -->
    <button type="submit" class="w-full bg-purple-500 text-white rounded-lg py-2 hover:bg-purple-600">Login</button>
</form>

        <!-- Signup Link -->
        <p class="text-sm text-center text-gray-600 mt-6">Don't have an account? <a href="#" class="text-purple-500 hover:underline">Sign up</a></p>
    </div>
</body>
</html>
