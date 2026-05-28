<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Masuk ke PanenHub</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#f4fdf6',
                            100: '#e8f7ec',
                            600: '#2e7d32',
                            700: '#1b5e20',
                            800: '#154d1a',
                        }
                    }
                }
            }
        }
    </script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Google Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: radial-gradient(circle at 10% 10%, rgba(46, 125, 50, 0.04) 0%, transparent 40%),
                        radial-gradient(circle at 90% 90%, rgba(46, 125, 50, 0.04) 0%, transparent 40%);
        }
        /* Align Material Icons correctly */
        .material-icons {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            vertical-align: middle;
        }
    </style>
</head>
<body class="min-h-screen bg-gray-50 flex flex-col justify-between">

    <!-- Header / Navbar -->
    <header class="bg-white border-b border-gray-100 py-4 px-6 md:px-12 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <a href="/" class="flex items-center gap-3">
                <img src="{{ asset('images/logo-icon.png') }}" alt="PanenHub Logo" class="h-9 w-auto">
                <span class="text-xl font-bold text-gray-900 tracking-tight">PanenHub</span>
            </a>
            <div class="flex items-center gap-6">
                <a href="/" class="text-gray-600 hover:text-brand-700 font-medium transition-colors">Beranda</a>
                <a href="/register" class="bg-brand-700 hover:bg-brand-800 text-white font-semibold py-2 px-6 rounded-full transition-colors shadow-sm shadow-brand-700/10">Daftar</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full">
            <!-- Login Card Container -->
            <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-100 p-8 sm:p-10 relative overflow-hidden transition-all hover:shadow-2xl hover:shadow-gray-200/60">
                
                <!-- Agriculture Circle Icon (Material Icon) -->
                <div class="w-20 h-20 bg-brand-50 rounded-full flex items-center justify-center mx-auto mb-6 border border-brand-100/50">
                    <span class="material-icons text-brand-700 text-3xl">agriculture</span>
                </div>

                <!-- Titles -->
                <div class="text-center mb-8">
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-950 tracking-tight">Masuk ke PanenHub</h2>
                    <p class="mt-2 text-sm text-gray-500 leading-relaxed max-w-xs mx-auto">
                        Kelola hasil panen dan kontrak pertanian Anda dalam satu ekosistem.
                    </p>
                </div>

                <!-- Errors Alert -->
                @if($errors->has('msg'))
                    <div class="alert alert-danger mb-6 p-4 rounded-2xl bg-red-50 text-red-700 text-sm border border-red-100 flex items-start gap-3">
                        <span class="material-icons mt-0.5 text-lg">warning</span>
                        <span class="font-medium">{{ $errors->first('msg') }}</span>
                    </div>
                @endif

                <!-- Login Form -->
                <form action="/api/login" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Phone Input Group -->
                    <div class="space-y-2">
                        <label for="phone" class="text-xs font-bold text-gray-600 uppercase tracking-wider block">Nomor Handphone</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <span class="material-icons">call</span>
                            </span>
                            <input type="text" name="phone" id="phone" placeholder="0812..." required autocomplete="tel" autofocus
                                class="pl-11 pr-4 py-3.5 w-full bg-white border border-gray-200 rounded-2xl focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition-all text-gray-800 placeholder-gray-300 font-medium">
                        </div>
                    </div>

                    <!-- Password Input Group -->
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <label for="password" class="text-xs font-bold text-gray-600 uppercase tracking-wider block">Kata Sandi</label>
                            <a href="#" class="text-xs font-bold text-brand-700 hover:text-brand-800 tracking-wide transition-colors">Lupa Kata Sandi?</a>
                        </div>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <span class="material-icons">lock</span>
                            </span>
                            <input type="password" name="password" id="password" placeholder="Masukkan kata sandi" required autocomplete="current-password"
                                class="pl-11 pr-12 py-3.5 w-full bg-white border border-gray-200 rounded-2xl focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition-all text-gray-800 placeholder-gray-300 font-medium">
                            <button type="button" onclick="togglePassword()" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors focus:outline-none flex items-center justify-center">
                                <span id="eyeIcon" class="material-icons">visibility</span>
                            </button>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full bg-brand-700 hover:bg-brand-800 text-white font-bold py-3.5 px-4 rounded-2xl transition-all shadow-lg shadow-brand-700/10 flex items-center justify-center gap-2 group">
                        <span>Masuk Akun</span>
                        <span class="material-icons transition-transform group-hover:translate-x-1">arrow_forward</span>
                    </button>
                </form>

                <!-- Signup Link -->
                <div class="text-center mt-8 pt-6 border-t border-gray-100">
                    <p class="text-sm text-gray-500 font-medium">
                        Belum punya akun? <a href="/register" class="text-brand-700 hover:text-brand-800 font-bold transition-colors">Daftar Akun Baru</a>
                    </p>
                </div>

            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="py-6 px-4 border-t border-gray-100 bg-white">
        <div class="max-w-7xl mx-auto text-center text-xs text-gray-400 font-medium">
            © 2024 PanenHub Agritech Ecosystem. Semua Hak Dilindungi.
        </div>
    </footer>

    <!-- Password Visibility Toggle JS (Material Icons Version) -->
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.textContent = 'visibility_off';
            } else {
                passwordInput.type = 'password';
                eyeIcon.textContent = 'visibility';
            }
        }
    </script>
</body>
</html>
