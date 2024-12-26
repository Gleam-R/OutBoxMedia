<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/js/app.js') <!-- Vite JS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> <!-- TailwindCSS -->
</head>
<body class="bg-gray-100 text-gray-900">

<div class="max-w-lg mx-auto p-6 mt-10 bg-white rounded-md shadow-md">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Login to Your Account</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Input -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 mt-1">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password Input -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" id="password" name="password" required
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 mt-1">
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition">Login</button>
    </form>

    <!-- Link to Register Page -->
    <div class="mt-4 text-center">
        <span class="text-sm text-gray-600">Don't have an account? </span>
        <a href="{{ route('register') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">Register here</a>
    </div>
</div>

</body>
</html>
