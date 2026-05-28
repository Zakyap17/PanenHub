<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat: {{ $chat->buyer->name }} | PanenHub Mitra</title>
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
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f1f5f9; }
        .material-icons { display: inline-flex; align-items: center; justify-content: center; vertical-align: middle; }
        .chat-bubble-self  { background: linear-gradient(135deg, #2e7d32, #1b5e20); color: white; border-radius: 20px 20px 4px 20px; }
        .chat-bubble-other { background: #ffffff; color: #1e293b; border-radius: 20px 20px 20px 4px; border: 1px solid #f1f5f9; }
        pre { white-space: pre-wrap; font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-white border-b border-slate-100 py-3 px-4 sticky top-0 z-40 shadow-sm">
        <div class="max-w-4xl mx-auto flex items-center gap-3">
            <a href="{{ route('mitra.chat') }}" class="w-9 h-9 flex items-center justify-center rounded-full hover:bg-slate-100 transition-colors text-slate-500">
                <span class="material-icons text-xl">arrow_back</span>
            </a>
            <!-- Buyer avatar -->
            <div class="w-10 h-10 bg-gradient-to-br from-slate-500 to-slate-700 rounded-2xl flex items-center justify-center shadow-md flex-shrink-0">
                <span class="material-icons text-white text-base">person</span>
            </div>
            <div class="flex-grow min-w-0">
                <h1 class="font-bold text-slate-900 text-sm leading-tight truncate">{{ $chat->buyer->name }}</h1>
                <p class="text-xs text-slate-500">Penawaran: {{ $chat->product_name }}</p>
            </div>
            <span class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold
                {{ $chat->status === 'open' ? 'bg-amber-50 text-amber-700 border border-amber-100' : 'bg-slate-100 text-slate-500' }}">
                <span class="w-1.5 h-1.5 rounded-full {{ $chat->status === 'open' ? 'bg-amber-500 animate-pulse' : 'bg-slate-400' }}"></span>
                {{ $chat->status === 'open' ? 'Negosiasi Aktif' : 'Selesai' }}
            </span>
            <div class="flex items-center gap-2">
                <a href="{{ asset('images/logo-icon.png') }}" class="hidden">PanenHub</a>
                <form action="/api/logout" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="border border-red-200 hover:bg-red-50 text-red-600 text-xs font-bold py-1.5 px-3 rounded-full transition-colors">Logout</button>
                </form>
            </div>
        </div>
    </header>

    <!-- Offer Summary Card -->
    <div class="max-w-4xl mx-auto w-full px-4 pt-4">
        <div class="bg-white rounded-2xl border border-slate-100 p-4 shadow-sm">
            <p class="text-[10px] font-extrabold text-slate-400 uppercase tracking-wider mb-3 flex items-center gap-1.5">
                <span class="material-icons text-xs text-amber-500">local_offer</span> Detail Penawaran dari Pembeli
            </p>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                <div class="bg-slate-50 rounded-xl p-3">
                    <span class="text-[10px] text-slate-400 font-bold uppercase block">Pembeli</span>
                    <span class="text-sm font-bold text-slate-900 block truncate">{{ $chat->buyer->name }}</span>
                </div>
                <div class="bg-slate-50 rounded-xl p-3">
                    <span class="text-[10px] text-slate-400 font-bold uppercase block">Jumlah</span>
                    <span class="text-sm font-bold text-slate-900 block">{{ number_format($chat->offer_qty, 0, ',', '.') }} kg</span>
                </div>
                <div class="bg-brand-50 rounded-xl p-3">
                    <span class="text-[10px] text-brand-600 font-bold uppercase block">Total Nilai</span>
                    <span class="text-sm font-bold text-brand-700 block">Rp {{ number_format($chat->offer_total, 0, ',', '.') }}</span>
                </div>
                <div class="bg-amber-50 rounded-xl p-3">
                    <span class="text-[10px] text-amber-600 font-bold uppercase block">DP (20%)</span>
                    <span class="text-sm font-bold text-amber-700 block">Rp {{ number_format($chat->offer_dp, 0, ',', '.') }}</span>
                </div>
            </div>
            @if($chat->notes)
                <div class="mt-3 bg-blue-50 rounded-xl p-3 border border-blue-100">
                    <span class="text-[10px] text-blue-600 font-bold uppercase block mb-1">Catatan Pembeli</span>
                    <p class="text-xs text-slate-700 font-medium">{{ $chat->notes }}</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Chat Messages -->
    <div id="chatScroll" class="flex-grow max-w-4xl mx-auto w-full px-4 py-4 space-y-3 overflow-y-auto" style="max-height: calc(100vh - 350px); min-height: 200px; scroll-behavior: smooth;">

        @foreach($chat->messages as $msg)
            @php $isSelf = ($msg->sender_id === Auth::id()); @endphp
            <div class="flex {{ $isSelf ? 'justify-end' : 'justify-start' }} items-end gap-2">
                @if(!$isSelf)
                    <div class="w-8 h-8 bg-gradient-to-br from-slate-500 to-slate-700 rounded-xl flex items-center justify-center flex-shrink-0 mb-1 shadow-sm">
                        <span class="material-icons text-white text-sm">person</span>
                    </div>
                @endif
                <div class="max-w-[75%]">
                    @if(!$isSelf)
                        <p class="text-[10px] text-slate-400 font-semibold mb-1 ml-1">{{ $chat->buyer->name }}</p>
                    @endif
                    <div class="px-4 py-3 shadow-sm {{ $isSelf ? 'chat-bubble-self' : 'chat-bubble-other' }}">
                        <pre class="text-sm leading-relaxed">{{ $msg->message }}</pre>
                    </div>
                    <p class="text-[10px] text-slate-400 mt-1 {{ $isSelf ? 'text-right mr-1' : 'ml-1' }}">
                        {{ $msg->created_at->format('H:i') }} · {{ $msg->created_at->format('d M') }}
                    </p>
                </div>
                @if($isSelf)
                    <div class="w-8 h-8 bg-gradient-to-br from-brand-600 to-brand-800 rounded-xl flex items-center justify-center flex-shrink-0 mb-1 shadow-sm">
                        <span class="material-icons text-white text-sm">agriculture</span>
                    </div>
                @endif
            </div>
        @endforeach

    </div>

    <!-- Message Input -->
    @if($chat->status === 'open')
    <div class="bg-white border-t border-slate-100 px-4 py-3 sticky bottom-0 shadow-lg">
        <div class="max-w-4xl mx-auto">
            <form action="{{ route('mitra.chat.send', $chat->id) }}" method="POST">
                @csrf
                <div class="flex gap-3 items-end">
                    <div class="flex-grow bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 focus-within:border-brand-500 focus-within:ring-4 focus-within:ring-brand-600/10 transition-all">
                        <textarea name="message" rows="1"
                            placeholder="Balas penawaran pembeli..."
                            class="w-full bg-transparent outline-none resize-none text-sm text-slate-800 placeholder-slate-400 leading-relaxed max-h-32"
                            oninput="this.style.height='auto'; this.style.height=this.scrollHeight+'px'"
                            required></textarea>
                    </div>
                    <button type="submit"
                        class="w-12 h-12 bg-brand-700 hover:bg-brand-800 text-white rounded-2xl flex items-center justify-center shadow-md shadow-brand-700/15 transition-all flex-shrink-0 hover:scale-105 active:scale-95">
                        <span class="material-icons text-xl">send</span>
                    </button>
                </div>
            </form>
            @if(session('success'))
                <p class="text-xs text-green-600 font-semibold mt-2 text-center">✓ {{ session('success') }}</p>
            @endif
        </div>
    </div>
    @else
    <div class="bg-slate-100 border-t border-slate-200 py-4 px-4 text-center sticky bottom-0">
        <p class="text-sm text-slate-500 font-medium">Percakapan ini telah ditutup.</p>
    </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const chatScroll = document.getElementById('chatScroll');
        if (chatScroll) chatScroll.scrollTop = chatScroll.scrollHeight;

        document.querySelector('textarea[name="message"]')?.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                this.closest('form').submit();
            }
        });
    </script>
</body>
</html>
