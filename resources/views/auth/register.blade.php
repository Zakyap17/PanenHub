<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar Mitra Petani | PanenHub</title>
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
            background: radial-gradient(circle at 10% 10%, rgba(46, 125, 50, 0.03) 0%, transparent 40%),
                        radial-gradient(circle at 90% 90%, rgba(46, 125, 50, 0.03) 0%, transparent 40%);
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
                <a href="/login" class="bg-brand-700 hover:bg-brand-800 text-white font-semibold py-2 px-6 rounded-full transition-colors shadow-sm shadow-brand-700/10">Masuk</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl w-full">
            <!-- Form Card Container -->
            <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-100 p-8 sm:p-12 transition-all">
                
                <!-- Titles -->
                <div class="mb-10">
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-950 tracking-tight">Bergabunglah Sebagai Mitra Petani</h2>
                    <p class="mt-2 text-gray-500 leading-relaxed font-medium">
                        Mulai perjalanan sukses Anda bersama ribuan petani lainnya di PanenHub.
                    </p>
                </div>

                <!-- Progress Bar Section -->
                <div class="mb-10 space-y-2.5">
                    <div class="flex justify-between items-center text-sm font-bold text-gray-700">
                        <span>Langkah 1 dari 3: Data Diri</span>
                        <span class="text-brand-700">33%</span>
                    </div>
                    <!-- Progress track -->
                    <div class="w-full h-2.5 bg-gray-100 rounded-full overflow-hidden">
                        <div class="w-1/3 h-full bg-brand-700 rounded-full transition-all duration-500"></div>
                    </div>
                </div>

                <!-- Errors Alert -->
                @if($errors->has('msg'))
                    <div class="alert alert-danger mb-8 p-4 rounded-2xl bg-red-50 text-red-700 text-sm border border-red-100 flex items-start gap-3">
                        <span class="material-icons text-lg">warning</span>
                        <span class="font-medium">{{ $errors->first('msg') }}</span>
                    </div>
                @endif

                <!-- Register Form -->
                <form action="/api/register-mitra" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <!-- Nama Lengkap -->
                        <div class="space-y-2">
                            <label for="name" class="text-xs font-bold text-gray-600 uppercase tracking-wider block">Nama Lengkap</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                    <span class="material-icons">person</span>
                                </span>
                                <input type="text" name="name" id="name" placeholder="Sesuai KTP" required
                                    class="pl-11 pr-4 py-3.5 w-full bg-white border border-gray-200 rounded-2xl focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition-all text-gray-800 placeholder-gray-300 font-medium">
                            </div>
                        </div>

                        <!-- Nomor KTP (NIK) -->
                        <div class="space-y-2">
                            <label for="nik" class="text-xs font-bold text-gray-600 uppercase tracking-wider block">Nomor KTP (NIK)</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                    <span class="material-icons">badge</span>
                                </span>
                                <input type="text" name="nik" id="nik" placeholder="16 digit angka" required pattern="\d{16}" title="NIK harus berupa 16 digit angka"
                                    class="pl-11 pr-4 py-3.5 w-full bg-white border border-gray-200 rounded-2xl focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition-all text-gray-800 placeholder-gray-300 font-medium">
                            </div>
                        </div>

                        <!-- Nomor WhatsApp -->
                        <div class="space-y-2">
                            <label for="phone" class="text-xs font-bold text-gray-600 uppercase tracking-wider block">Nomor WhatsApp</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                    <span class="material-icons">call</span>
                                </span>
                                <input type="text" name="phone" id="phone" placeholder="08xx-xxxx-xxxx" required autocomplete="tel"
                                    class="pl-11 pr-4 py-3.5 w-full bg-white border border-gray-200 rounded-2xl focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition-all text-gray-800 placeholder-gray-300 font-medium">
                            </div>
                        </div>

                        <!-- Kata Sandi -->
                        <div class="space-y-2">
                            <label for="password" class="text-xs font-bold text-gray-600 uppercase tracking-wider block">Kata Sandi</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                    <span class="material-icons">lock</span>
                                </span>
                                <input type="password" name="password" id="password" placeholder="Minimal 8 karakter" required minlength="8"
                                    class="pl-11 pr-4 py-3.5 w-full bg-white border border-gray-200 rounded-2xl focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition-all text-gray-800 placeholder-gray-300 font-medium">
                            </div>
                        </div>

                    </div>

                    <!-- Alamat Domisili -->
                    <div class="space-y-2">
                        <label for="address" class="text-xs font-bold text-gray-600 uppercase tracking-wider block">Alamat Domisili</label>
                        <div class="relative">
                            <span class="absolute left-4 top-4 text-gray-400">
                                <span class="material-icons">home_pin</span>
                            </span>
                            <textarea name="address" id="address" rows="3" placeholder="Alamat lengkap tempat tinggal saat ini" required
                                class="pl-11 pr-4 py-3.5 w-full bg-white border border-gray-200 rounded-2xl focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition-all text-gray-800 placeholder-gray-300 font-medium resize-none"></textarea>
                        </div>
                    </div>

                    <!-- Consent Checkbox -->
                    <div class="flex items-start gap-3 pt-2">
                        <input type="checkbox" id="terms" required
                            class="mt-1 h-4 w-4 rounded border-gray-300 text-brand-700 focus:ring-brand-600/20">
                        <label for="terms" class="text-sm text-gray-500 font-medium leading-relaxed">
                            Saya menyetujui <a href="#" class="text-brand-700 hover:text-brand-800 font-bold transition-colors">Syarat & Ketentuan</a> serta <a href="#" class="text-brand-700 hover:text-brand-800 font-bold transition-colors">Kebijakan Privasi</a> yang berlaku di PanenHub.
                        </label>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row items-center gap-4 pt-6 border-t border-gray-100">
                        <!-- Masuk Akun (outline btn) -->
                        <a href="/login" class="w-full sm:w-1/3 border border-gray-200 hover:bg-gray-50 text-gray-700 font-bold py-3.5 px-4 rounded-2xl transition-colors text-center block">
                            Masuk Akun
                        </a>
                        
                        <!-- Lanjut Daftar (solid green btn) -->
                        <button type="submit" class="w-full sm:w-2/3 bg-brand-700 hover:bg-brand-800 text-white font-bold py-3.5 px-4 rounded-2xl transition-all shadow-lg shadow-brand-700/10 flex items-center justify-center gap-2 group">
                            <span>Lanjut Daftar</span>
                            <span class="material-icons transition-transform group-hover:translate-x-1">arrow_forward</span>
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="py-6 px-4 border-t border-gray-100 bg-white">
        <div class="max-w-7xl mx-auto text-center text-xs text-gray-400 font-medium">
            © 2024 PanenHub Agritech Ecosystem. Semua Hak Dilindungi.
        </div>
    </footer>

</body>
</html>
