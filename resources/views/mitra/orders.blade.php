<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan | PanenHub</title>
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
                <a href="{{ route('mitra.products') }}" class="w-full flex items-center gap-3 py-3.5 px-4 rounded-2xl text-sm font-bold transition-all text-slate-600 hover:bg-slate-50 hover:text-brand-700">
                    <span class="material-icons">inventory_2</span>
                    <span>Hasil Panen Saya</span>
                </a>
                <a href="{{ route('mitra.orders') }}" class="w-full flex items-center gap-3 py-3.5 px-4 rounded-2xl text-sm font-bold transition-all bg-brand-700 text-white shadow-md shadow-brand-700/10">
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
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Daftar Pesanan</h2>
                <p class="text-sm font-medium text-slate-500 mt-1">Pantau pesanan masuk dari pelanggan PanenHub secara realtime.</p>
            </div>

            @if(session('success'))
                <div class="p-4 rounded-2xl bg-brand-50 text-brand-700 text-sm border border-brand-100 flex items-center gap-3 shadow-sm">
                    <span class="material-icons text-brand-700">check_circle</span>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Status Filter System -->
            <div class="bg-white rounded-3xl p-4 border border-slate-100 shadow-sm flex flex-wrap items-center gap-2">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider px-2">Filter Status:</span>
                <a href="{{ route('mitra.orders') }}" class="transition-all rounded-full text-xs font-bold py-2 px-5 {{ is_null($status) ? 'bg-brand-700 text-white shadow-md shadow-brand-700/10' : 'border border-slate-200 text-slate-600 hover:bg-slate-50' }}">
                    Semua
                </a>
                <a href="{{ route('mitra.orders', ['status' => 'menunggu']) }}" class="transition-all rounded-full text-xs font-bold py-2 px-5 {{ $status == 'menunggu' ? 'bg-brand-700 text-white shadow-md shadow-brand-700/10' : 'border border-slate-200 text-slate-600 hover:bg-slate-50' }}">
                    Menunggu
                </a>
                <a href="{{ route('mitra.orders', ['status' => 'diproses']) }}" class="transition-all rounded-full text-xs font-bold py-2 px-5 {{ $status == 'diproses' ? 'bg-brand-700 text-white shadow-md shadow-brand-700/10' : 'border border-slate-200 text-slate-600 hover:bg-slate-50' }}">
                    Diproses
                </a>
                <a href="{{ route('mitra.orders', ['status' => 'dikirim']) }}" class="transition-all rounded-full text-xs font-bold py-2 px-5 {{ $status == 'dikirim' ? 'bg-brand-700 text-white shadow-md shadow-brand-700/10' : 'border border-slate-200 text-slate-600 hover:bg-slate-50' }}">
                    Dikirim
                </a>
                <a href="{{ route('mitra.orders', ['status' => 'selesai']) }}" class="transition-all rounded-full text-xs font-bold py-2 px-5 {{ $status == 'selesai' ? 'bg-brand-700 text-white shadow-md shadow-brand-700/10' : 'border border-slate-200 text-slate-600 hover:bg-slate-50' }}">
                    Selesai
                </a>
            </div>

            <!-- Orders Content -->
            @if($orders->isEmpty())
                <!-- Empty State Orders -->
                <div class="bg-white rounded-3xl border border-slate-200 border-dashed p-12 text-center max-w-xl mx-auto space-y-5 shadow-sm my-8">
                    <div class="w-20 h-20 bg-brand-50 rounded-full flex items-center justify-center mx-auto border border-brand-100">
                        <span class="material-icons text-brand-700 text-3xl">receipt_long</span>
                    </div>
                    <div class="space-y-2">
                        <h4 class="text-lg font-bold text-slate-800">Belum Ada Pesanan</h4>
                        <p class="text-sm font-medium text-slate-400 max-w-sm mx-auto leading-relaxed">Pesanan dari pelanggan Anda akan tampil di sini. Pastikan produk Anda terdaftar dan memiliki stok yang cukup!</p>
                    </div>
                    <a href="{{ route('mitra.products') }}" class="bg-brand-700 hover:bg-brand-800 text-white font-bold py-3 px-8 rounded-full text-xs transition-colors inline-flex items-center gap-1.5 shadow-md shadow-brand-700/10">
                        <span class="material-icons text-sm">inventory_2</span> Kelola Produk Saya
                    </a>
                </div>
            @else
                <!-- Orders Table Card -->
                <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-100">
                                    <th class="py-4 px-6 text-xs font-bold text-slate-400 uppercase tracking-wider">No. Pesanan</th>
                                    <th class="py-4 px-6 text-xs font-bold text-slate-400 uppercase tracking-wider">Pembeli</th>
                                    <th class="py-4 px-6 text-xs font-bold text-slate-400 uppercase tracking-wider">Produk</th>
                                    <th class="py-4 px-6 text-xs font-bold text-slate-400 uppercase tracking-wider">Total Transaksi</th>
                                    <th class="py-4 px-6 text-xs font-bold text-slate-400 uppercase tracking-wider">Waktu</th>
                                    <th class="py-4 px-6 text-xs font-bold text-slate-400 uppercase tracking-wider">Status</th>
                                    <th class="py-4 px-6 text-xs font-bold text-slate-400 uppercase tracking-wider text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($orders as $order)
                                    <tr class="hover:bg-slate-50/50 transition-colors">
                                        <!-- Order Number -->
                                        <td class="py-4 px-6 whitespace-nowrap">
                                            <span class="text-sm font-extrabold text-slate-900 tracking-tight">{{ $order->order_number }}</span>
                                        </td>
                                        <!-- Buyer Details -->
                                        <td class="py-4 px-4" style="max-width: 200px;">
                                            <div class="space-y-1">
                                                <h5 class="text-sm font-bold text-slate-800 leading-snug">{{ $order->buyer->name }}</h5>
                                                <div class="text-[11px] text-slate-400 font-semibold flex items-start gap-1">
                                                    <span class="material-icons text-xs mt-0.5 flex-shrink-0">room</span>
                                                    <span class="leading-tight">{{ $order->address }}</span>
                                                </div>
                                            </div>
                                            @if($order->notes)
                                                <div class="mt-1.5 bg-slate-50 border border-slate-100 rounded-xl p-2 text-[10px] font-semibold text-slate-500 flex items-start gap-1">
                                                    <span class="material-icons text-xs text-slate-400 flex-shrink-0 mt-0.5">speaker_notes</span>
                                                    <span class="line-clamp-2">"{{ $order->notes }}"</span>
                                                </div>
                                            @endif
                                            <div class="flex flex-wrap items-center gap-1.5 mt-1.5">
                                                <span class="text-[9px] font-extrabold bg-brand-50 border border-brand-100 text-brand-700 py-0.5 px-2 rounded-full uppercase tracking-wider whitespace-nowrap">
                                                    {{ Str::limit($order->payment_method, 20) }}
                                                </span>
                                                @if($order->proof_of_payment)
                                                    <a href="{{ asset('storage/' . $order->proof_of_payment) }}" target="_blank" 
                                                       class="text-[9px] font-extrabold bg-blue-50 hover:bg-blue-100 border border-blue-100 text-blue-700 py-0.5 px-2 rounded-full uppercase tracking-wider flex items-center gap-0.5 transition-colors whitespace-nowrap">
                                                        <span class="material-icons text-xs">visibility</span> Bukti
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                        <!-- Products -->
                                        <td class="py-4 px-6">
                                            <div class="space-y-2">
                                                @foreach($order->items as $item)
                                                    <div class="flex items-center gap-2.5">
                                                        <div class="w-8 h-8 rounded-lg overflow-hidden bg-slate-100 border border-slate-100 flex-shrink-0">
                                                            <img src="{{ asset($item->product_image) }}" alt="product thumbnail" class="w-full h-full object-cover">
                                                        </div>
                                                        <span class="text-xs font-bold text-slate-700 max-w-[150px] truncate" title="{{ $item->product_name }}">
                                                            {{ $item->product_name }} <span class="text-brand-700 font-extrabold">({{ $item->quantity }}x)</span>
                                                        </span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </td>
                                        <!-- Total Transaksi -->
                                        <td class="py-4 px-6 whitespace-nowrap">
                                            <span class="text-sm font-extrabold text-brand-700">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                                        </td>
                                        <!-- Time -->
                                        <td class="py-4 px-6 whitespace-nowrap">
                                            <span class="text-xs font-bold text-slate-450">{{ $order->created_at->format('d M Y, H:i') }}</span>
                                        </td>
                                        <!-- Status Badge -->
                                        <td class="py-4 px-6 whitespace-nowrap">
                                            @if($order->status == 'menunggu')
                                                <span class="bg-amber-50 text-amber-700 border border-amber-100 text-[10px] font-extrabold uppercase tracking-wider py-1 px-3 rounded-full">
                                                    Menunggu
                                                </span>
                                            @elseif($order->status == 'diproses')
                                                <span class="bg-blue-50 text-blue-700 border border-blue-100 text-[10px] font-extrabold uppercase tracking-wider py-1 px-3 rounded-full">
                                                    Diproses
                                                </span>
                                            @elseif($order->status == 'dikirim')
                                                <span class="bg-purple-50 text-purple-700 border border-purple-100 text-[10px] font-extrabold uppercase tracking-wider py-1 px-3 rounded-full">
                                                    Dikirim
                                                </span>
                                            @else
                                                <span class="bg-brand-50 text-brand-700 border border-brand-100 text-[10px] font-extrabold uppercase tracking-wider py-1 px-3 rounded-full">
                                                    Selesai
                                                </span>
                                            @endif
                                        </td>
                                        <!-- Next Actions -->
                                        <td class="py-4 px-6 text-center whitespace-nowrap">
                                            @if($order->status == 'menunggu')
                                                <form action="{{ route('order.nextStatus', $order->id) }}" method="POST" class="m-0">
                                                    @csrf
                                                    <button type="submit" class="w-full bg-brand-700 hover:bg-brand-800 text-white font-bold py-1.5 px-4 rounded-full text-xs transition-colors shadow-sm inline-flex items-center justify-center gap-0.5">
                                                        <span class="material-icons text-xs">pending_actions</span> Proses
                                                    </button>
                                                </form>
                                            @elseif($order->status == 'diproses')
                                                <form action="{{ route('order.nextStatus', $order->id) }}" method="POST" class="m-0">
                                                    @csrf
                                                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-1.5 px-4 rounded-full text-xs transition-colors shadow-sm inline-flex items-center justify-center gap-0.5">
                                                        <span class="material-icons text-xs">local_shipping</span> Kirim
                                                    </button>
                                                </form>
                                            @elseif($order->status == 'dikirim')
                                                <form action="{{ route('order.nextStatus', $order->id) }}" method="POST" class="m-0">
                                                    @csrf
                                                    <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-1.5 px-4 rounded-full text-xs transition-colors shadow-sm inline-flex items-center justify-center gap-0.5">
                                                        <span class="material-icons text-xs">check_circle</span> Selesai
                                                    </button>
                                                </form>
                                            @else
                                                <button disabled class="border border-slate-200 text-slate-350 text-xs font-bold py-1.5 px-4 rounded-full inline-flex items-center gap-1 bg-slate-50 cursor-not-allowed">
                                                    <span class="material-icons text-xs text-slate-350">done_all</span> Selesai
                                                </button>
                                            @endif
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
</body>
</html>
