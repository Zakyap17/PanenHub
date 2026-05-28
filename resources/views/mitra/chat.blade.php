<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Masuk | PanenHub Mitra</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: { 50:'#f4fdf6', 100:'#e8f7ec', 600:'#2e7d32', 700:'#1b5e20', 800:'#154d1a' }
                    }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .material-icons { display: inline-flex; align-items: center; justify-content: center; vertical-align: middle; }
    </style>
</head>
<body class="min-h-screen bg-slate-50 flex flex-col justify-between">

    <!-- Header -->
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
                <button data-bs-toggle="modal" data-bs-target="#backToHomeModal" class="border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-bold py-2 px-4 rounded-full transition-colors flex items-center gap-1.5 shadow-sm">
                    <span class="material-icons text-sm">home</span> Beranda
                </button>
                <form action="/api/logout" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="border border-red-200 hover:bg-red-50 text-red-600 text-xs font-bold py-2 px-5 rounded-full transition-colors shadow-sm">Logout</button>
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
                <a href="{{ route('mitra.orders') }}" class="w-full flex items-center gap-3 py-3.5 px-4 rounded-2xl text-sm font-bold transition-all text-slate-600 hover:bg-slate-50 hover:text-brand-700">
                    <span class="material-icons">receipt_long</span>
                    <span>Daftar Pesanan</span>
                </a>
                <a href="{{ route('mitra.chat') }}" class="w-full flex items-center gap-3 py-3.5 px-4 rounded-2xl text-sm font-bold transition-all bg-brand-700 text-white shadow-md shadow-brand-700/10">
                    <span class="material-icons">chat</span>
                    <span>Pesan Masuk</span>
                    @if($unreadCount > 0)
                        <span class="ml-auto bg-white text-brand-700 text-[10px] font-extrabold w-5 h-5 rounded-full flex items-center justify-center">{{ $unreadCount }}</span>
                    @endif
                </a>
            </div>
        </aside>

        <!-- Content Area -->
        <main class="flex-grow space-y-6">
            <div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Pesan Masuk</h2>
                <p class="text-sm font-medium text-slate-500 mt-1">Penawaran & negosiasi dari pembeli untuk produk Pra-Panen.</p>
            </div>

            @if($chats->isEmpty())
                <!-- Empty State -->
                <div class="bg-white rounded-3xl border border-slate-200 border-dashed p-16 text-center shadow-sm">
                    <div class="w-20 h-20 bg-brand-50 rounded-full flex items-center justify-center mx-auto mb-5 border border-brand-100">
                        <span class="material-icons text-brand-700 text-4xl">mark_chat_unread</span>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">Belum Ada Pesan Masuk</h3>
                    <p class="text-sm text-slate-400 max-w-xs mx-auto leading-relaxed">Pembeli yang mengajukan penawaran pada produk Pra-Panen Anda akan muncul di sini secara otomatis.</p>
                </div>
            @else
                <div class="space-y-3">
                    @foreach($chats as $chat)
                        <a href="{{ route('mitra.chat.show', $chat->id) }}" class="block bg-white rounded-2xl border border-slate-100 p-5 shadow-sm hover:shadow-md hover:border-brand-100 transition-all group">
                            <div class="flex items-start gap-4">
                                <!-- Buyer Avatar -->
                                <div class="w-12 h-12 bg-gradient-to-br from-slate-500 to-slate-700 rounded-2xl flex items-center justify-center flex-shrink-0 shadow-md">
                                    <span class="material-icons text-white text-xl">person</span>
                                </div>

                                <!-- Info -->
                                <div class="flex-grow min-w-0">
                                    <div class="flex items-start justify-between gap-2">
                                        <div>
                                            <h4 class="font-bold text-slate-900 text-sm group-hover:text-brand-700 transition-colors">{{ $chat->buyer->name }}</h4>
                                            <p class="text-xs text-slate-500 mt-0.5">Menawar: <strong class="text-slate-700">{{ $chat->product_name }}</strong></p>
                                        </div>
                                        <div class="text-right flex-shrink-0">
                                            <span class="text-[10px] text-slate-400 font-medium block">{{ $chat->created_at->diffForHumans() }}</span>
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold mt-1
                                                {{ $chat->status === 'open' ? 'bg-amber-50 text-amber-700 border border-amber-100' : 'bg-slate-100 text-slate-500' }}">
                                                <span class="w-1.5 h-1.5 rounded-full {{ $chat->status === 'open' ? 'bg-amber-500 animate-pulse' : 'bg-slate-400' }}"></span>
                                                {{ $chat->status === 'open' ? 'Perlu Respons' : 'Selesai' }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Offer details -->
                                    <div class="flex items-center gap-2 mt-3 flex-wrap">
                                        <span class="bg-slate-50 border border-slate-100 text-slate-600 text-[10px] font-bold px-2.5 py-1 rounded-full">
                                            {{ number_format($chat->offer_qty, 0, ',', '.') }} kg
                                        </span>
                                        <span class="bg-brand-50 border border-brand-100 text-brand-700 text-[10px] font-bold px-2.5 py-1 rounded-full">
                                            Rp {{ number_format($chat->offer_price, 0, ',', '.') }}/kg
                                        </span>
                                        <span class="bg-blue-50 border border-blue-100 text-blue-700 text-[10px] font-bold px-2.5 py-1 rounded-full">
                                            Total: Rp {{ number_format($chat->offer_total, 0, ',', '.') }}
                                        </span>
                                    </div>

                                    @if($chat->lastMessage)
                                        <p class="text-xs text-slate-400 mt-2.5 truncate border-t border-slate-50 pt-2">
                                            <span class="font-semibold text-slate-500">
                                                {{ $chat->lastMessage->sender_id === Auth::id() ? 'Anda' : $chat->buyer->name }}:
                                            </span>
                                            {{ Str::limit($chat->lastMessage->message, 60) }}
                                        </p>
                                    @endif
                                </div>

                                <span class="material-icons text-slate-300 group-hover:text-brand-600 transition-colors self-center">chevron_right</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </main>
    </div>

    <!-- Footer -->
    <footer class="py-6 px-4 border-t border-slate-100 bg-white">
        <div class="max-w-7xl mx-auto text-center text-xs text-slate-400 font-medium">
            © 2024 PanenHub Agritech Ecosystem. Semua Hak Dilindungi.
        </div>
    </footer>

    <!-- Modal Kembali ke Beranda -->
    <div class="modal fade" id="backToHomeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0 shadow-2xl rounded-3xl overflow-hidden p-6 text-center space-y-4">
                <div class="w-16 h-16 bg-brand-50 rounded-full flex items-center justify-center mx-auto border border-brand-100 text-brand-700">
                    <span class="material-icons text-3xl">home</span>
                </div>
                <div class="space-y-2">
                    <h5 class="text-base font-bold text-slate-900">Kembali ke Beranda?</h5>
                    <p class="text-xs font-medium text-slate-500 leading-relaxed">Apakah Anda yakin ingin keluar dari Mitra Panel?</p>
                </div>
                <div class="grid grid-cols-2 gap-3 pt-2">
                    <button type="button" class="border border-slate-200 hover:bg-slate-50 text-slate-600 font-bold py-2.5 rounded-2xl text-xs transition-colors" data-bs-dismiss="modal">Batal</button>
                    <a href="/" class="bg-brand-700 hover:bg-brand-800 text-white font-bold py-2.5 rounded-2xl text-xs transition-colors inline-flex items-center justify-center">Ya, Kembali</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
