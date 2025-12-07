<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SMP DARUL MUSTOFA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .form-input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }
        .logo-animation {
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }

        /* Background overlay */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }
    </style>
</head>
<body class="font-inter text-white min-h-screen flex items-center justify-center p-4 relative"
      style="background-image: url('{{ asset('images/gedung-sekolah.jpg') }}'); background-size: cover; background-position: center; background-attachment: fixed;">

    <div class="w-full max-w-md">
        <div class="bg-white/15 backdrop-blur-lg rounded-2xl shadow-2xl p-8 border border-white/20">

            <div class="text-center mb-8">

                <div class="mb-4 flex justify-center logo-animation">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo SMK Siding Puri" class="w-20 h-20 object-contain">
                </div>
                <h1 class="text-3xl font-bold">Login Admin</h1>
                <p class="text-indigo-200">SMP DARUL MUSTOFA</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="relative mb-4">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-indigo-200">
                        <i class="fas fa-user"></i>
                    </span>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                           class="form-input w-full bg-white/20 border border-white/30 rounded-lg py-3 pl-12 pr-4 focus:outline-none focus:ring-2 focus:ring-amber-400 transition"
                           placeholder="Username (Email)">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="relative mb-4">
                     <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-indigo-200">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                           class="form-input w-full bg-white/20 border border-white/30 rounded-lg py-3 pl-12 pr-4 focus:outline-none focus:ring-2 focus:ring-amber-400 transition"
                           placeholder="Password">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between mb-6 text-sm">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded bg-white/30 border-white/40 text-amber-500 shadow-sm focus:ring-amber-500" name="remember">
                        <span class="ml-2">Ingat saya</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="underline hover:text-amber-300" href="{{ route('password.request') }}">
                            Lupa password?
                        </a>
                    @endif
                </div>

                <!-- Login Button -->
                <div class="mb-4">
                    <button type="submit" class="w-full bg-amber-400 hover:bg-amber-500 text-gray-800 font-bold py-3 rounded-lg shadow-lg transition">
                        <i class="fas fa-sign-in-alt mr-2"></i> Masuk
                    </button>
                </div>

                <div class="relative flex py-4 items-center">
                    <div class="flex-grow border-t border-white/20"></div>
                    <span class="flex-shrink mx-4 text-white/60">atau</span>
                    <div class="flex-grow border-t border-white/20"></div>
                </div>

                <!-- Help Button -->
                 <div>
                    <button type="button" class="w-full bg-indigo-500/50 hover:bg-indigo-500/80 text-white font-bold py-3 rounded-lg shadow-lg transition">
                        <i class="fas fa-question-circle mr-2"></i> Bantuan Login
                    </button>
                </div>
            </form>
        </div>

        <div class="text-center text-indigo-200 text-sm mt-8">
            <p>&copy; {{ date('Y') }} SMP Darul Mustofa. All rights reserved.</p>
            <p>Sistem Informasi Manajemen Sekolah</p>
        </div>
    </div>
</body>
</html>
