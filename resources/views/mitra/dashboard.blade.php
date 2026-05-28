<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <title>Dashboard Utama | PanenHub</title>
    <!-- Tailwind CSS -->
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
    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Bootstrap CSS for Modal functionality only, keeping layout completely Tailwind -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
        }
        .material-icons {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            vertical-align: middle;
        }
    </style>
</head>
<body class="min-h-screen bg-slate-50 flex flex-col justify-between">

    <!-- Header / Navbar -->
    <header class="bg-white border-b border-slate-100 py-4 px-6 md:px-12 sticky top-0 z-40">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <a href="#" data-bs-toggle="modal" data-bs-target="#backToHomeModal" class="flex items-center gap-3">
                <img src="{{ asset('images/logo-icon.png') }}" alt="Logo" class="h-9 w-auto">
                <div class="flex flex-col">
                    <span class="text-lg font-bold text-gray-900 leading-none tracking-tight">PanenHub</span>
                    <span class="text-xs font-semibold text-brand-700 mt-0.5">Mitra Panel</span>
                </div>
            </a>
            
            <div class="flex items-center gap-3">
                <div class="hidden sm:flex flex-col items-end mr-2">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Mitra Tani</span>
                    <span class="text-sm font-bold text-slate-800">{{ Auth::user()->name }}</span>
                </div>
                <!-- Action Buttons -->
                <button data-bs-toggle="modal" data-bs-target="#backToHomeModal" class="border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-bold py-2 px-4 rounded-full transition-colors flex items-center gap-1.5 shadow-sm">
                    <span class="material-icons text-sm">home</span> Beranda
                </button>
                <button data-bs-toggle="modal" data-bs-target="#editProfileModal" class="border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-bold py-2 px-4 rounded-full transition-colors flex items-center gap-1.5 shadow-sm">
                    <span class="material-icons text-sm">edit</span> Edit Nama
                </button>
                <form action="/api/logout" method="POST" class="m-0" onsubmit="localStorage.removeItem('panenhub_cart')">
                    @csrf
                    <button type="submit" class="border border-red-200 hover:bg-red-50 text-red-655 text-xs font-bold py-2 px-5 rounded-full transition-colors shadow-sm">Logout</button>
                </form>
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <div class="max-w-7xl w-full mx-auto flex-grow flex flex-col md:flex-row py-8 px-4 sm:px-6 lg:px-8 gap-8">
        
        <!-- Sidebar Navigation -->
        <aside class="w-full md:w-64 flex-shrink-0">
            <div class="bg-white rounded-3xl border border-slate-100 p-4 shadow-sm space-y-2 sticky top-24">
                <a href="{{ route('mitra.dashboard') }}" class="w-full flex items-center gap-3 py-3.5 px-4 rounded-2xl text-sm font-bold transition-all bg-brand-700 text-white shadow-md shadow-brand-700/10">
                    <span class="material-icons">grid_view</span>
                    <span>Ringkasan</span>
                </a>
                <a href="{{ route('mitra.products') }}" class="w-full flex items-center gap-3 py-3.5 px-4 rounded-2xl text-sm font-bold transition-all text-slate-600 hover:bg-slate-50 hover:text-brand-700">
                    <span class="material-icons">inventory_2</span>
                    <span>Hasil Panen Saya</span>
                </a>
                <a href="{{ route('mitra.orders') }}" class="w-full flex items-center gap-3 py-3.5 px-4 rounded-2xl text-sm font-bold transition-all text-slate-600 hover:bg-slate-50 hover:text-brand-700">
                    <span class="material-icons">receipt_long</span>
                    <span>Daftar Pesanan</span>
                </a>
                <a href="{{ route('mitra.chat') }}" class="w-full flex items-center gap-3 py-3.5 px-4 rounded-2xl text-sm font-bold transition-all text-slate-600 hover:bg-slate-50 hover:text-brand-700">
                    <span class="material-icons">chat</span>
                    <span>Pesan Masuk</span>
                </a>
            </div>
        </aside>

        <!-- Content Area -->
        <main class="flex-grow space-y-8">
            <div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Dashboard Utama</h2>
                <p class="text-sm font-medium text-slate-500 mt-1">Selamat datang kembali! Pantau kinerja toko tani Anda secara realtime.</p>
            </div>

            @if(session('success'))
                <div class="p-4 rounded-2xl bg-brand-50 text-brand-700 text-sm border border-brand-100 flex items-center gap-3 shadow-sm">
                    <span class="material-icons text-brand-700">check_circle</span>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <!-- Revenue Card -->
                <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm relative overflow-hidden flex items-start justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Total Pendapatan</span>
                        <h3 class="text-2xl font-extrabold text-brand-700 font-sans">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                        <span class="text-xs text-slate-400 block font-medium">Bulan ini</span>
                    </div>
                    <div class="bg-brand-50 text-brand-700 rounded-2xl p-3 border border-brand-100/50 flex items-center justify-center">
                        <span class="material-icons text-2xl">payments</span>
                    </div>
                </div>

                <!-- Active Orders Card -->
                <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm relative overflow-hidden flex items-start justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Pesanan Aktif</span>
                        <h3 class="text-2xl font-extrabold text-slate-900">{{ $activeOrdersCount }}</h3>
                        <span class="text-xs text-slate-400 block font-medium">Perlu diproses/dikirim</span>
                    </div>
                    <div class="bg-amber-50 text-amber-700 rounded-2xl p-3 border border-amber-100 flex items-center justify-center">
                        <span class="material-icons text-2xl">pending_actions</span>
                    </div>
                </div>

                <!-- Products Display Card -->
                <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm relative overflow-hidden flex items-start justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Produk Tayang</span>
                        <h3 class="text-2xl font-extrabold text-slate-900">{{ $totalProducts }}</h3>
                        <span class="text-xs text-slate-400 block font-medium">Tersedia di PanenHub</span>
                    </div>
                    <div class="bg-blue-50 text-blue-700 rounded-2xl p-3 border border-blue-100 flex items-center justify-center">
                        <span class="material-icons text-2xl">storefront</span>
                    </div>
                </div>
            </div>

            <!-- Product Panel Section -->
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-slate-900 tracking-tight">Produk Terbaru</h3>
                    <a href="{{ route('mitra.products') }}" class="border border-slate-200 hover:bg-slate-50 text-brand-700 text-xs font-bold py-2 px-5 rounded-full transition-colors flex items-center gap-1 shadow-sm">
                        Kelola Semua <span class="material-icons text-sm">arrow_forward</span>
                    </a>
                </div>

                @if($products->isEmpty())
                    <!-- Empty State Product -->
                    <div class="bg-white rounded-3xl border border-slate-200 border-dashed p-8 text-center max-w-lg mx-auto space-y-4 shadow-sm">
                        <div class="w-16 h-16 bg-brand-50 rounded-full flex items-center justify-center mx-auto border border-brand-100">
                            <span class="material-icons text-brand-700 text-2xl">inventory_2</span>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-slate-800">Belum Ada Hasil Panen</h4>
                            <p class="text-sm font-medium text-slate-400 mt-1 max-w-xs mx-auto leading-relaxed">Mulai daftarkan beras atau hasil tani Anda agar bisa dibeli.</p>
                        </div>
                        <a href="{{ route('mitra.products') }}" class="bg-brand-700 hover:bg-brand-800 text-white font-bold py-2.5 px-6 rounded-full text-xs transition-colors inline-flex items-center gap-1.5 shadow-md shadow-brand-700/10">
                            Kelola Produk <span class="material-icons text-sm">arrow_forward</span>
                        </a>
                    </div>
                @else
                    <!-- Product Grid (Latest 3) -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                        @foreach($products as $product)
                            <div class="bg-white rounded-3xl border border-slate-100 overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                                <div class="h-40 w-full overflow-hidden bg-slate-100 relative">
                                    <img src="{{ asset('storage/'.$product->image) }}" class="w-full h-full object-cover" alt="{{ $product->name }}" onerror="this.src='https://images.unsplash.com/photo-1536304997881-a372c179924b?q=80&w=600'">
                                    <span class="absolute top-3 left-3 bg-brand-50/90 backdrop-blur-sm border border-brand-100/50 text-brand-700 text-[10px] font-extrabold uppercase tracking-wider py-1 px-2.5 rounded-full">
                                        {{ $product->category }}
                                    </span>
                                </div>
                                <div class="p-5 space-y-3">
                                    <div>
                                        <h6 class="font-bold text-slate-850 truncate" title="{{ $product->name }}">{{ $product->name }}</h6>
                                        <span class="text-xs font-bold text-slate-400">Tersedia: {{ $product->stock }} kg</span>
                                    </div>
                                    <div class="flex items-center justify-between border-t border-slate-50 pt-3">
                                        <span class="text-xs font-bold text-slate-400">Harga Jual</span>
                                        <span class="text-sm font-extrabold text-brand-700">Rp {{ number_format($product->price, 0, ',', '.') }}<span class="text-[10px] text-slate-400 font-medium">/kg</span></span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Bank Accounts Section -->
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-slate-900 tracking-tight">Rekening Bank Saya</h3>
                    <button data-bs-toggle="modal" data-bs-target="#addBankModal" class="border border-slate-200 hover:bg-slate-50 text-brand-700 text-xs font-bold py-2 px-5 rounded-full transition-colors flex items-center gap-1 shadow-sm">
                        <span class="material-icons text-sm">add</span> Tambah Rekening
                    </button>
                </div>

                @if($banks->isEmpty())
                    <!-- Empty State Bank -->
                    <div class="bg-white rounded-3xl border border-slate-200 border-dashed p-8 text-center max-w-lg mx-auto space-y-4 shadow-sm">
                        <div class="w-16 h-16 bg-brand-50 rounded-full flex items-center justify-center mx-auto border border-brand-100">
                            <span class="material-icons text-brand-700 text-2xl">account_balance_wallet</span>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-slate-800">Belum Ada Rekening</h4>
                            <p class="text-sm font-medium text-slate-400 mt-1 max-w-xs mx-auto leading-relaxed">Tambahkan rekening bank agar pembeli bisa membayar pesanan Anda.</p>
                        </div>
                    </div>
                @else
                    <!-- Bank Cards Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                        @foreach($banks as $bank)
                            <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm space-y-4 hover:shadow-md transition-shadow relative group">
                                <!-- Actions -->
                                <div class="absolute top-4 right-4 flex items-center gap-1">
                                    <button onclick="openEditBankModal({{ $bank->id }}, '{{ $bank->bank_name }}', '{{ $bank->account_number }}', '{{ $bank->account_name }}')" class="w-7 h-7 rounded-full hover:bg-slate-100 text-brand-700 flex items-center justify-center transition-colors">
                                        <span class="material-icons text-sm">edit</span>
                                    </button>
                                    <form action="{{ route('mitra.bank.destroy', $bank->id) }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" onclick="return confirm('Hapus rekening ini?')" class="w-7 h-7 rounded-full hover:bg-red-50 text-red-650 flex items-center justify-center transition-colors">
                                            <span class="material-icons text-sm text-red-650">delete</span>
                                        </button>
                                    </form>
                                </div>
                                
                                <div class="space-y-1">
                                    <span class="text-[10px] font-extrabold text-brand-700 uppercase tracking-widest bg-brand-50 border border-brand-100/50 py-1 px-2.5 rounded-full inline-flex items-center gap-1.5">
                                        <span class="material-icons text-xs">account_balance</span> {{ $bank->bank_name }}
                                    </span>
                                    <h4 class="text-xl font-extrabold text-slate-900 tracking-tight pt-2">{{ $bank->account_number }}</h4>
                                    <span class="text-xs font-bold text-slate-400 block uppercase tracking-wider">a/n {{ $bank->account_name }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </main>
    </div>

    <!-- Modals System -->
    <!-- Modal Kembali ke Beranda -->
    <div class="modal fade" id="backToHomeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0 shadow-2xl rounded-3xl overflow-hidden p-6 text-center space-y-4">
                <div class="w-16 h-16 bg-brand-50 rounded-full flex items-center justify-center mx-auto border border-brand-100 text-brand-700">
                    <span class="material-icons text-3xl">home</span>
                </div>
                <div class="space-y-2">
                    <h5 class="text-base font-bold text-slate-900">Kembali ke Beranda?</h5>
                    <p class="text-xs font-medium text-slate-450 leading-relaxed">Apakah Anda yakin ingin keluar dari Mitra Panel dan kembali ke halaman utama?</p>
                </div>
                <div class="grid grid-cols-2 gap-3 pt-2">
                    <button type="button" class="border border-slate-200 hover:bg-slate-50 text-slate-550 font-bold py-2.5 rounded-2xl text-xs transition-colors" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <a href="/" class="bg-brand-700 hover:bg-brand-800 text-white font-bold py-2.5 rounded-2xl text-xs transition-colors inline-flex items-center justify-center">
                        Ya, Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add Bank -->
    <div class="modal fade" id="addBankModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-2xl rounded-3xl overflow-hidden p-6 sm:p-8">
                <div class="flex items-center justify-between border-b border-slate-50 pb-4 mb-6">
                    <h5 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                        <span class="material-icons text-brand-700">account_balance_wallet</span> Tambah Rekening
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('mitra.bank.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Nama Bank / e-Wallet</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"><span class="material-icons">account_balance</span></span>
                            <input type="text" name="bank_name" placeholder="Contoh: BCA, Mandiri, OVO, dll." required
                                class="pl-11 pr-4 py-3 w-full bg-white border border-slate-200 rounded-2xl focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition-all text-sm font-semibold">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Nomor Rekening</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"><span class="material-icons">credit_card</span></span>
                            <input type="text" name="account_number" placeholder="Contoh: 081234567890" required
                                class="pl-11 pr-4 py-3 w-full bg-white border border-slate-200 rounded-2xl focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition-all text-sm font-semibold">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Atas Nama (a/n)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"><span class="material-icons">person</span></span>
                            <input type="text" name="account_name" placeholder="Sesuai buku tabungan" required
                                class="pl-11 pr-4 py-3 w-full bg-white border border-slate-200 rounded-2xl focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition-all text-sm font-semibold">
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-brand-700 hover:bg-brand-800 text-white font-bold py-3.5 rounded-2xl transition-all shadow-md shadow-brand-700/10 flex items-center justify-center gap-1">
                        <span>Simpan Rekening</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Bank -->
    <div class="modal fade" id="editBankModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-2xl rounded-3xl overflow-hidden p-6 sm:p-8">
                <div class="flex items-center justify-between border-b border-slate-50 pb-4 mb-6">
                    <h5 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                        <span class="material-icons text-brand-700">edit_note</span> Edit Rekening
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editBankForm" method="POST" class="space-y-5">
                    @csrf
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Nama Bank / e-Wallet</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"><span class="material-icons">account_balance</span></span>
                            <input type="text" name="bank_name" id="edit_bank_name" required
                                class="pl-11 pr-4 py-3 w-full bg-white border border-slate-200 rounded-2xl focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition-all text-sm font-semibold">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Nomor Rekening</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"><span class="material-icons">credit_card</span></span>
                            <input type="text" name="account_number" id="edit_account_number" required
                                class="pl-11 pr-4 py-3 w-full bg-white border border-slate-200 rounded-2xl focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition-all text-sm font-semibold">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Atas Nama (a/n)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"><span class="material-icons">person</span></span>
                            <input type="text" name="account_name" id="edit_account_name" required
                                class="pl-11 pr-4 py-3 w-full bg-white border border-slate-200 rounded-2xl focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition-all text-sm font-semibold">
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-brand-700 hover:bg-brand-800 text-white font-bold py-3.5 rounded-2xl transition-all shadow-md shadow-brand-700/10 flex items-center justify-center gap-1">
                        <span>Simpan Perubahan</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Profile -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-2xl rounded-3xl overflow-hidden p-6 sm:p-8">
                <div class="flex items-center justify-between border-b border-slate-50 pb-4 mb-6">
                    <h5 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                        <span class="material-icons text-brand-700">settings</span> Pengaturan Profil
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('profile.update') }}" method="POST" class="space-y-5">
                    @csrf
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Nama Mitra / Usaha</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"><span class="material-icons">store</span></span>
                            <input type="text" name="name" value="{{ Auth::user()->name }}" required
                                class="pl-11 pr-4 py-3 w-full bg-white border border-slate-200 rounded-2xl focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition-all text-sm font-semibold">
                        </div>
                        <div class="text-[11px] text-slate-400 font-medium">Nama ini akan muncul pada setiap produk yang Anda jual.</div>
                    </div>
                    <button type="submit" class="w-full bg-brand-700 hover:bg-brand-800 text-white font-bold py-3.5 rounded-2xl transition-all shadow-md shadow-brand-700/10 flex items-center justify-center gap-1">
                        <span>Perbarui Profil</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="py-6 px-4 border-t border-slate-100 bg-white">
        <div class="max-w-7xl mx-auto text-center text-xs text-slate-400 font-medium">
            © 2024 PanenHub Agritech Ecosystem. Semua Hak Dilindungi.
        </div>
    </footer>

    <!-- Bootstrap & Dynamic Modal helper Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function openEditBankModal(id, bankName, accountNumber, accountName) {
            const form = document.getElementById('editBankForm');
            form.action = '/api/bank/' + id + '/update';
            document.getElementById('edit_bank_name').value = bankName;
            document.getElementById('edit_account_number').value = accountNumber;
            document.getElementById('edit_account_name').value = accountName;
            new bootstrap.Modal(document.getElementById('editBankModal')).show();
        }
    </script>
</body>
</html>
