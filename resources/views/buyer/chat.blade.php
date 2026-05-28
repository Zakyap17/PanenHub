<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Penawaran Saya | PanenHub</title>
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .material-icons { display: inline-flex; align-items: center; justify-content: center; vertical-align: middle; }
    </style>
</head>
<body class="min-h-screen bg-slate-50">

    <!-- Header -->
    <header class="bg-white border-b border-slate-100 py-4 px-6 sticky top-0 z-40 shadow-sm">
        <div class="max-w-4xl mx-auto flex items-center gap-4">
            <a href="{{ route('home') }}" class="flex items-center gap-2 text-slate-500 hover:text-brand-700 transition-colors">
                <span class="material-icons text-xl">arrow_back</span>
            </a>
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo-icon.png') }}" alt="Logo" class="h-8 w-auto" onerror="this.style.display='none'">
                <div>
                    <span class="text-base font-bold text-slate-900 block leading-tight">Pesan Penawaran</span>
                    <span class="text-xs text-brand-700 font-semibold">Negosiasi Kontrak Pra-Panen</span>
                </div>
            </div>
        </div>
    </header>

    <div class="max-w-4xl mx-auto px-4 py-8">

        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-900">Penawaran Saya</h1>
                <p class="text-sm text-slate-500 mt-1">Riwayat negosiasi kontrak dengan petani</p>
            </div>
            <a href="{{ route('home') }}" class="bg-brand-700 hover:bg-brand-800 text-white text-xs font-bold py-2.5 px-5 rounded-full transition-colors flex items-center gap-1.5 shadow-md shadow-brand-700/10">
                <span class="material-icons text-sm">add</span> Buat Penawaran Baru
            </a>
        </div>

        @if($chats->isEmpty())
            <!-- Empty State -->
            <div class="bg-white rounded-3xl border border-slate-100 p-16 text-center shadow-sm">
                <div class="w-20 h-20 bg-brand-50 rounded-full flex items-center justify-center mx-auto mb-5 border border-brand-100">
                    <span class="material-icons text-brand-700 text-4xl">chat_bubble_outline</span>
                </div>
                <h3 class="text-lg font-bold text-slate-800 mb-2">Belum Ada Penawaran</h3>
                <p class="text-sm text-slate-400 max-w-xs mx-auto mb-6 leading-relaxed">Kunjungi halaman beranda dan klik "Ajukan Penawaran" pada produk Kontrak Pra-Panen untuk memulai negosiasi.</p>
                <a href="{{ route('home') }}" class="bg-brand-700 hover:bg-brand-800 text-white font-bold py-3 px-7 rounded-full text-sm transition-colors inline-flex items-center gap-2 shadow-md shadow-brand-700/10">
                    <span class="material-icons text-sm">storefront</span> Lihat Produk Pra-Panen
                </a>
            </div>
        @else
            <div class="space-y-3">
                @foreach($chats as $chat)
                    <a href="{{ route('chat.show', $chat->id) }}" class="block bg-white rounded-2xl border border-slate-100 p-5 shadow-sm hover:shadow-md hover:border-brand-100 transition-all group">
                        <div class="flex items-start gap-4">
                            <!-- Avatar -->
                            <div class="w-12 h-12 bg-gradient-to-br from-brand-600 to-brand-800 rounded-2xl flex items-center justify-center flex-shrink-0 shadow-md shadow-brand-700/15">
                                <span class="material-icons text-white text-xl">agriculture</span>
                            </div>

                            <!-- Info -->
                            <div class="flex-grow min-w-0">
                                <div class="flex items-start justify-between gap-2">
                                    <div>
                                        <h4 class="font-bold text-slate-900 text-sm group-hover:text-brand-700 transition-colors">{{ $chat->product_name }}</h4>
                                        <p class="text-xs text-slate-500 mt-0.5">Petani: {{ $chat->farmer_name }}</p>
                                    </div>
                                    <div class="text-right flex-shrink-0">
                                        <span class="text-[10px] text-slate-400 font-medium block">{{ $chat->created_at->diffForHumans() }}</span>
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold mt-1
                                            {{ $chat->status === 'open' ? 'bg-green-50 text-green-700 border border-green-100' : 'bg-slate-100 text-slate-500' }}">
                                            <span class="w-1.5 h-1.5 rounded-full {{ $chat->status === 'open' ? 'bg-green-500' : 'bg-slate-400' }}"></span>
                                            {{ $chat->status === 'open' ? 'Aktif' : 'Selesai' }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Offer summary pills -->
                                <div class="flex items-center gap-2 mt-3 flex-wrap">
                                    <span class="bg-slate-50 border border-slate-100 text-slate-600 text-[10px] font-bold px-2.5 py-1 rounded-full">
                                        {{ number_format($chat->offer_qty, 0, ',', '.') }} kg
                                    </span>
                                    <span class="bg-brand-50 border border-brand-100 text-brand-700 text-[10px] font-bold px-2.5 py-1 rounded-full">
                                        Rp {{ number_format($chat->offer_price, 0, ',', '.') }}/kg
                                    </span>
                                    <span class="bg-amber-50 border border-amber-100 text-amber-700 text-[10px] font-bold px-2.5 py-1 rounded-full">
                                        DP: Rp {{ number_format($chat->offer_dp, 0, ',', '.') }}
                                    </span>
                                </div>

                                @if($chat->lastMessage)
                                    <p class="text-xs text-slate-400 mt-2.5 truncate border-t border-slate-50 pt-2">
                                        <span class="font-semibold text-slate-500">
                                            {{ $chat->lastMessage->sender_id === Auth::id() ? 'Anda' : $chat->mitra->name }}:
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
    </div>

</body>
</html>
