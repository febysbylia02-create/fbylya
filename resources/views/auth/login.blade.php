<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - Login</title>
    @vite('resources/css/app.css')

    <!-- Tailwind CSS -->

    <style>
        @keyframes fadeInBg {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            75% {
                transform: translateX(5px);
            }
        }

        body {
            background: url('{{ asset("img/gedung-pemko.jpg") }}') no-repeat center center;
            background-size: cover;
            animation: fadeInBg 1.5s ease-out;
        }

        .login-container {
            opacity: 0;
            transform: translateY(30px);
            animation: slideUp 0.8s ease-out forwards;
        }

        .logo-section {
            animation: fadeIn 1s ease-out 0.3s forwards;
            opacity: 0;
        }

        .error {
            animation: shake 0.5s ease-in-out;
        }
    </style>
</head>

<body class="flex justify-center items-center min-h-screen overflow-hidden">
    <div class="login-container w-full max-w-md bg-white/20 backdrop-blur-lg rounded-3xl p-10 shadow-2xl">
        <!-- Logo & App Name Section -->
        <div class="logo-section text-center mb-8">
            <img src="{{ asset('logo/logo.png') }}" alt="Logo"
                class="w-20 h-20 mx-auto mb-4 drop-shadow-lg object-contain">
            <h1 class="text-3xl font-bold text-blue-900 uppercase tracking-wider mb-1 drop-shadow-md">Sidoksur</h1>
            <p class="text-sm text-gray-700 font-medium tracking-wide">Sistem Informasi Dokumen & Surat</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div>
                <label for="email"
                    class="block text-center text-white font-bold uppercase tracking-wider text-sm mb-2 opacity-90">
                    Email
                </label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full px-4 py-3 bg-white rounded-lg text-black focus:outline-none focus:ring-4 focus:ring-blue-400/50 transition-all">
                @error('email')
                    <div class="error text-red-500 text-sm mt-2 text-center font-medium">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="password"
                    class="block text-center text-white font-bold uppercase tracking-wider text-sm mb-2 opacity-90">
                    Password
                </label>
                <input id="password" type="password" name="password" required
                    class="w-full px-4 py-3 bg-white rounded-lg text-black focus:outline-none focus:ring-4 focus:ring-blue-400/50 transition-all">
                @error('password')
                    <div class="error text-red-500 text-sm mt-2 text-center font-medium">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit"
                class="w-full py-3 bg-white text-gray-800 font-bold uppercase tracking-wider rounded-full shadow-lg hover:bg-blue-900 hover:text-white hover:-translate-y-1 hover:shadow-xl transition-all duration-300 mt-6">
                Login
            </button>
        </form>
    </div>
</body>

</html>