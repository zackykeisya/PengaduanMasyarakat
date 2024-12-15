<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen flex items-center justify-center bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500">
    <!-- Register Form -->
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Register</h2>
        <form action="{{ route('register.auth') }}" method="POST">
    @csrf
    <div>
        <label>Email:</label>
        <input type="email" name="email" required>
    </div>
    <div>
        <label>Password:</label>
        <input type="password" name="password" required>
    </div>
    <button type="submit">Register</button>
</form>

        <!-- Login Link -->
        <p class="text-sm text-center text-gray-600 mt-6">
            Already have an account? <a href="{{ route('login.auth') }}" class="text-purple-500 hover:underline">Login</a>
        </p>
    </div>
</body>
</html>
