<!-- resources/views/auth/login.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-md bg-white rounded shadow p-6">

        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <img src="{{ asset('images/logo.png') }}" alt="App Logo" class="h-16 w-auto">
        </div>

        <h2 class="text-2xl font-bold mb-4 text-blue-600 text-center">Login</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block mb-1">Email</label>
                <input id="email" type="email" name="email" required autofocus class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label for="password" class="block mb-1">Password</label>
                <input id="password" type="password" name="password" required class="w-full border p-2 rounded">
            </div>

            <div class="mb-4 flex items-center">
                <input type="checkbox" name="remember" id="remember" class="mr-2">
                <label for="remember">Remember me</label>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded w-full hover:bg-blue-700">
                Login
            </button>
        </form>

        <!-- Forgot Password and Register links -->
        <div class="mt-4 text-sm text-center text-gray-600 space-y-2">
            <p>
                <a href="{{ route('password.request') }}" class="text-blue-500 hover:underline">Forgot Password?</a>
            </p>
            <p>
                No account?
                <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Register here</a>
            </p>
        </div>
    </div>
</body>
</html>
