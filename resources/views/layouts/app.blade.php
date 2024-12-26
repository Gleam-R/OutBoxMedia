<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    @vite('resources/js/app.js')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://api.fontshare.com/v2/css?f[]=technor@700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-900">

    <div class="flex">
        <!-- Sidebar -->
        <nav id="sidebar" class="bg-orange-600 text-white fixed top-0 left-0 w-64 h-full transform -translate-x-full lg:translate-x-0 transition-transform">
            <div class="p-5 flex flex-col items-center justify-center space-y-4">
                <!-- logo -->
                <img src="{{ asset('images/logo2.png') }}" alt="Logo">
                <!-- Text OUT BOX MEDIA-->
                <h1 class="text-xl font-technor text-white mt-1">OUT-BOX-MEDIA</h1>
            </div>
            <ul class="space-y-4 p-5">
                @auth
                    @if(Auth::user()->role == 'admin')
                        <li><a href="{{ url('/admin/berita/index') }}" class="hover:text-blue-200">Dashboard</a></li>
                        <li><a href="{{ url('/admin/users') }}" class="hover:text-blue-200">Users</a></li>
                        <li><a href="{{ url('/admin/logs') }}" class="hover:text-blue-200">Logs</a></li>
                        <li><a href="{{ url('/admin/categories') }}" class="hover:text-blue-200">Categories</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="hover:text-blue-200">Logout</button>
                            </form>
                        </li>
                    @elseif(Auth::user()->role == 'user')
                    <li><a href="{{ url('/') }}" class="hover:text-blue-200">Dashboard</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="hover:text-blue-200">Logout</button>
                            </form>
                        </li>
                    @endif
                @else
                <li><a href="{{ url('/') }}" class="hover:text-blue-200">Dashboard</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-blue-200">Login</a></li>
                    <li><a href="{{ route('register') }}" class="hover:text-blue-200">Register</a></li>
                @endauth
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="flex-1 transition-all p-5">
            <header class="flex justify-between items-center mb-6">
                <!-- Hamburger Menu -->
                <button id="hamburger" class="lg:block" aria-label="Toggle sidebar">
                    <span class="block w-8 h-1 bg-black"></span>
                    <span class="block w-8 h-1 bg-black my-1"></span>
                    <span class="block w-8 h-1 bg-black"></span>
                </button>
                <!-- User Info -->
                <div class="flex items-center space-x-4">
                    @auth
                        <span>{{ Auth::user()->name }}</span>
                    @else
                        <span>Guest</span>
                    @endauth
                </div>
            </header>

            @yield('content')
        </div>
    </div>

    <script>
        // Sidebar Toggle Functionality
        document.addEventListener('DOMContentLoaded', () => {
            const hamburger = document.getElementById('hamburger');
            const sidebar = document.getElementById('sidebar');

            hamburger.addEventListener('click', () => {
                sidebar.classList.toggle('-translate-x-full');
            });
        });
    </script>

</body>
</html>
