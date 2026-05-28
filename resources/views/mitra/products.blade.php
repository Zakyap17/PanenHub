<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <title>Hasil Panen Saya | PanenHub</title>
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
                    <button type="submit" class="border border-red-200 hover:bg-red-50 text-red-650 text-xs font-bold py-2 px-5 rounded-full transition-colors shadow-sm">Logout</button>
                </form>
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <div class="max-w-7xl w-full mx-auto flex-grow flex flex-col md:flex-row py-8 px-4 sm:px-6 lg:px-8 gap-8">
        
        <!-- Sidebar Navigation -->
        <aside class="w-full md:w-64 flex-shrink-0">
            <div class="bg-white rounded-3xl border border-slate-100 p-4 shadow-sm space-y-2 sticky top-24">
                <a href="{{ route('mitra.dashboard') }}" class="w-full flex items-center gap-3 py-3.5 px-4 rounded-2xl text-sm font-bold transition-all text-slate-600 hover:bg-slate-50 hover:text-brand-700">
                    <span class="material-icons">grid_view</span>
                    <span>Ringkasan</span>
                </a>
                <a href="{{ route('mitra.products') }}" class="w-full flex items-center gap-3 py-3.5 px-4 rounded-2xl text-sm font-bold transition-all bg-brand-700 text-white shadow-md shadow-brand-700/10">
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
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Hasil Panen Saya</h2>
                    <p class="text-sm font-medium text-slate-500 mt-1">Kelola semua produk hasil tani yang Anda jual di PanenHub.</p>
                </div>
                <button data-bs-toggle="modal" data-bs-target="#addProductModal" class="bg-brand-700 hover:bg-brand-800 text-white font-bold py-2.5 px-6 rounded-full text-xs transition-all inline-flex items-center justify-center gap-1.5 shadow-md shadow-brand-700/10">
                    <span class="material-icons text-sm">add</span> Tambah Produk Baru
                </button>
            </div>

            @if(session('success'))
                <div class="p-4 rounded-2xl bg-brand-50 text-brand-700 text-sm border border-brand-100 flex items-center gap-3 shadow-sm">
                    <span class="material-icons text-brand-700">check_circle</span>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="p-4 rounded-2xl bg-red-50 text-red-750 text-sm border border-red-100 shadow-sm space-y-1">
                    <div class="flex items-center gap-2 font-bold text-red-800">
                        <span class="material-icons text-red-650">error</span> Terjadi kesalahan:
                    </div>
                    <ul class="list-disc list-inside pl-4 font-semibold text-red-700 space-y-0.5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if($products->isEmpty())
                <!-- Empty State Product -->
                <div class="bg-white rounded-3xl border border-slate-200 border-dashed p-12 text-center max-w-xl mx-auto space-y-5 shadow-sm my-8">
                    <div class="w-20 h-20 bg-brand-50 rounded-full flex items-center justify-center mx-auto border border-brand-100">
                        <span class="material-icons text-brand-700 text-3xl">inventory_2</span>
                    </div>
                    <div class="space-y-2">
                        <h4 class="text-lg font-bold text-slate-800">Belum Ada Produk</h4>
                        <p class="text-sm font-medium text-slate-400 max-w-sm mx-auto leading-relaxed">Anda belum mendaftarkan hasil panen. Mulai tambahkan produk pertama Anda agar pembeli bisa melakukan transaksi!</p>
                    </div>
                    <button data-bs-toggle="modal" data-bs-target="#addProductModal" class="bg-brand-700 hover:bg-brand-800 text-white font-bold py-3 px-8 rounded-full text-xs transition-colors inline-flex items-center gap-1.5 shadow-md shadow-brand-700/10">
                        <span class="material-icons text-sm">add</span> Tambah Produk Pertama
                    </button>
                </div>
            @else
                <!-- Info Bar Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Total Produk Card -->
                    <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm flex items-center justify-between">
                        <div class="space-y-1">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Produk Terdaftar</span>
                            <h3 class="text-2xl font-extrabold text-brand-700">{{ $products->count() }} Produk</h3>
                            <span class="text-xs text-slate-400 block font-medium">Aktif di etalase</span>
                        </div>
                        <div class="w-12 h-12 bg-brand-50 rounded-2xl flex items-center justify-center border border-brand-100 text-brand-700">
                            <span class="material-icons">inventory_2</span>
                        </div>
                    </div>

                    <!-- Total Stok Card -->
                    <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm flex items-center justify-between">
                        <div class="space-y-1">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Total Stok</span>
                            <h3 class="text-2xl font-extrabold text-slate-900">{{ number_format($products->sum('stock'), 0, ',', '.') }} kg</h3>
                            <span class="text-xs text-slate-400 block font-medium">Keseluruhan hasil panen</span>
                        </div>
                        <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center border border-amber-100 text-amber-700">
                            <span class="material-icons">layers</span>
                        </div>
                    </div>
                </div>

                <!-- Product Table Card -->
                <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden mt-6">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-100">
                                    <th class="py-4 px-6 text-xs font-bold text-slate-400 uppercase tracking-wider">Produk</th>
                                    <th class="py-4 px-6 text-xs font-bold text-slate-400 uppercase tracking-wider">Kategori</th>
                                    <th class="py-4 px-6 text-xs font-bold text-slate-400 uppercase tracking-wider">Harga</th>
                                    <th class="py-4 px-6 text-xs font-bold text-slate-400 uppercase tracking-wider">Stok</th>
                                    <th class="py-4 px-6 text-xs font-bold text-slate-400 uppercase tracking-wider text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($products as $product)
                                    <tr class="hover:bg-slate-50/50 transition-colors">
                                        <td class="py-4 px-6">
                                            <div class="flex items-center gap-4">
                                                <div class="w-14 h-14 rounded-2xl overflow-hidden bg-slate-100 border border-slate-100 flex-shrink-0">
                                                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover" onerror="this.src='https://images.unsplash.com/photo-1536304997881-a372c179924b?q=80&w=600'">
                                                </div>
                                                <div class="space-y-0.5">
                                                    <h4 class="font-bold text-slate-800 text-sm sm:text-base leading-snug">{{ $product->name }}</h4>
                                                    <span class="text-[10px] text-slate-400 block font-bold uppercase tracking-wider">Ditambahkan {{ $product->created_at->diffForHumans() }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6 whitespace-nowrap">
                                            <span class="bg-brand-50 text-brand-700 text-[10px] font-extrabold uppercase tracking-wider py-1 px-3 rounded-full border border-brand-100/50">
                                                {{ $product->category }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-6 whitespace-nowrap">
                                            <span class="text-sm font-extrabold text-brand-700">Rp {{ number_format($product->price, 0, ',', '.') }}<span class="text-[10px] text-slate-450 font-semibold">/kg</span></span>
                                        </td>
                                        <td class="py-4 px-6 whitespace-nowrap">
                                            <span class="bg-amber-50 text-amber-700 text-[11px] font-extrabold uppercase tracking-wider py-1 px-3 rounded-full border border-amber-100/50">
                                                {{ $product->stock }} kg
                                            </span>
                                        </td>
                                        <td class="py-4 px-6 whitespace-nowrap">
                                            <div class="flex items-center justify-center gap-2">
                                                <button onclick="openEditModal({{ $product->id }}, '{{ addslashes($product->name) }}', '{{ $product->category }}', {{ $product->price }}, {{ $product->stock }}, '{{ $product->location }}')" 
                                                    class="border border-brand-200 hover:bg-brand-50 text-brand-700 text-xs font-bold py-1.5 px-4 rounded-full transition-colors flex items-center gap-1 shadow-sm">
                                                    <span class="material-icons text-sm">edit</span> Edit
                                                </button>
                                                <form action="{{ route('product.destroy', $product->id) }}" method="POST" class="m-0" onsubmit="return confirm('Yakin ingin menghapus produk {{ $product->name }}?')">
                                                    @csrf
                                                    <button type="submit" class="border border-red-200 hover:bg-red-50 text-red-650 text-xs font-bold py-1.5 px-4 rounded-full transition-colors flex items-center gap-1 shadow-sm">
                                                        <span class="material-icons text-sm">delete</span> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
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

    <!-- Modal Tambah Produk -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-2xl rounded-3xl overflow-hidden p-6 sm:p-8">
                <div class="flex items-center justify-between border-b border-slate-50 pb-4 mb-6">
                    <h5 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                        <span class="material-icons text-brand-700">add_circle</span> Tambah Hasil Panen
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Nama Hasil Panen</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"><span class="material-icons">shopping_basket</span></span>
                            <input type="text" name="name" placeholder="Contoh: Beras Pandan Wangi Premium" required
                                class="pl-11 pr-4 py-3 w-full bg-white border border-slate-200 rounded-2xl focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition-all text-sm font-semibold">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Kategori</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"><span class="material-icons">category</span></span>
                            <select name="category" required
                                class="pl-11 pr-4 py-3 w-full bg-white border border-slate-200 rounded-2xl focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition-all text-sm font-semibold appearance-none">
                                <option value="">Pilih Kategori</option>
                                <option value="Beras">Beras</option>
                                <option value="Sayur">Sayur</option>
                                <option value="Buah">Buah</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Lokasi Lahan</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"><span class="material-icons">location_on</span></span>
                            <select name="location"
                                class="pl-11 pr-4 py-3 w-full bg-white border border-slate-200 rounded-2xl focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition-all text-sm font-semibold appearance-none">
                                <option value="">Pilih Wilayah Lahan</option>
                                <option value="Jawa Barat">Jawa Barat</option>
                                <option value="Jawa Tengah">Jawa Tengah</option>
                                <option value="Jawa Timur">Jawa Timur</option>
                            </select>
                        </div>
                        <div class="text-[10px] text-slate-400 font-medium">Wilayah ini diambil dari data profil Anda dan dipakai untuk filter pencarian di marketplace.</div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Harga (Rp/kg)</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"><span class="material-icons">payments</span></span>
                                <input type="number" name="price" placeholder="Contoh: 15000" min="100" required
                                    class="pl-11 pr-4 py-3 w-full bg-white border border-slate-200 rounded-2xl focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition-all text-sm font-semibold">
                            </div>
                            <div class="text-[10px] text-brand-700 font-medium">Tulis angka saja tanpa titik.</div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Stok (kg)</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"><span class="material-icons">inventory_2</span></span>
                                <input type="number" name="stock" placeholder="Contoh: 100" min="1" required
                                    class="pl-11 pr-4 py-3 w-full bg-white border border-slate-200 rounded-2xl focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition-all text-sm font-semibold">
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Foto Hasil Panen</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"><span class="material-icons">image</span></span>
                            <input type="file" name="image" accept="image/jpeg,image/png,image/jpg" required
                                class="pl-11 pr-4 py-3 w-full bg-white border border-slate-200 rounded-2xl focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition-all text-sm font-semibold file:mr-4 file:py-0 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100">
                        </div>
                        <div class="text-[10px] text-slate-450 font-medium">Format JPG/PNG, Maksimal 2MB.</div>
                    </div>
                    <button type="submit" class="w-full bg-brand-700 hover:bg-brand-800 text-white font-bold py-3.5 rounded-2xl transition-all shadow-md shadow-brand-700/10 flex items-center justify-center gap-1.5">
                        <span class="material-icons text-sm">save</span><span>Simpan Hasil Panen</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Produk -->
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-2xl rounded-3xl overflow-hidden p-6 sm:p-8">
                <div class="flex items-center justify-between border-b border-slate-50 pb-4 mb-6">
                    <h5 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                        <span class="material-icons text-brand-700">edit_note</span> Edit Hasil Panen
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editProductForm" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Nama Hasil Panen</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"><span class="material-icons">shopping_basket</span></span>
                            <input type="text" name="name" id="edit_name" required
                                class="pl-11 pr-4 py-3 w-full bg-white border border-slate-200 rounded-2xl focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition-all text-sm font-semibold">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Kategori</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"><span class="material-icons">category</span></span>
                            <select name="category" id="edit_category" required
                                class="pl-11 pr-4 py-3 w-full bg-white border border-slate-200 rounded-2xl focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition-all text-sm font-semibold">
                                <option value="Beras">Beras</option>
                                <option value="Sayur">Sayur</option>
                                <option value="Buah">Buah</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Lokasi Lahan</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"><span class="material-icons">location_on</span></span>
                            <select name="location" id="edit_location"
                                class="pl-11 pr-4 py-3 w-full bg-white border border-slate-200 rounded-2xl focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition-all text-sm font-semibold appearance-none">
                                <option value="">Pilih Wilayah Lahan</option>
                                <option value="Jawa Barat">Jawa Barat</option>
                                <option value="Jawa Tengah">Jawa Tengah</option>
                                <option value="Jawa Timur">Jawa Timur</option>
                            </select>
                        </div>
                        <div class="text-[10px] text-slate-400 font-medium">Wilayah ini diambil dari data profil Anda dan dipakai untuk filter pencarian di marketplace.</div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Harga (Rp/kg)</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"><span class="material-icons">payments</span></span>
                                <input type="number" name="price" id="edit_price" min="100" required
                                    class="pl-11 pr-4 py-3 w-full bg-white border border-slate-200 rounded-2xl focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition-all text-sm font-semibold">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Stok (kg)</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"><span class="material-icons">inventory_2</span></span>
                                <input type="number" name="stock" id="edit_stock" min="1" required
                                    class="pl-11 pr-4 py-3 w-full bg-white border border-slate-200 rounded-2xl focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition-all text-sm font-semibold">
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Foto Baru (Biarkan kosong jika tidak diganti)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"><span class="material-icons">image</span></span>
                            <input type="file" name="image" accept="image/jpeg,image/png,image/jpg"
                                class="pl-11 pr-4 py-3 w-full bg-white border border-slate-200 rounded-2xl focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition-all text-sm font-semibold file:mr-4 file:py-0 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100">
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-brand-700 hover:bg-brand-800 text-white font-bold py-3.5 rounded-2xl transition-all shadow-md shadow-brand-700/10 flex items-center justify-center gap-1.5">
                        <span class="material-icons text-sm">save</span><span>Simpan Perubahan</span>
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
        function openEditModal(id, name, category, price, stock, location) {
            const form = document.getElementById('editProductForm');
            form.action = '/api/products/' + id + '/update';
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_category').value = category;
            document.getElementById('edit_price').value = price;
            document.getElementById('edit_stock').value = stock;
            document.getElementById('edit_location').value = location || '';
            new bootstrap.Modal(document.getElementById('editProductModal')).show();
        }
    </script>
</body>
</html>
