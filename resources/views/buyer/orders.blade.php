<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <title>Pesanan Saya | PanenHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-green: #2e7d32;
            --soft-bg: #f4fdf6;
        }
        body { 
            background-color: #f8faf9; 
            font-family: 'Segoe UI', sans-serif; 
            color: #333; 
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .navbar { background: #fff !important; border-bottom: 2px solid var(--primary-green); padding: 12px 0; }
        .navbar-brand { font-size: 1.5rem; color: var(--primary-green) !important; font-weight: bold; }
        
        .order-container { max-width: 1100px; margin: 40px auto; padding: 0 20px; flex: 1; }
        .page-title { font-weight: 800; color: #1a1a1a; margin-bottom: 35px; font-size: 2.2rem; text-align: center; }
        
        .order-card {
            background: #fff;
            border-radius: 20px;
            border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.04);
            margin-bottom: 25px;
            overflow: hidden;
            transition: 0.3s;
        }
        .order-card:hover { transform: translateY(-5px); box-shadow: 0 15px 40px rgba(0,0,0,0.08); }
        
        .order-header {
            padding: 20px 25px;
            background: #fafafa;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .mitra-info { display: flex; align-items: center; gap: 10px; font-weight: 700; color: var(--primary-green); }
        .order-status {
            font-size: 0.75rem;
            text-transform: uppercase;
            font-weight: 800;
            padding: 6px 16px;
            border-radius: 50px;
            letter-spacing: 0.5px;
        }
        .status-menunggu { background: #fff3e0; color: #e65100; }
        .status-diproses { background: #e3f2fd; color: #1565c0; }
        .status-dikirim { background: #f3e5f5; color: #7b1fa2; }
        .status-selesai { background: #e8f5e9; color: #2e7d32; }
        
        .order-body { padding: 25px; }
        .product-item { display: flex; gap: 20px; margin-bottom: 20px; align-items: center; }
        .product-img { width: 80px; height: 80px; border-radius: 12px; object-fit: cover; border: 1px solid #eee; }
        .product-details { flex: 1; display: flex; justify-content: space-between; align-items: center; }
        .product-name { font-weight: 700; font-size: 1.1rem; margin-bottom: 4px; }
        .product-meta { font-size: 0.85rem; color: #888; }
        .price-total { font-weight: 800; font-size: 1.1rem; color: #333; }
        
        .order-footer {
            padding: 30px;
            border-top: 1px dashed #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #fff;
        }
        .total-label { font-size: 0.9rem; color: #666; }
        .total-amount { font-size: 1.3rem; font-weight: 900; color: var(--primary-green); }
        
        .btn-detail {
            background: var(--primary-green);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 10px 25px;
            font-weight: 700;
            transition: 0.3s;
        }
        .btn-detail:hover { background: #1b5e20; color: white; transform: scale(1.05); }

        .empty-orders {
            text-align: center;
            padding: 100px 20px;
            background: #fff;
            border-radius: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        }
        .empty-orders i { font-size: 5rem; color: #e0e0e0; margin-bottom: 20px; display: block; }
        .btn-shop {
            background: var(--primary-green);
            color: white;
            border-radius: 50px;
            padding: 12px 35px;
            font-weight: 700;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
            box-shadow: 0 10px 20px rgba(46, 125, 50, 0.2);
        }
        
        @media (max-width: 575.98px) {
            .navbar .container {
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }
            .page-title {
                font-size: 1.8rem;
                margin-bottom: 20px;
            }
            .order-header {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 12px;
                padding: 15px !important;
            }
            .order-header > div {
                width: 100%;
                border-right: none !important;
                padding-right: 0 !important;
            }
            .order-header .order-status {
                text-align: left;
            }
            .product-item {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 12px;
                padding: 15px 0 !important;
            }
            .product-details {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 10px;
                width: 100% !important;
            }
            .product-details .text-end {
                text-align: left !important;
                width: 100%;
            }
            .order-footer {
                padding: 15px !important;
            }
            .order-footer > div {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 15px;
                width: 100%;
            }
            .order-footer .d-flex.align-items-center.flex-wrap.gap-4 {
                width: 100% !important;
                flex-direction: column;
                align-items: flex-start !important;
                gap: 15px;
            }
            .order-footer .text-end {
                text-align: left !important;
                width: 100%;
            }
            .order-footer .d-flex.flex-column {
                width: 100% !important;
            }
        }
    </style>
</head>
<body>

<nav class="navbar sticky-top shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('images/logo-icon.png') }}" alt="Logo" style="height: 30px; width: auto; margin-right: 8px;">
            PanenHub
        </a>
        <div class="d-flex align-items-center gap-3">
            <span class="fw-bold me-2">Hai, {{ Auth::user()->name }}</span>
            <a href="{{ route('home') }}" class="btn btn-outline-success rounded-pill px-4 fw-bold">Belanja Lagi</a>
        </div>
    </div>
</nav>

<div class="order-container">
    <h2 class="page-title">Pesanan Saya</h2>

    @if($orders->isEmpty())
    <div class="empty-orders">
        <i class="bi bi-bag-x"></i>
        <h3 class="fw-bold">Belum ada pesanan</h3>
        <p class="text-muted">Ayo dukung petani lokal dengan belanja hasil tani terbaik!</p>
        <a href="{{ route('home') }}" class="btn-shop">Mulai Belanja</a>
    </div>
    @else
        @foreach($orders as $order)
        <div class="order-card mb-4" style="border-radius: 8px; box-shadow: 0 1px 6px rgba(0,0,0,0.08); border: 1px solid #eee; background: #fff;">
            <!-- Header Toko -->
            <div class="order-header d-flex justify-content-between align-items-center flex-wrap gap-3" style="padding: 16px 24px; border-bottom: 1px solid #f0f0f0; background: #fafafa; border-radius: 8px 8px 0 0;">
                <div class="d-flex align-items-center flex-wrap gap-2">
                    <span class="badge bg-success" style="font-size: 0.7rem; padding: 4px 8px;">Star</span>
                    <span class="fw-bold text-dark" style="font-size: 1rem; border-right: 1px solid #ddd; padding-right: 12px;">{{ $order->mitra->name ?? 'Mitra PanenHub' }}</span>
                    <button class="btn btn-sm btn-success ms-1" style="font-size: 0.75rem; padding: 2px 10px;"><i class="bi bi-chat-dots-fill"></i> Chat</button>
                    <a href="#" class="btn btn-sm btn-outline-secondary ms-1" style="font-size: 0.75rem; padding: 2px 10px;"><i class="bi bi-shop"></i> Kunjungi Toko</a>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <div class="small text-muted" style="border-right: 1px solid #ddd; padding-right: 12px;">ID Pesanan: <span class="fw-bold text-dark">{{ $order->order_number }}</span></div>
                    <div class="order-status fw-bold text-uppercase" style="font-size: 0.85rem; color: var(--primary-green);">
                        @if($order->status == 'menunggu') <i class="bi bi-hourglass-split me-1"></i> Menunggu Konfirmasi
                        @elseif($order->status == 'diproses') <i class="bi bi-box-seam me-1"></i> Sedang Dikemas
                        @elseif($order->status == 'dikirim') <i class="bi bi-truck me-1"></i> Sedang Dikirim
                        @elseif($order->status == 'selesai') <i class="bi bi-patch-check-fill me-1"></i> Selesai
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Daftar Produk -->
            <div class="order-body" style="padding: 10px 24px;">
                @foreach($order->items as $item)
                <div class="product-item d-flex align-items-center py-3 {{ !$loop->last ? 'border-bottom' : '' }}" style="gap: 20px;">
                    <img src="{{ asset($item->product_image) }}" alt="{{ $item->product_name }}" class="product-img" style="border-radius: 4px; width: 80px; height: 80px; border: 1px solid #f0f0f0; object-fit: cover;">
                    <div class="product-details d-flex justify-content-between align-items-center w-100">
                        <div class="flex-grow-1">
                            <h6 class="product-name text-dark fw-bold mb-1" style="font-size: 1.1rem;">{{ $item->product_name }}</h6>
                            <div class="small text-muted mb-1">Bebas Pengembalian 7 Hari</div>
                            <div class="product-meta text-dark fw-medium">x{{ $item->quantity }}</div>
                            <span class="badge border border-success border-opacity-50 text-success rounded-1 bg-success-subtle mt-2" style="font-size: 0.75rem;"><i class="bi bi-lightning-fill text-warning"></i> PanenHub Extra</span>
                        </div>
                        <div class="text-end">
                            <div class="text-success fw-bold fs-5">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Footer Pesanan -->
            <div class="order-footer" style="padding: 24px; background: #fffdf9; border-top: 1px solid #f8f8f8; border-radius: 0 0 8px 8px;">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-4">
                    <div class="text-muted small d-flex align-items-center gap-3">
                        <span><i class="bi bi-calendar3 me-1"></i> {{ $order->created_at->format('d M Y, H:i') }}</span>
                        <span class="text-secondary opacity-50">|</span>
                        <span><i class="bi bi-wallet2 me-1"></i> <span class="fw-bold text-dark">{{ strtoupper($order->payment_method) }}</span></span>
                    </div>
                    
                    <div class="d-flex align-items-center flex-wrap gap-4 ms-md-auto">
                        <div class="text-end">
                            <div class="text-muted small mb-1"><i class="bi bi-shield-check text-success me-1"></i> Total Pesanan:</div>
                            <div class="total-amount fs-2 text-success fw-bold" style="line-height: 1;">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                        </div>
                        
                        <div class="d-flex flex-column gap-2" style="min-width: 200px;">
                            <button class="btn btn-success fw-bold py-2 shadow-sm" style="border-radius: 6px; background: var(--primary-green); border: none;">Beli Lagi</button>
                            <button class="btn btn-outline-secondary btn-sm py-1" style="border-radius: 6px; font-size: 0.85rem;">Tampilkan Rincian Pesanan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @endif
</div>

<footer class="py-4 text-center text-muted border-top bg-white">
    <div class="container">
        <p class="mb-0 small">© 2026 PanenHub Project. Membantu petani, memberi kebaikan.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
