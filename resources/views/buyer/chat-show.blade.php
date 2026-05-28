<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat: {{ $chat->product_name }} | PanenHub</title>
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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        html, body {
            height: 100%;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #dde1e7;
            display: flex;
            align-items: stretch;
            justify-content: center;
        }
        body { overflow: hidden; }

        /* The "phone/window" container */
        #chatApp {
            width: 100%;
            max-width: 520px;
            background: #f0f2f5;
            display: flex;
            flex-direction: column;
            height: 100dvh;
            box-shadow: 0 0 40px rgba(0,0,0,0.15);
        }

        .material-icons-round {
            display: inline-flex; align-items: center;
            justify-content: center; vertical-align: middle;
        }

        /* Scrollable chat area */
        #chatScroll {
            flex: 1;
            overflow-y: auto;
            padding: 16px 14px;
            scroll-behavior: smooth;
        }
        #chatScroll::-webkit-scrollbar { width: 3px; }
        #chatScroll::-webkit-scrollbar-thumb { background: #bfc4cc; border-radius: 4px; }

        /* Offer card bubble */
        .offer-card {
            background: linear-gradient(150deg, #1a5c1e 0%, #2e7d32 100%);
            border-radius: 18px 18px 6px 18px;
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(27,94,32,0.25);
        }
        /* Regular bubbles */
        .bubble-self {
            background: linear-gradient(135deg, #2e7d32, #1b5e20);
            color: white;
            border-radius: 18px 18px 6px 18px;
            box-shadow: 0 2px 8px rgba(46,125,50,0.22);
        }
        .bubble-other {
            background: #ffffff;
            color: #1e293b;
            border-radius: 18px 18px 18px 6px;
            box-shadow: 0 1px 6px rgba(0,0,0,0.07);
        }
        textarea { resize: none; }
        textarea:focus { outline: none; }
    </style>
</head>
<body>
<div id="chatApp">

    {{-- ── HEADER ── --}}
    <div style="background:#fff; border-bottom: 1px solid #e8ecef; flex-shrink:0;">
        <div style="padding: 10px 14px; display:flex; align-items:center; gap:10px;">
            {{-- Back --}}
            <a href="{{ route('chat.index') }}"
               style="width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;color:#64748b;flex-shrink:0;text-decoration:none;"
               class="hover:bg-slate-100 transition-colors">
                <span class="material-icons-round" style="font-size:20px;">arrow_back</span>
            </a>
            {{-- Avatar --}}
            <div style="width:40px;height:40px;border-radius:14px;background:linear-gradient(135deg,#2e7d32,#1b5e20);display:flex;align-items:center;justify-content:center;flex-shrink:0;box-shadow:0 2px 8px rgba(46,125,50,.25);">
                <span class="material-icons-round" style="color:white;font-size:20px;">agriculture</span>
            </div>
            {{-- Title --}}
            <div style="flex:1;min-width:0;">
                <p style="font-weight:800;font-size:.88rem;color:#0f172a;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                    {{ $chat->product_name }}
                </p>
                <p style="font-size:.72rem;color:#94a3b8;font-weight:500;margin-top:1px;">
                    {{ $chat->farmer_name }}
                </p>
            </div>
            {{-- Status --}}
            <span style="flex-shrink:0;display:inline-flex;align-items:center;gap:5px;padding:5px 10px;border-radius:99px;font-size:.7rem;font-weight:800;
                {{ $chat->status === 'open' ? 'background:#f0fdf4;color:#15803d;border:1px solid #bbf7d0;' : 'background:#f1f5f9;color:#64748b;' }}">
                <span style="width:6px;height:6px;border-radius:50%;
                    {{ $chat->status === 'open' ? 'background:#22c55e;' : 'background:#94a3b8;' }}"></span>
                {{ $chat->status === 'open' ? 'Aktif' : 'Selesai' }}
            </span>
        </div>

        {{-- Offer Pills Strip --}}
        <div style="padding: 8px 14px 10px; display:flex; align-items:center; gap:6px; overflow-x:auto; border-top:1px solid #f1f5f9;">
            <span style="font-size:.65rem;font-weight:800;color:#94a3b8;text-transform:uppercase;letter-spacing:.05em;white-space:nowrap;flex-shrink:0;">Penawaran:</span>
            <span style="display:inline-flex;align-items:center;gap:4px;background:#f8fafc;border:1px solid #e2e8f0;color:#475569;font-size:.7rem;font-weight:700;padding:4px 10px;border-radius:99px;white-space:nowrap;flex-shrink:0;">
                <span class="material-icons-round" style="font-size:12px;color:#94a3b8;">scale</span>
                {{ number_format($chat->offer_qty, 0, ',', '.') }} kg
            </span>
            <span style="display:inline-flex;align-items:center;gap:4px;background:#f0fdf4;border:1px solid #bbf7d0;color:#15803d;font-size:.7rem;font-weight:700;padding:4px 10px;border-radius:99px;white-space:nowrap;flex-shrink:0;">
                Rp {{ number_format($chat->offer_price, 0, ',', '.') }}/kg
            </span>
            <span style="display:inline-flex;align-items:center;gap:4px;background:#eff6ff;border:1px solid #bfdbfe;color:#1d4ed8;font-size:.7rem;font-weight:700;padding:4px 10px;border-radius:99px;white-space:nowrap;flex-shrink:0;">
                Total Rp {{ number_format($chat->offer_total, 0, ',', '.') }}
            </span>
            <span style="display:inline-flex;align-items:center;gap:4px;background:#fffbeb;border:1px solid #fde68a;color:#d97706;font-size:.7rem;font-weight:700;padding:4px 10px;border-radius:99px;white-space:nowrap;flex-shrink:0;">
                DP Rp {{ number_format($chat->offer_dp, 0, ',', '.') }}
            </span>
        </div>
    </div>

    {{-- ── MESSAGES ── --}}
    <div id="chatScroll">
        <div style="display:flex;flex-direction:column;gap:12px;">

            @foreach($chat->messages as $index => $msg)
                @php $isSelf = ($msg->sender_id === Auth::id()); @endphp

                <div style="display:flex;{{ $isSelf ? 'justify-content:flex-end;' : 'justify-content:flex-start;' }}align-items:flex-end;gap:8px;">

                    {{-- Other avatar --}}
                    @if(!$isSelf)
                        <div style="width:30px;height:30px;border-radius:10px;background:linear-gradient(135deg,#2e7d32,#1b5e20);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <span class="material-icons-round" style="color:white;font-size:14px;">agriculture</span>
                        </div>
                    @endif

                    <div style="display:flex;flex-direction:column;{{ $isSelf ? 'align-items:flex-end;' : 'align-items:flex-start;' }}max-width:82%;">

                        {{-- First msg (index 0) + self → offer card --}}
                        @if($index === 0 && $isSelf)
                            <div class="offer-card">
                                {{-- Card header --}}
                                <div style="padding:12px 14px 10px;border-bottom:1px solid rgba(255,255,255,.12);display:flex;align-items:center;gap:8px;">
                                    <div style="width:28px;height:28px;background:rgba(255,255,255,.15);border-radius:9px;display:flex;align-items:center;justify-content:center;">
                                        <span class="material-icons-round" style="color:white;font-size:15px;">local_offer</span>
                                    </div>
                                    <div>
                                        <p style="font-size:.6rem;font-weight:800;color:rgba(255,255,255,.55);text-transform:uppercase;letter-spacing:.08em;">Penawaran Baru</p>
                                        <p style="font-size:.88rem;font-weight:800;color:white;line-height:1.2;">{{ $chat->product_name }}</p>
                                    </div>
                                </div>
                                {{-- Card grid --}}
                                <div style="padding:10px 14px 12px;">
                                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:6px;margin-bottom:8px;">
                                        <div style="background:rgba(255,255,255,.1);border-radius:10px;padding:8px 10px;">
                                            <p style="font-size:.6rem;font-weight:700;color:rgba(255,255,255,.5);text-transform:uppercase;letter-spacing:.06em;margin-bottom:2px;">Jumlah</p>
                                            <p style="font-size:.88rem;font-weight:800;color:white;">{{ number_format($chat->offer_qty, 0, ',', '.') }} kg</p>
                                        </div>
                                        <div style="background:rgba(255,255,255,.1);border-radius:10px;padding:8px 10px;">
                                            <p style="font-size:.6rem;font-weight:700;color:rgba(255,255,255,.5);text-transform:uppercase;letter-spacing:.06em;margin-bottom:2px;">Harga/kg</p>
                                            <p style="font-size:.88rem;font-weight:800;color:white;">Rp {{ number_format($chat->offer_price, 0, ',', '.') }}</p>
                                        </div>
                                        <div style="background:rgba(255,255,255,.1);border-radius:10px;padding:8px 10px;">
                                            <p style="font-size:.6rem;font-weight:700;color:rgba(255,255,255,.5);text-transform:uppercase;letter-spacing:.06em;margin-bottom:2px;">Total</p>
                                            <p style="font-size:.88rem;font-weight:800;color:white;">Rp {{ number_format($chat->offer_total, 0, ',', '.') }}</p>
                                        </div>
                                        <div style="background:rgba(251,191,36,.18);border:1px solid rgba(251,191,36,.25);border-radius:10px;padding:8px 10px;">
                                            <p style="font-size:.6rem;font-weight:700;color:rgba(252,211,77,.7);text-transform:uppercase;letter-spacing:.06em;margin-bottom:2px;">DP 20%</p>
                                            <p style="font-size:.88rem;font-weight:800;color:#fcd34d;">Rp {{ number_format($chat->offer_dp, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                    @if($chat->notes)
                                        <div style="background:rgba(255,255,255,.1);border-radius:10px;padding:8px 10px;margin-bottom:8px;">
                                            <p style="font-size:.6rem;font-weight:700;color:rgba(255,255,255,.5);text-transform:uppercase;margin-bottom:3px;">Catatan</p>
                                            <p style="font-size:.78rem;color:rgba(255,255,255,.85);line-height:1.5;">{{ $chat->notes }}</p>
                                        </div>
                                    @endif
                                    <p style="font-size:.75rem;color:rgba(255,255,255,.65);line-height:1.5;">
                                        Mohon konfirmasi ketersediaan dan kesepakatan harga. Terima kasih! 🙏
                                    </p>
                                </div>
                            </div>

                        @else
                            {{-- Regular bubble --}}
                            <div class="{{ $isSelf ? 'bubble-self' : 'bubble-other' }}" style="padding:10px 14px;">
                                <p style="font-size:.83rem;line-height:1.55;white-space:pre-wrap;">{{ $msg->message }}</p>
                            </div>
                        @endif

                        {{-- Timestamp --}}
                        <p style="font-size:.65rem;color:#94a3b8;margin-top:4px;{{ $isSelf ? 'text-align:right;' : '' }}">
                            {{ $msg->created_at->format('H:i') }}
                            <span style="opacity:.6;">· {{ $msg->created_at->format('d M') }}</span>
                        </p>
                    </div>

                    {{-- Self avatar --}}
                    @if($isSelf)
                        <div style="width:30px;height:30px;border-radius:10px;background:#e2e8f0;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <span class="material-icons-round" style="color:#94a3b8;font-size:14px;">person</span>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    {{-- ── INPUT ── --}}
    @if($chat->status === 'open')
    <div style="background:#fff;border-top:1px solid #e8ecef;padding:10px 12px;flex-shrink:0;box-shadow:0 -4px 16px rgba(0,0,0,.04);">
        <form action="{{ route('chat.send', $chat->id) }}" method="POST" id="chatForm">
            @csrf
            <div style="display:flex;gap:8px;align-items:flex-end;">
                <div style="flex:1;background:#f0f2f5;border:1.5px solid #e2e8f0;border-radius:16px;padding:10px 14px;
                            transition:border-color .2s,box-shadow .2s;"
                     onfocusin="this.style.borderColor='#2e7d32';this.style.boxShadow='0 0 0 3px rgba(46,125,50,.1)'"
                     onfocusout="this.style.borderColor='#e2e8f0';this.style.boxShadow='none'">
                    <textarea name="message" id="msgInput" rows="1"
                        placeholder="Tulis pesan ke petani..."
                        style="width:100%;background:transparent;font-family:'Plus Jakarta Sans',sans-serif;font-size:.83rem;color:#1e293b;line-height:1.5;max-height:100px;overflow-y:auto;"
                        required></textarea>
                </div>
                <button type="submit"
                    style="width:44px;height:44px;background:linear-gradient(135deg,#2e7d32,#1b5e20);border:none;border-radius:13px;
                           display:flex;align-items:center;justify-content:center;cursor:pointer;
                           box-shadow:0 4px 14px rgba(27,94,32,.3);transition:transform .15s,opacity .15s;flex-shrink:0;"
                    onmousedown="this.style.transform='scale(.93)'"
                    onmouseup="this.style.transform='scale(1)'"
                    onmouseleave="this.style.transform='scale(1)'">
                    <span class="material-icons-round" style="color:white;font-size:19px;">send</span>
                </button>
            </div>
        </form>
        @if(session('success'))
            <p style="font-size:.72rem;color:#16a34a;font-weight:600;text-align:center;margin-top:6px;">✓ {{ session('success') }}</p>
        @endif
    </div>
    @else
    <div style="background:#f1f5f9;border-top:1px solid #e2e8f0;padding:14px;text-align:center;flex-shrink:0;">
        <p style="font-size:.8rem;color:#94a3b8;font-weight:600;display:flex;align-items:center;justify-content:center;gap:6px;">
            <span class="material-icons-round" style="font-size:16px;">lock</span> Percakapan ini telah ditutup.
        </p>
    </div>
    @endif

</div>
<script>
    const scroll = document.getElementById('chatScroll');
    if (scroll) scroll.scrollTop = scroll.scrollHeight;

    const ta = document.getElementById('msgInput');
    if (ta) {
        ta.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 100) + 'px';
        });
        ta.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                if (this.value.trim()) document.getElementById('chatForm').submit();
            }
        });
    }
</script>
</body>
</html>
