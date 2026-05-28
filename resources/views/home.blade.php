<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PanenHub | Berdayakan Petani Lokal & Kedaulatan Pangan</title>

    <!-- Premium Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        :root {
            /* Harmonized HSL Agritech Palette */
            --primary: hsl(142, 72%, 20%); /* Deep Forest Green */
            --primary-medium: hsl(142, 68%, 27%);
            --primary-light: hsl(142, 60%, 35%);
            --primary-glow: hsla(142, 72%, 20%, 0.15);
            --accent: hsl(45, 100%, 50%); /* Rich Golden Yellow */
            --accent-glow: hsla(45, 100%, 50%, 0.35);
            --success-soft: hsl(142, 76%, 97%);
            --success-text: hsl(142, 72%, 18%);
            --dark: hsl(145, 30%, 10%);
            --light: hsl(135, 20%, 98%);
            --border-light: rgba(46, 125, 50, 0.12);
            
            /* Glassmorphism styling tokens */
            --glass-bg: rgba(255, 255, 255, 0.85);
            --glass-card: rgba(255, 255, 255, 0.75);
            --glass-border: rgba(255, 255, 255, 0.6);
            --glass-shadow: 0 12px 35px rgba(27, 94, 32, 0.05);
            
            --transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            --font-display: 'Outfit', sans-serif;
            --font-sans: 'Plus Jakarta Sans', sans-serif;
        }

        /* Base Styling */
        body { 
            background-color: var(--light); 
            font-family: var(--font-sans); 
            color: var(--dark); 
            margin: 0; 
            padding: 0; 
            overflow-x: hidden; 
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3, h4, h5, h6, .display-font {
            font-family: var(--font-display);
            font-weight: 700;
            letter-spacing: -0.02em;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f2;
        }
        ::-webkit-scrollbar-thumb {
            background: var(--primary-light);
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary);
        }

        /* Glassmorphism Navbar */
        .navbar { 
            background: rgba(255, 255, 255, 0.8) !important; 
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border-light); 
            padding: 18px 0; 
            transition: var(--transition);
        }
        .navbar.scrolled {
            padding: 12px 0;
            box-shadow: var(--glass-shadow);
        }
        .navbar-brand { 
            font-family: var(--font-display);
            font-size: 1.6rem; 
            color: var(--primary) !important; 
            font-weight: 900; 
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .navbar-brand img {
            transition: var(--transition);
        }
        .navbar-brand:hover img {
            transform: rotate(-10deg) scale(1.1);
        }

        /* Search Layout */
        .search-container { 
            flex: 1; 
            margin: 0 50px; 
            position: relative;
        }
        .search-input-group {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(46, 125, 50, 0.18);
            border-radius: 50px;
            padding: 4px 6px;
            display: flex;
            align-items: center;
            transition: var(--transition);
            box-shadow: 0 4px 15px rgba(27, 94, 32, 0.02);
        }
        .search-input-group:focus-within {
            border-color: var(--primary-light);
            box-shadow: 0 8px 25px rgba(27, 94, 32, 0.08), 0 0 0 4px rgba(76, 154, 42, 0.1);
            transform: translateY(-1px);
        }
        .search-input { 
            border: none;
            background: transparent;
            padding-left: 20px; 
            width: 100%; 
            font-size: 0.95rem;
            color: var(--dark);
            outline: none;
        }
        .search-btn { 
            border-radius: 50px; 
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%); 
            color: white; 
            border: none; 
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }
        .search-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(46, 125, 50, 0.3);
        }

        /* Navigation Cart & Profile Styling */
        .nav-cart-btn {
            position: relative;
            background: rgba(46, 125, 50, 0.06);
            color: var(--primary);
            border: none;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }
        .nav-cart-btn:hover {
            background: rgba(46, 125, 50, 0.12);
            color: var(--primary-light);
            transform: scale(1.05);
        }
        .nav-cart-badge {
            font-size: 0.72rem;
            padding: 3px 6px;
            border-radius: 50%;
            top: 2px;
            right: 2px;
            border: 2px solid white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        /* Premium Buttons */
        .btn-premium-solid {
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
            color: white !important;
            font-weight: 700;
            border-radius: 50px;
            padding: 10px 28px;
            border: none;
            transition: var(--transition);
            box-shadow: 0 6px 15px rgba(46, 125, 50, 0.2);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-premium-solid:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 22px rgba(46, 125, 50, 0.35);
            filter: brightness(1.08);
        }
        .btn-premium-outline {
            background: transparent;
            color: var(--primary) !important;
            font-weight: 700;
            border-radius: 50px;
            padding: 9px 26px;
            border: 2px solid var(--primary-light);
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-premium-outline:hover {
            background: rgba(46, 125, 50, 0.05);
            transform: translateY(-2px);
        }

        .btn-premium-accent {
            background: linear-gradient(135deg, var(--accent) 0%, hsl(40, 100%, 45%) 100%);
            color: var(--dark) !important;
            font-weight: 800;
            border-radius: 50px;
            padding: 12px 32px;
            border: none;
            transition: var(--transition);
            box-shadow: 0 6px 20px rgba(255, 179, 0, 0.3);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-premium-accent:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(255, 179, 0, 0.5);
            filter: brightness(1.05);
        }

        /* WOW Hero Section */
        .hero-section {
            position: relative;
            background: radial-gradient(circle at top right, rgba(76, 154, 42, 0.15), transparent 60%),
                        radial-gradient(circle at bottom left, rgba(27, 94, 32, 0.08), transparent 50%),
                        linear-gradient(180deg, #ffffff 0%, var(--light) 100%);
            padding: 100px 0 80px 0;
            overflow: hidden;
        }
        .hero-section::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0; left: 0;
            background-image: radial-gradient(rgba(46, 125, 50, 0.05) 1.5px, transparent 1.5px);
            background-size: 24px 24px;
            pointer-events: none;
        }
        .badge-premium-direct {
            background: rgba(46, 125, 50, 0.08);
            border: 1px solid rgba(46, 125, 50, 0.2);
            color: var(--primary);
            font-weight: 700;
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.01);
            animation: pulseGlow 3s infinite;
        }
        .hero-title {
            font-size: 3.5rem;
            line-height: 1.15;
            font-weight: 900;
            color: var(--primary);
            margin-bottom: 20px;
        }
        .hero-title span {
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--accent) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-style: italic;
        }
        .hero-subtext {
            font-size: 1.15rem;
            color: #556057;
            line-height: 1.6;
            margin-bottom: 35px;
        }

        /* Floating Widget on Hero Right */
        .hero-widget-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            box-shadow: 0 25px 55px rgba(27, 94, 32, 0.08);
            border-radius: 24px;
            padding: 30px;
            position: relative;
            animation: float 6s ease-in-out infinite;
            z-index: 2;
        }
        .hero-widget-bg-decor {
            position: absolute;
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
            width: 100%;
            height: 100%;
            top: 15px;
            right: -15px;
            border-radius: 24px;
            z-index: 1;
            opacity: 0.08;
            pointer-events: none;
        }

        /* Media Coverage Ribbons */
        .media-ribbon {
            border-top: 1px solid var(--border-light);
            border-bottom: 1px solid var(--border-light);
            background: white;
            padding: 20px 0;
            overflow: hidden;
            position: relative;
        }
        .media-wrapper {
            display: flex;
            align-items: center;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 20px;
            opacity: 0.6;
        }
        .media-logo {
            font-weight: 800;
            font-size: 1.1rem;
            letter-spacing: -0.5px;
            color: var(--dark);
            text-transform: uppercase;
        }
        .media-logo span {
            color: var(--primary-light);
        }

        /* Live Commodity Price Index */
        .live-ticker-bar {
            background: linear-gradient(135deg, var(--primary) 0%, var(--dark) 100%);
            color: white;
            padding: 10px 0;
            overflow: hidden;
            white-space: nowrap;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .ticker-track {
            display: inline-block;
            animation: marquee 25s linear infinite;
        }
        .ticker-item {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-right: 40px;
            font-weight: 600;
            font-size: 0.9rem;
        }
        .ticker-item.up { color: #81c784; }
        .ticker-item.stable { color: #81d4fa; }
        .ticker-item.down { color: #e57373; }

        @keyframes marquee {
            0% { transform: translate3d(0, 0, 0); }
            100% { transform: translate3d(-50%, 0, 0); }
        }

        .price-section-header {
            text-align: center;
            margin-bottom: 40px;
        }
        .price-card {
            background: white;
            border-radius: 18px;
            border: 1px solid rgba(0,0,0,0.04);
            box-shadow: var(--glass-shadow);
            padding: 24px;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }
        .price-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--hover-shadow);
            border-color: rgba(46, 125, 50, 0.15);
        }
        .price-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 4px; height: 100%;
            background: var(--primary-light);
        }
        .price-card.card-up::before { background: #2e7d32; }
        .price-card.card-down::before { background: #d32f2f; }
        .price-card.card-stable::before { background: #0284c7; }

        .price-trend-badge {
            padding: 4px 10px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
        }
        .price-trend-badge.up { background: #e8f5e9; color: #2e7d32; }
        .price-trend-badge.down { background: #ffebee; color: #c62828; }
        .price-trend-badge.stable { background: #e0f2fe; color: #0369a1; }

        /* Demand Info Banner Styles */
        .demand-banner {
            padding: 8px 12px;
            border-radius: 8px;
            margin-bottom: 12px;
            font-size: 0.74rem;
            font-weight: 600;
            line-height: 1.35;
            display: flex;
            align-items: flex-start;
            gap: 6px;
            text-align: left;
        }
        .demand-banner-up {
            background-color: rgba(46, 125, 50, 0.08) !important;
            border: 1px solid rgba(46, 125, 50, 0.15) !important;
            color: #1b5e20 !important;
        }
        .demand-banner-stable {
            background-color: rgba(2, 132, 199, 0.08) !important;
            border: 1px solid rgba(2, 132, 199, 0.15) !important;
            color: #0369a1 !important;
        }
        .demand-banner-down {
            background-color: rgba(211, 47, 47, 0.08) !important;
            border: 1px solid rgba(211, 47, 47, 0.15) !important;
            color: #c62828 !important;
        }

        /* CSS Sparklines inside Cards */
        .sparkline-container {
            height: 45px;
            margin-top: 15px;
            position: relative;
            display: flex;
            align-items: flex-end;
            gap: 4px;
        }
        .sparkbar {
            flex: 1;
            background: rgba(46, 125, 50, 0.15);
            border-radius: 2px 2px 0 0;
            transition: var(--transition);
        }
        .price-card:hover .sparkbar {
            background: var(--primary-light);
        }
        .price-card.card-down:hover .sparkbar {
            background: #d32f2f;
        }
        .price-card.card-stable:hover .sparkbar {
            background: #0284c7;
        }

        /* Dual-Tab Marketplace styling */
        .market-tab-container {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 40px;
        }
        .market-tab-btn {
            background: white;
            border: 1px solid var(--border-light);
            border-radius: 50px;
            padding: 12px 35px;
            font-weight: 700;
            color: var(--primary);
            transition: var(--transition);
            box-shadow: 0 4px 10px rgba(0,0,0,0.01);
        }
        .market-tab-btn:hover {
            transform: translateY(-1px);
            background: var(--success-soft);
        }
        .market-tab-btn.active {
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
            color: white;
            border-color: transparent;
            box-shadow: 0 8px 20px rgba(46, 125, 50, 0.25);
        }

        /* Premium Filters Bar */
        .filters-panel {
            background: white;
            border-radius: 20px;
            padding: 24px;
            margin-bottom: 35px;
            box-shadow: var(--glass-shadow);
            border: 1px solid rgba(0,0,0,0.02);
        }
        .filter-select {
            border: 1px solid rgba(46, 125, 50, 0.15);
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 0.9rem;
            color: var(--dark);
            outline: none;
            background-color: var(--light);
            transition: var(--transition);
            width: 100%;
        }
        .filter-select:focus {
            border-color: var(--primary-light);
            background-color: white;
            box-shadow: 0 0 0 3px rgba(76, 154, 42, 0.1);
        }

        /* Premium Product Cards Spot Market */
        .card-product-premium {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid rgba(0,0,0,0.03);
            box-shadow: var(--glass-shadow);
            height: 100%;
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            position: relative;
        }
        .card-product-premium:hover {
            transform: translateY(-8px);
            box-shadow: var(--hover-shadow);
            border-color: rgba(46, 125, 50, 0.12);
        }
        .product-img-wrapper {
            height: 220px;
            overflow: hidden;
            background: #f8fcf9;
            position: relative;
        }
        .product-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .card-product-premium:hover .product-img-wrapper img {
            transform: scale(1.08);
        }
        .badge-farmer-owner {
            position: absolute;
            bottom: 15px;
            left: 15px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(46, 125, 50, 0.15);
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 0.76rem;
            font-weight: 700;
            color: var(--primary);
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        .badge-dp-lock {
            position: absolute;
            top: 15px;
            right: 15px;
            background: linear-gradient(135deg, var(--accent) 0%, hsl(40, 100%, 45%) 100%);
            color: var(--dark);
            font-weight: 800;
            font-size: 0.72rem;
            padding: 6px 14px;
            border-radius: 50px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            text-transform: uppercase;
        }
        .badge-verified-sprout {
            position: absolute;
            top: 15px;
            left: 15px;
            background: var(--primary);
            color: white;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            font-size: 0.95rem;
        }

        .product-body {
            padding: 24px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .product-cat-tag {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--primary-light);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }
        .product-premium-title {
            font-size: 1.15rem;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 8px;
            transition: var(--transition);
        }
        .product-premium-price {
            font-size: 1.25rem;
            font-weight: 900;
            color: var(--primary);
            margin-bottom: 12px;
        }
        .product-premium-price span {
            font-size: 0.85rem;
            color: #777;
            font-weight: 500;
        }

        /* Progress Tonnage Meter for pre-harvest */
        .tonnage-container {
            background: #f4fcf6;
            border-radius: 10px;
            padding: 10px 14px;
            margin-bottom: 15px;
            border: 1px solid rgba(46, 125, 50, 0.05);
        }
        .tonnage-bar {
            height: 6px;
            background: #e0efe3;
            border-radius: 10px;
            overflow: hidden;
        }
        .tonnage-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--primary-light), var(--primary));
            border-radius: 10px;
        }

        .rating-deals-strip {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.82rem;
            color: #666;
            margin-top: auto;
            padding-top: 15px;
            border-top: 1px dashed rgba(0,0,0,0.06);
        }

        /* Cara Kerja Process Steps */
        .process-section {
            background: white;
            padding: 100px 0;
            position: relative;
        }
        .process-title-tag {
            background: rgba(46, 125, 50, 0.06);
            color: var(--primary);
            font-weight: 800;
            padding: 6px 18px;
            border-radius: 50px;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: inline-block;
            margin-bottom: 15px;
        }
        .process-card-step {
            background: var(--glass-card);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 35px 30px;
            box-shadow: var(--glass-shadow);
            position: relative;
            transition: var(--transition);
            height: 100%;
        }
        .process-card-step:hover {
            transform: translateY(-8px);
            box-shadow: var(--hover-shadow);
            border-color: rgba(46, 125, 50, 0.15);
            background: white;
        }
        .process-badge-num {
            position: absolute;
            top: -20px;
            right: 30px;
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--accent) 0%, hsl(40, 100%, 45%) 100%);
            color: var(--dark);
            font-weight: 900;
            font-size: 1.3rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 20px rgba(255, 179, 0, 0.3);
            border: 3px solid white;
        }
        .process-icon-bg {
            width: 60px;
            height: 60px;
            border-radius: 18px;
            background: #e8f5e9;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            margin-bottom: 25px;
            transition: var(--transition);
        }
        .process-card-step:hover .process-icon-bg {
            background: var(--primary);
            color: white;
            transform: scale(1.05) rotate(5deg);
        }

        /* Kenapa Memilih Kami & Newsletter card */
        .why-section {
            padding: 100px 0;
            background: radial-gradient(circle at bottom right, rgba(76, 154, 42, 0.08), transparent 60%),
                        var(--light);
        }
        .why-feature-row {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }
        .why-feature-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: rgba(46, 125, 50, 0.06);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            flex-shrink: 0;
        }
        .why-newsletter-card {
            background: linear-gradient(135deg, var(--primary-medium) 0%, var(--primary) 100%);
            border-radius: 28px;
            padding: 45px;
            color: white;
            box-shadow: 0 30px 60px rgba(15, 29, 19, 0.25);
            position: relative;
            overflow: hidden;
        }
        .why-newsletter-card::after {
            content: '';
            position: absolute;
            bottom: -50px; right: -50px;
            width: 250px; height: 250px;
            background: rgba(255,255,255,0.04);
            border-radius: 50%;
            pointer-events: none;
        }
        .news-input-pill {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 50px;
            padding: 6px 6px 6px 20px;
            display: flex;
            align-items: center;
            transition: var(--transition);
        }
        .news-input-pill:focus-within {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255,255,255,0.3);
            box-shadow: 0 0 0 4px rgba(255,255,255,0.1);
        }
        .news-input-pill input {
            border: none;
            background: transparent;
            color: white;
            font-size: 0.95rem;
            outline: none;
            width: 100%;
        }
        .news-input-pill input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }
        .news-submit-btn {
            background: var(--accent);
            color: var(--dark);
            font-weight: 800;
            border: none;
            border-radius: 50px;
            padding: 10px 24px;
            transition: var(--transition);
        }
        .news-submit-btn:hover {
            transform: scale(1.03);
            box-shadow: 0 4px 15px rgba(255, 179, 0, 0.4);
        }

        /* Floating Action Widget */
        .fab-mitra-refined {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
            color: white;
            padding: 14px 24px;
            border-radius: 50px;
            box-shadow: 0 10px 25px rgba(27, 94, 32, 0.3);
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 800;
            font-size: 0.95rem;
            cursor: pointer;
            z-index: 999;
            transition: var(--transition);
            border: 2px solid rgba(255,255,255,0.18);
            text-decoration: none;
        }
        .fab-mitra-refined:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 15px 35px rgba(27, 94, 32, 0.45);
            color: white;
        }
        .fab-mitra-badge {
            background: var(--accent);
            color: var(--dark);
            font-size: 0.65rem;
            padding: 2px 6px;
            border-radius: 10px;
            position: absolute;
            top: -10px;
            right: 15px;
            font-weight: 900;
            text-transform: uppercase;
        }

        /* Premium Modals Design */
        .modal-content-premium {
            border-radius: 24px;
            border: none;
            overflow: hidden;
            box-shadow: 0 25px 60px rgba(0,0,0,0.15);
        }
        .modal-header-premium {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-medium) 100%);
            color: white;
            padding: 24px 30px;
            border-bottom: none;
            position: relative;
        }
        .modal-header-premium .btn-close {
            filter: invert(1) grayscale(1) brightness(2);
        }
        .modal-body-premium {
            padding: 30px;
            background: #fff;
        }

        /* Bid Calculator Slider Custom Style */
        .calc-range {
            accent-color: var(--primary);
            height: 8px;
            border-radius: 10px;
        }

        /* Interactive Charts Modal UI */
        .chart-mock-bar {
            flex: 1;
            background: #e2ede4;
            border-radius: 6px 6px 0 0;
            min-height: 20px;
            transition: var(--transition);
            position: relative;
            cursor: pointer;
        }
        .chart-mock-bar:hover {
            background: var(--primary-light);
        }
        .chart-mock-bar:hover::after {
            content: attr(data-val);
            position: absolute;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--dark);
            color: white;
            font-size: 0.7rem;
            padding: 3px 6px;
            border-radius: 4px;
            font-weight: bold;
            white-space: nowrap;
        }

        /* Footer styling */
        footer {
            background: var(--dark);
            color: rgba(255,255,255,0.7);
            padding: 70px 0 40px 0;
            margin-top: 0;
            border-top: 1px solid rgba(255,255,255,0.06);
            width: 100vw;
            position: relative;
            left: 50%;
            right: 50%;
            margin-left: -50vw;
            margin-right: -50vw;
        }
        .footer-logo {
            font-family: var(--font-display);
            color: white;
            font-weight: 900;
            font-size: 1.8rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .footer-link {
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            transition: var(--transition);
            display: block;
            margin-bottom: 12px;
            font-size: 0.92rem;
        }
        .footer-link:hover {
            color: var(--accent);
            transform: translateX(3px);
        }
        .footer-hr {
            border-color: rgba(255,255,255,0.08);
            margin: 40px 0 30px 0;
        }

        /* Shopee styled responsive Grouped Cart Modal */
        .cart-group-card {
            background: white;
            border: 1px solid rgba(0,0,0,0.03);
            border-radius: 16px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
            overflow: hidden;
        }
        .cart-group-header {
            background: #f8faf8;
            padding: 15px 24px;
            border-bottom: 1px solid rgba(0,0,0,0.03);
            display: flex;
            align-items: center;
            font-weight: 700;
        }
        .cart-item-row {
            padding: 20px 24px;
            border-bottom: 1px dashed rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .cart-item-row:last-child {
            border-bottom: none;
        }
        .cart-img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid rgba(0,0,0,0.06);
        }

        /* Responsive adaptations */
        @media (max-width: 991.98px) {
            .hero-title { font-size: 2.6rem; }
            .search-container { margin: 0 15px; }
            .hero-widget-card { margin-top: 40px; }
            .why-newsletter-card { padding: 30px; }
        }
        @media (max-width: 575.98px) {
            .hero-title { font-size: 2.1rem; }
            .btn-premium-solid, .btn-premium-outline { width: 100%; display: flex; justify-content: center; margin-bottom: 10px; }
            .hero-widget-card { padding: 20px; }
            .why-newsletter-card { padding: 25px 20px; }
            .news-input-pill { flex-direction: column; border-radius: 16px; padding: 15px; gap: 15px; }
            .news-submit-btn { width: 100%; }
            .market-tab-container { flex-direction: column; gap: 10px; width: 100%; }
            .market-tab-btn { width: 100%; padding: 10px 20px; font-size: 0.9rem; }
            .filters-panel { padding: 16px; }
            .fab-mitra-refined { bottom: 20px; right: 20px; padding: 12px; border-radius: 50%; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; }
            .fab-mitra-refined span { display: none; }
            .fab-mitra-refined i { margin: 0; font-size: 1.3rem; }
            .fab-mitra-refined .fab-mitra-badge { top: -6px; right: -6px; font-size: 0.6rem; padding: 2px 6px; }
        }

        /* Confetti particles container */
        .confetti-container {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            pointer-events: none;
            z-index: 99999;
            overflow: hidden;
            display: none;
        }
        .confetti-particle {
            position: absolute;
            width: 10px; height: 10px;
            border-radius: 50%;
            opacity: 0.8;
            animation: fall 3s ease-out forwards;
        }
        @keyframes fall {
            0% { transform: translateY(-50px) rotate(0deg); opacity: 1; }
            100% { transform: translateY(105vh) rotate(360deg); opacity: 0; }
        }
    </style>
</head>
<body>

<!-- Confetti Canvas -->
<div class="confetti-container" id="confettiContainer"></div>

<!-- STICKY GLASSMORPHIC NAVBAR -->
<nav class="navbar navbar-expand-lg sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('images/logo-icon.png') }}" alt="Logo" style="height: 38px; width: auto;" onerror="this.src='https://images.unsplash.com/photo-1595974482597-4b8da8879bc5?q=80&w=120'">
            PanenHub
        </a>
        
        <!-- Search bar desktop -->
        <div class="search-container d-none d-md-flex">
            <div class="search-input-group w-100">
                <input type="text" id="searchInput" class="search-input" placeholder="Cari komoditas, lokasi, atau nama mitra tani..." onkeyup="filterProducts()">
                <button class="search-btn" onclick="filterProducts()"><i class="bi bi-search"></i></button>
            </div>
        </div>
        
        <div class="d-flex align-items-center gap-2 gap-sm-3 ms-auto">
            <!-- Cart Icon -->
            <a href="javascript:void(0)" class="nav-cart-btn" onclick="openCart()" title="Keranjang Belanja">
                <i class="bi bi-cart3 fs-5"></i>
                <span id="cartCount" class="position-absolute nav-cart-badge badge bg-danger" style="display:none">0</span>
            </a>
            
            @auth
                <div class="dropdown">
                    <button class="btn btn-premium-outline dropdown-toggle px-3 px-sm-4" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle fs-6"></i>
                        <span class="d-none d-sm-inline ms-1">{{ Auth::user()->name }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end rounded-4 shadow border-0 mt-2 p-2" aria-labelledby="profileDropdown">
                        <li><h6 class="dropdown-header text-muted">Akses Akun Pembeli</h6></li>
                        <li><a class="dropdown-item rounded-3" href="{{ route('buyer.orders') }}"><i class="bi bi-bag-check me-2 text-success"></i>Pesanan Saya</a></li>
                        <li><a class="dropdown-item rounded-3" href="{{ route('chat.index') }}"><i class="bi bi-chat-dots me-2 text-success"></i>Pesan Penawaran</a></li>
                        
                        @if(Auth::user()->role === 'mitra')
                            <li><hr class="dropdown-divider"></li>
                            <li><h6 class="dropdown-header text-muted">Dashboard Mitra Tani</h6></li>
                            <li><a class="dropdown-item rounded-3 text-success fw-bold" href="{{ route('mitra.products') }}"><i class="bi bi-speedometer2 me-2"></i>Kelola Hasil Panen</a></li>
                        @endif
                        
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="/api/logout" method="POST" class="m-0" onsubmit="localStorage.removeItem('panenhub_cart')">
                                @csrf
                                <button type="submit" class="dropdown-item rounded-3 text-danger"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <button class="btn btn-premium-solid" onclick="openLogin()">
                    <i class="bi bi-box-arrow-in-right"></i> Masuk
                </button>
            @endauth
        </div>
    </div>
</nav>

<!-- Mobile Search Bar -->
<div class="container d-md-none mt-3 px-3">
    <div class="search-input-group">
        <input type="text" id="searchInputMobile" class="search-input" placeholder="Cari beras premium, cabai, bawang..." onkeyup="filterProducts()">
        <button class="search-btn" onclick="filterProducts()"><i class="bi bi-search"></i></button>
    </div>
</div>

<!-- WOW HERO SECTION -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <!-- Left Grid Content -->
            <div class="col-lg-6 pr-lg-5">
                <div class="mb-3">
                    <span class="badge-premium-direct">
                        <i class="bi bi-shield-check text-success"></i> Hubungan Langsung Petani & Pembeli
                    </span>
                </div>
                <h1 class="hero-title">
                    Digitalisasi Kedaulatan Pangan Lokal <span>PanenHub!</span>
                </h1>
                <p class="hero-subtext">
                    Dapatkan penawaran kontrak terbaik untuk komoditas segar langsung dari penggilingan & lahan petani lokal dengan kepastian harga optimal, transaksi 100% aman, dan kualitas terjamin.
                </p>
                <div class="d-flex flex-column flex-sm-row gap-3">
                    <a href="#marketplace" class="btn-premium-accent"><i class="bi bi-grid-3x3-gap"></i> Lihat Penawaran Kontrak</a>
                    <a href="javascript:void(0)" onclick="openMitraModal()" class="btn-premium-outline"><i class="bi bi-patch-plus"></i> Gabung Mitra Petani</a>
                </div>
            </div>
            
            <!-- Right Grid Visual Widget -->
            <div class="col-lg-6">
                <div class="position-relative">
                    <div class="hero-widget-bg-decor"></div>
                    <div class="hero-widget-card">
                        <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-success-subtle text-success p-2 rounded-circle">
                                    <i class="bi bi-buildings-fill fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">Statistik Kemitraan Tani</h6>
                                    <span class="text-muted small">Update Realtime Nasional</span>
                                </div>
                            </div>
                            <span class="badge bg-success text-white py-2 px-3 rounded-pill fw-bold">Live</span>
                        </div>
                        
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="p-3 bg-light rounded-4 text-center border">
                                    <span class="h2 d-block fw-bold text-success mb-0">50+</span>
                                    <span class="small text-muted text-uppercase fw-semibold" style="font-size:0.68rem; letter-spacing:0.5px;">Mitra Kelompok Tani</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 bg-light rounded-4 text-center border">
                                    <span class="h2 d-block fw-bold text-success mb-0">1.4K Ton</span>
                                    <span class="small text-muted text-uppercase fw-semibold" style="font-size:0.68rem; letter-spacing:0.5px;">Terdistribusi Aman</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 p-3 bg-success-subtle text-success rounded-4 d-flex align-items-center gap-3 border border-success border-opacity-10">
                            <i class="bi bi-award-fill fs-3"></i>
                            <div>
                                <h6 class="mb-0 fw-bold" style="font-size: 0.9rem;">Secure Direct Payment</h6>
                                <p class="mb-0 small" style="font-size: 0.8rem; opacity:0.9;">Pembayaran langsung ditransfer ke rekening petani secara aman setelah pemesanan dikonfirmasi melalui sistem PanenHub.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- LIVE COMMODITY MARQUEE TICKER -->
<div class="live-ticker-bar">
    <div class="ticker-track">
        <div class="ticker-item up"><i class="bi bi-fire"></i> Beras Premium IR64 — Menjadi salah satu komoditas paling dicari minggu ini (Rp15.555/kg)</div>
        <div class="ticker-item up"><i class="bi bi-arrow-up-right-circle-fill"></i> Cabai Rawit Merah — Permintaan meningkat dalam 7 hari terakhir (Rp45.000/kg)</div>
        <div class="ticker-item stable"><i class="bi bi-check-circle-fill"></i> Bawang Merah — Pasokan stabil dengan permintaan tinggi (Rp28.000/kg)</div>
        <div class="ticker-item down"><i class="bi bi-arrow-down-right-circle-fill"></i> Wortel Nantes — Pasokan melimpah, permintaan menurun (Rp8.000/kg)</div>
        <!-- Duplicate for loop to make marquee run seamless -->
        <div class="ticker-item up"><i class="bi bi-fire"></i> Beras Premium IR64 — Menjadi salah satu komoditas paling dicari minggu ini (Rp15.555/kg)</div>
        <div class="ticker-item up"><i class="bi bi-arrow-up-right-circle-fill"></i> Cabai Rawit Merah — Permintaan meningkat dalam 7 hari terakhir (Rp45.000/kg)</div>
        <div class="ticker-item stable"><i class="bi bi-check-circle-fill"></i> Bawang Merah — Pasokan stabil dengan permintaan tinggi (Rp28.000/kg)</div>
        <div class="ticker-item down"><i class="bi bi-arrow-down-right-circle-fill"></i> Wortel Nantes — Pasokan melimpah, permintaan menurun (Rp8.000/kg)</div>
    </div>
</div>

<!-- PanenHub Market Index Section -->
<section class="container mt-5 pt-4">
    <div class="price-section-header">
        <h2 class="fw-bold mb-2">Tren &amp; Indeks Permintaan Pasar</h2>
        <p class="text-muted">Analisis dan pergerakan tren pasar mingguan untuk membantu petani lokal dan pembeli memantau permintaan komoditas secara real-time dan transparan.</p>
    </div>
    
    <div class="row g-4">
        <!-- Card 1: Beras Premium IR64 (Paling Dicari) -->
        <div class="col-md-6 col-lg-3" onclick="openChartModal('Beras Premium IR64', 15555, 'Komoditas Paling Dicari', 'naik', [14800, 14900, 15100, 15200, 15350, 15555])">
            <div class="price-card card-up cursor-pointer h-100 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-muted small text-uppercase fw-bold" style="font-size:0.65rem; letter-spacing:0.5px;">Beras Premium</span>
                            <h5 class="fw-bold mt-1 mb-0" style="font-size: 1.05rem;">Beras Premium IR64</h5>
                        </div>
                        <span class="price-trend-badge up" style="font-size: 0.65rem;"><i class="bi bi-fire"></i> POPULER</span>
                    </div>
                    <h4 class="fw-bold text-success mt-3 mb-3">Rp 15.555 <span style="font-size:0.8rem; color:#777; font-weight: 500;">/kg</span></h4>
                    
                    <!-- Demand Info Banner -->
                    <div class="demand-banner demand-banner-up">
                        <i class="bi bi-graph-up mt-0.5"></i>
                        <span>Menjadi salah satu komoditas paling dicari minggu ini</span>
                    </div>
                </div>

                <div class="sparkline-container mt-2">
                    <div class="sparkbar" style="height: 30%;" data-val="14.800"></div>
                    <div class="sparkbar" style="height: 40%;" data-val="14.900"></div>
                    <div class="sparkbar" style="height: 55%;" data-val="15.100"></div>
                    <div class="sparkbar" style="height: 65%;" data-val="15.200"></div>
                    <div class="sparkbar" style="height: 80%;" data-val="15.350"></div>
                    <div class="sparkbar" style="height: 100%;" data-val="15.555"></div>
                </div>
            </div>
        </div>

        <!-- Card 2: Cabai Rawit Merah (Permintaan Meningkat) -->
        <div class="col-md-6 col-lg-3" onclick="openChartModal('Cabai Rawit Merah', 45000, 'Permintaan Meningkat', 'naik', [41000, 42000, 42800, 43500, 44200, 45000])">
            <div class="price-card card-up cursor-pointer h-100 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-muted small text-uppercase fw-bold" style="font-size:0.65rem; letter-spacing:0.5px;">Cabai Tani</span>
                            <h5 class="fw-bold mt-1 mb-0" style="font-size: 1.05rem;">Cabai Rawit Merah</h5>
                        </div>
                        <span class="price-trend-badge up" style="font-size: 0.65rem;"><i class="bi bi-arrow-up-right"></i> MENINGKAT</span>
                    </div>
                    <h4 class="fw-bold text-success mt-3 mb-3">Rp 45.000 <span style="font-size:0.8rem; color:#777; font-weight: 500;">/kg</span></h4>
                    
                    <!-- Demand Info Banner -->
                    <div class="demand-banner demand-banner-up">
                        <i class="bi bi-graph-up mt-0.5"></i>
                        <span>Permintaan meningkat dalam 7 hari terakhir</span>
                    </div>
                </div>

                <div class="sparkline-container mt-2">
                    <div class="sparkbar" style="height: 25%;" data-val="41.000"></div>
                    <div class="sparkbar" style="height: 42%;" data-val="42.000"></div>
                    <div class="sparkbar" style="height: 58%;" data-val="42.800"></div>
                    <div class="sparkbar" style="height: 70%;" data-val="43.500"></div>
                    <div class="sparkbar" style="height: 85%;" data-val="44.200"></div>
                    <div class="sparkbar" style="height: 100%;" data-val="45.000"></div>
                </div>
            </div>
        </div>

        <!-- Card 3: Bawang Merah (Permintaan Stabil) -->
        <div class="col-md-6 col-lg-3" onclick="openChartModal('Bawang Merah', 28000, 'Permintaan Stabil', 'stabil', [28000, 27900, 28100, 28000, 27950, 28000])">
            <div class="price-card card-stable cursor-pointer h-100 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-muted small text-uppercase fw-bold" style="font-size:0.65rem; letter-spacing:0.5px;">Bumbu Dapur</span>
                            <h5 class="fw-bold mt-1 mb-0" style="font-size: 1.05rem;">Bawang Merah</h5>
                        </div>
                        <span class="price-trend-badge stable" style="font-size: 0.65rem;"><i class="bi bi-dash-circle"></i> STABIL</span>
                    </div>
                    <h4 class="fw-bold text-info mt-3 mb-3">Rp 28.000 <span style="font-size:0.8rem; color:#777; font-weight: 500;">/kg</span></h4>
                    
                    <!-- Demand Info Banner -->
                    <div class="demand-banner demand-banner-stable">
                        <i class="bi bi-check-circle mt-0.5"></i>
                        <span>Pasokan stabil dengan permintaan tinggi</span>
                    </div>
                </div>

                <div class="sparkline-container mt-2">
                    <div class="sparkbar" style="height: 100%;" data-val="28.000"></div>
                    <div class="sparkbar" style="height: 95%;" data-val="27.900"></div>
                    <div class="sparkbar" style="height: 100%;" data-val="28.100"></div>
                    <div class="sparkbar" style="height: 100%;" data-val="28.000"></div>
                    <div class="sparkbar" style="height: 98%;" data-val="27.950"></div>
                    <div class="sparkbar" style="height: 100%;" data-val="28.000"></div>
                </div>
            </div>
        </div>

        <!-- Card 4: Wortel Nantes (Permintaan Menurun) -->
        <div class="col-md-6 col-lg-3" onclick="openChartModal('Wortel Nantes', 8000, 'Permintaan Menurun', 'turun', [9800, 9400, 9000, 8600, 8300, 8000])">
            <div class="price-card card-down cursor-pointer h-100 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-muted small text-uppercase fw-bold" style="font-size:0.65rem; letter-spacing:0.5px;">Sayur Segar</span>
                            <h5 class="fw-bold mt-1 mb-0" style="font-size: 1.05rem;">Wortel Nantes</h5>
                        </div>
                        <span class="price-trend-badge down" style="font-size: 0.65rem;"><i class="bi bi-arrow-down-right"></i> MENURUN</span>
                    </div>
                    <h4 class="fw-bold text-danger mt-3 mb-3">Rp 8.000 <span style="font-size:0.8rem; color:#777; font-weight: 500;">/kg</span></h4>
                    
                    <!-- Demand Info Banner -->
                    <div class="demand-banner demand-banner-down">
                        <i class="bi bi-graph-down mt-0.5"></i>
                        <span>Tren pasar mingguan: Pasokan melimpah, permintaan menurun</span>
                    </div>
                </div>

                <div class="sparkline-container mt-2">
                    <div class="sparkbar" style="height: 100%;" data-val="9.800"></div>
                    <div class="sparkbar" style="height: 85%;" data-val="9.400"></div>
                    <div class="sparkbar" style="height: 70%;" data-val="9.000"></div>
                    <div class="sparkbar" style="height: 55%;" data-val="8.600"></div>
                    <div class="sparkbar" style="height: 40%;" data-val="8.300"></div>
                    <div class="sparkbar" style="height: 25%;" data-val="8.000"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- THE INTERACTIVE MARKETPLACE SECTION -->
<section class="container mt-5 pt-5 px-4 px-md-0" id="marketplace">
    <div class="text-center mb-5">
        <span class="process-title-tag">Marketplace PanenHub</span>
        <h2 class="fw-bold mb-2">Pilih Komoditas Sesuai Kebutuhan Anda</h2>
        <p class="text-muted">Transaksi Spot dengan pengiriman instan, atau Kunci Deal Pra-Panen dengan DP Lock 20%.</p>
    </div>

    <!-- DOUBLE TABS SWITCH -->
    <div class="market-tab-container">
        <button id="tabSpotMarket" class="market-tab-btn active" onclick="switchMarketTab('spot')">
            <i class="bi bi-lightning-fill"></i> Spot Market (Siap Kirim)
        </button>
        <button id="tabPreHarvest" class="market-tab-btn" onclick="switchMarketTab('preharvest')">
            <i class="bi bi-clock-history"></i> Kontrak Pra-Panen (Booking DP)
        </button>
    </div>

    <!-- PREMIUM INTEGRATED FILTERS PANEL -->
    <div class="filters-panel">
        <div class="row g-3">
            <div class="col-md-4">
                <label class="small fw-bold text-muted mb-2">PENCARIAN KATA KUNCI</label>
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-end-0 border-success border-opacity-15"><i class="bi bi-search text-success"></i></span>
                    <input type="text" id="marketSearch" class="form-control border-start-0 border-success border-opacity-15 shadow-none" placeholder="Cari beras, cabai, bawang, lokasi..." onkeyup="runGridFilters()">
                </div>
            </div>
            <div class="col-md-3">
                <label class="small fw-bold text-muted mb-2">KATEGORI PRODUK</label>
                <select id="filterCategory" class="filter-select" onchange="runGridFilters()">
                    <option value="">Semua Kategori</option>
                    <option value="beras">Beras</option>
                    <option value="sayur">Sayur</option>
                    <option value="buah">Buah</option>
                    <option value="lainnya">Lainnya</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="small fw-bold text-muted mb-2">LOKASI LAHAN</label>
                <select id="filterLocation" class="filter-select" onchange="runGridFilters()">
                    <option value="">Semua Wilayah</option>
                    <option value="Jawa Barat">Jawa Barat</option>
                    <option value="Jawa Tengah">Jawa Tengah</option>
                    <option value="Jawa Timur">Jawa Timur</option>
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button class="btn btn-premium-outline w-100 py-2 d-flex justify-content-center align-items-center" onclick="resetGridFilters()">
                    <i class="bi bi-arrow-counterclockwise"></i> Reset
                </button>
            </div>
        </div>
    </div>

    <!-- TAB 1: SPOT MARKET REAL DATABASE PRODUCTS -->
    <div id="spotMarketGrid" class="market-view-pane">
        <div class="row g-4 justify-content-center" id="spotProductsRow">
            @forelse($products as $product)
                @php
                    // Dynamic High-Fidelity Crop Images
                    $imagePath = 'storage/' . $product->image;
                    if (!file_exists(public_path($imagePath)) || empty($product->image)) {
                        if (str_contains(strtolower($product->name), 'merah')) {
                            $imagePath = 'https://images.unsplash.com/photo-1586201375761-83865001e31c?q=80&w=600';
                        } elseif (str_contains(strtolower($product->name), 'pandan') || str_contains(strtolower($product->name), 'wangi') || str_contains(strtolower($product->name), 'organik')) {
                            $imagePath = 'https://images.unsplash.com/photo-1536304997881-a372c179924b?q=80&w=600';
                        } elseif (str_contains(strtolower($product->name), 'ketan')) {
                            $imagePath = 'https://images.unsplash.com/photo-1596450514735-111a2fe02935?q=80&w=600';
                        } else {
                            $imagePath = 'https://images.unsplash.com/photo-1536304997881-a372c179924b?q=80&w=600';
                        }
                    } else {
                        $imagePath = asset($imagePath);
                    }
                @endphp
                
                <div class="col-12 col-md-4 col-lg-4 product-card-col fade-in" 
                     data-name="{{ strtolower($product->name) }}" 
                     data-mitra="{{ strtolower($product->user->name ?? '') }}"
                     data-cat="{{ strtolower($product->category) }}" 
                     data-loc="{{ strtolower($product->location ?? $product->user->address ?? 'Jawa Tengah') }}">
                    
                    <div class="card-product-premium border border-gray-155 bg-white shadow-sm p-3 h-100" style="border-radius: 20px;">
                        <div class="product-img-wrapper position-relative overflow-hidden mb-3" style="height: 180px; border-radius: 16px;">
                            <img src="{{ $imagePath }}" alt="{{ $product->name }}" class="w-100 h-100 object-fit-cover">
                        </div>
                        <div class="product-body">
                            <!-- Sprout Avatar & Title -->
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 42px; height: 42px; background-color: rgba(46, 125, 50, 0.1);">
                                    <i class="bi bi-sprout text-success fs-5"></i>
                                </div>
                                <div class="overflow-hidden">
                                    <span class="badge px-2 py-1 rounded bg-success bg-opacity-10 text-success fw-bold text-uppercase mb-1" style="font-size: 0.65rem; letter-spacing: 0.5px; display: inline-block;">
                                        {{ $product->category }}
                                    </span>
                                    <h5 class="fw-bold mb-0 text-dark text-truncate" style="font-size: 1.15rem; font-family: 'Plus Jakarta Sans', sans-serif;" title="{{ $product->name }}">{{ $product->name }}</h5>
                                    <div class="text-muted small d-flex align-items-center gap-1 text-truncate" style="font-size: 0.8rem;">
                                        <i class="bi bi-geo-alt-fill text-danger" style="font-size: 0.85rem;"></i>
                                        <span>{{ $product->location ?? $product->user->address ?? 'Jawa Tengah' }}</span>
                                        <span class="mx-1">•</span>
                                        <span>Est: Instan</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Price Row -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="fw-extrabold text-dark mb-0" style="font-size: 1.4rem; font-weight: 800;">Rp {{ number_format($product->price, 0, ',', '.') }}<span style="font-size: 0.85rem; font-weight: 500; color: #777;">/kg</span></h4>
                                <span class="badge d-flex align-items-center gap-1 px-2.5 py-1.5 rounded-pill" style="background-color: rgba(22, 101, 52, 0.08); color: #166534; font-size: 0.75rem; border: 1px solid rgba(22, 101, 52, 0.15); font-weight: 600;">
                                    <i class="bi bi-patch-check-fill text-success"></i> Verified
                                </span>
                            </div>

                            <!-- Tonnage / Stock & Rating Row -->
                            <div class="d-flex justify-content-between align-items-center mb-3 text-muted" style="font-size: 0.82rem;">
                                <div class="d-flex align-items-center gap-1.5">
                                    <i class="bi bi-hourglass-split text-secondary"></i>
                                    <span>Stok: <strong class="text-dark">{{ $product->stock }} kg</strong></span>
                                </div>
                                <div class="d-flex align-items-center gap-1 text-warning">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <span class="text-dark fw-bold">4.9</span> <span class="text-muted small" style="font-size: 0.7rem;">({{ $product->sold_quantity }} terjual)</span>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex gap-2 mb-3">
                                @if($product->stock > 0)
                                    <button class="btn w-50 py-2 fw-bold" style="border: 1.5px solid #2e7d32; color: #2e7d32; border-radius: 10px; font-size: 0.85rem; background: white; transition: 0.2s;" 
                                            onclick="addToCart('product-{{ $product->id }}','{{ addslashes($product->name) }}', {{ (int)$product->price }}, '{{ $imagePath }}', '{{ addslashes($product->user->name ?? 'Mitra PanenHub') }}')"
                                            onmouseover="this.style.backgroundColor='#f4fdf6'" onmouseout="this.style.backgroundColor='white'">
                                        + Keranjang
                                    </button>
                                @else
                                    <button class="btn w-50 py-2 fw-bold" style="border: 1.5px solid #ccc; color: #888; border-radius: 10px; font-size: 0.85rem; background: white; cursor: not-allowed; transition: 0.2s;" disabled>
                                        Habis
                                    </button>
                                @endif
                                <button class="btn btn-success w-50 py-2 fw-bold" style="background-color: #2e7d32; border-color: #2e7d32; border-radius: 10px; font-size: 0.85rem; transition: 0.2s;" 
                                        onclick="openBidModal('{{ addslashes($product->name) }}', {{ (int)$product->price }}, '{{ addslashes($product->user->name ?? 'Mitra PanenHub') }}', {{ $product->stock }}, 'Instan', {{ $product->user_id ?? 'null' }})">
                                    Nego Kontrak
                                </button>
                            </div>

                            <!-- Spot Market Pill -->
                            <div class="text-center">
                                <span class="badge py-1.5 px-3 rounded-pill text-uppercase" style="background-color: #e8f7ec; color: #1b5e20; font-size: 0.7rem; font-weight: 700; letter-spacing: 0.5px; border: 1px solid rgba(27, 94, 32, 0.15);">
                                    SIAP KIRIM: INSTAN
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5 text-muted">
                    <i class="bi bi-basket fs-1 mb-3 d-block text-success"></i>
                    <h5>Belum Ada Hasil Spot Tani yang Terdaftar</h5>
                    <p class="small">Silakan mendaftar sebagai Mitra Tani untuk mengupload beras premium Anda.</p>
                </div>
            @endforelse
        </div>

        <!-- PAGINATION CONTROLS -->
        <div id="spotPaginationControls" class="d-flex align-items-center justify-content-center gap-3 mt-5">
            <button id="spotPrevBtn" onclick="changeSpotPage(-1)" disabled
                style="width:44px;height:44px;border-radius:50%;border:2px solid #2e7d32;background:white;color:#2e7d32;font-size:1.2rem;display:flex;align-items:center;justify-content:center;transition:all 0.3s;cursor:pointer;"
                onmouseover="if(!this.disabled){this.style.background='#2e7d32';this.style.color='white';}" 
                onmouseout="if(!this.disabled){this.style.background='white';this.style.color='#2e7d32';} else {this.style.background='#f1f5f9';}">
                <i class="bi bi-chevron-left"></i>
            </button>
            <div id="spotPageInfo" style="font-weight:700;color:#2e7d32;font-size:0.9rem;min-width:80px;text-align:center;"></div>
            <button id="spotNextBtn" onclick="changeSpotPage(1)"
                style="width:44px;height:44px;border-radius:50%;border:2px solid #2e7d32;background:white;color:#2e7d32;font-size:1.2rem;display:flex;align-items:center;justify-content:center;transition:all 0.3s;cursor:pointer;"
                onmouseover="if(!this.disabled){this.style.background='#2e7d32';this.style.color='white';}" 
                onmouseout="if(!this.disabled){this.style.background='white';this.style.color='#2e7d32';} else {this.style.background='#f1f5f9';}">
                <i class="bi bi-chevron-right"></i>
            </button>
        </div>
    </div>

    <!-- TAB 2: KONTRAK PRA-PANEN (MOCKED HIGH-FIDELITY PRE-HARVEST LISTINGS) -->
    <div id="preHarvestGrid" class="market-view-pane" style="display:none;">
        <div class="row g-4 justify-content-center" id="preHarvestProductsRow">
            @forelse($products as $product)
                @php
                    $imagePath = 'storage/' . $product->image;
                    if (!file_exists(public_path($imagePath)) || empty($product->image)) {
                        if (str_contains(strtolower($product->name), 'merah')) {
                            $imagePath = 'https://images.unsplash.com/photo-1586201375761-83865001e31c?q=80&w=600';
                        } elseif (str_contains(strtolower($product->name), 'pandan') || str_contains(strtolower($product->name), 'wangi') || str_contains(strtolower($product->name), 'organik')) {
                            $imagePath = 'https://images.unsplash.com/photo-1536304997881-a372c179924b?q=80&w=600';
                        } elseif (str_contains(strtolower($product->name), 'ketan')) {
                            $imagePath = 'https://images.unsplash.com/photo-1596450514735-111a2fe02935?q=80&w=600';
                        } else {
                            $imagePath = 'https://images.unsplash.com/photo-1536304997881-a372c179924b?q=80&w=600';
                        }
                    } else {
                        $imagePath = asset($imagePath);
                    }
                @endphp
                
                <div class="col-12 col-md-4 col-lg-4 product-card-col fade-in" 
                     data-name="{{ strtolower($product->name) }}" 
                     data-mitra="{{ strtolower($product->user->name ?? '') }}"
                     data-cat="{{ strtolower($product->category) }}" 
                     data-loc="{{ strtolower($product->location ?? $product->user->address ?? 'Jawa Tengah') }}">
                    
                    <div class="card-product-premium border border-gray-150 rounded-4 overflow-hidden bg-white shadow-sm p-3 h-100" style="border-radius: 20px;">
                        <div class="product-img-wrapper position-relative overflow-hidden mb-3" style="height: 180px; border-radius: 16px;">
                            <img src="{{ $imagePath }}" alt="{{ $product->name }}" class="w-100 h-100 object-fit-cover">
                        </div>
                        <div class="product-body">
                            <!-- Sprout Avatar & Title -->
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 42px; height: 42px; background-color: rgba(46, 125, 50, 0.1);">
                                    <i class="bi bi-sprout text-success fs-5"></i>
                                </div>
                                <div class="overflow-hidden">
                                    <span class="badge px-2 py-1 rounded bg-success bg-opacity-10 text-success fw-bold text-uppercase mb-1" style="font-size: 0.65rem; letter-spacing: 0.5px; display: inline-block;">
                                        {{ $product->category }}
                                    </span>
                                    <h5 class="fw-bold mb-0 text-dark text-truncate" style="font-size: 1.15rem; font-family: 'Plus Jakarta Sans', sans-serif;" title="{{ $product->name }}">{{ $product->name }}</h5>
                                    <div class="text-muted small d-flex align-items-center gap-1 text-truncate" style="font-size: 0.8rem;">
                                        <i class="bi bi-geo-alt-fill text-danger" style="font-size: 0.85rem;"></i>
                                        <span>{{ $product->location ?? $product->user->address ?? 'Jawa Tengah' }}</span>
                                        <span class="mx-1">•</span>
                                        <span>Est: 14 hari</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Price Row -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="fw-extrabold text-dark mb-0" style="font-size: 1.4rem; font-weight: 800;">Rp {{ number_format($product->price, 0, ',', '.') }}<span style="font-size: 0.85rem; font-weight: 500; color: #777;">/kg</span></h4>
                                <span class="badge d-flex align-items-center gap-1 px-2.5 py-1.5 rounded-pill" style="background-color: rgba(22, 101, 52, 0.08); color: #166534; font-size: 0.75rem; border: 1px solid rgba(22, 101, 52, 0.15); font-weight: 600;">
                                    <i class="bi bi-patch-check-fill text-success"></i> Verified
                                </span>
                            </div>

                            <!-- Tonnage & Rating Row -->
                            <div class="d-flex justify-content-between align-items-center mb-3 text-muted" style="font-size: 0.82rem;">
                                <div class="d-flex align-items-center gap-1.5">
                                    <i class="bi bi-hourglass-split text-secondary"></i>
                                    <span>Tonase: <strong class="text-dark">{{ $product->stock }} kg</strong></span>
                                </div>
                                <div class="d-flex align-items-center gap-1 text-warning">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <span class="text-dark fw-bold">4.9</span> <span class="text-muted small" style="font-size: 0.7rem;">({{ $product->sold_quantity }} deal)</span>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex gap-2 mb-3">
                                <button class="btn w-50 py-2 fw-bold" style="border: 1.5px solid #2e7d32; color: #2e7d32; border-radius: 10px; font-size: 0.85rem; background: white; transition: 0.2s;" onmouseover="this.style.backgroundColor='#f4fdf6'" onmouseout="this.style.backgroundColor='white'">
                                    Lihat Detail
                                </button>
                                <button class="btn btn-success w-50 py-2 fw-bold" style="background-color: #2e7d32; border-color: #2e7d32; border-radius: 10px; font-size: 0.85rem; transition: 0.2s;" 
                                        onclick="openBidModal('{{ addslashes($product->name) }}', {{ (int)$product->price }}, '{{ addslashes($product->user->name ?? 'Mitra PanenHub') }}', {{ $product->stock }}, '14 hari', {{ $product->user_id ?? 'null' }})">
                                    Ajukan Penawaran
                                </button>
                            </div>

                            <!-- DP Lock Pill -->
                            <div class="text-center">
                                <span class="badge py-1.5 px-3 rounded-pill text-uppercase" style="background-color: #f1f5f9; color: #64748b; font-size: 0.7rem; font-weight: 700; letter-spacing: 0.5px;">
                                    DP LOCK: 20%
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5 text-muted">
                    <i class="bi bi-basket fs-1 mb-3 d-block text-success"></i>
                    <h5>Belum Ada Hasil Tani untuk Penawaran Kontrak</h5>
                </div>
            @endforelse
        </div>

        <!-- PRE-HARVEST PAGINATION CONTROLS -->
        <div id="preHarvestPaginationControls" class="d-flex align-items-center justify-content-center gap-3 mt-5">
            <button id="preHarvestPrevBtn" onclick="changePreHarvestPage(-1)" disabled
                style="width:44px;height:44px;border-radius:50%;border:2px solid #2e7d32;background:white;color:#2e7d32;font-size:1.2rem;display:flex;align-items:center;justify-content:center;transition:all 0.3s;cursor:pointer;"
                onmouseover="if(!this.disabled){this.style.background='#2e7d32';this.style.color='white';}" 
                onmouseout="if(!this.disabled){this.style.background='white';this.style.color='#2e7d32';} else {this.style.background='#f1f5f9';}">
                <i class="bi bi-chevron-left"></i>
            </button>
            <div id="preHarvestPageInfo" style="font-weight:700;color:#2e7d32;font-size:0.9rem;min-width:80px;text-align:center;"></div>
            <button id="preHarvestNextBtn" onclick="changePreHarvestPage(1)"
                style="width:44px;height:44px;border-radius:50%;border:2px solid #2e7d32;background:white;color:#2e7d32;font-size:1.2rem;display:flex;align-items:center;justify-content:center;transition:all 0.3s;cursor:pointer;"
                onmouseover="if(!this.disabled){this.style.background='#2e7d32';this.style.color='white';}" 
                onmouseout="if(!this.disabled){this.style.background='white';this.style.color='#2e7d32';} else {this.style.background='#f1f5f9';}">
                <i class="bi bi-chevron-right"></i>
            </button>
        </div>
    </div>
</section>

<!-- INTERACTIVE PROCESS CARA KERJA SECTION -->
<section class="process-section">
    <div class="container text-center">
        <span class="process-title-tag">Alur Proses Terintegrasi</span>
        <h2 class="fw-bold mb-2">Cara Kerja PanenHub</h2>
        <p class="text-muted mb-5">Sistem terintegrasi dari hulu ke hilir yang memastikan hasil panen Anda terdistribusi dengan aman dan efisien.</p>
        
        <div class="row g-4 mt-2">
            <!-- Step 1 -->
            <div class="col-md-6 col-lg-3">
                <div class="process-card-step">
                    <span class="process-badge-num">1</span>
                    <div class="process-icon-bg">
                        <i class="bi bi-person-fill-add"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Daftar Petani</h5>
                    <p class="small text-muted mb-0">Petani membuat akun dan menambahkan komoditas hasil panen lengkap dengan harga, stok, dan deskripsi.</p>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="col-md-6 col-lg-3">
                <div class="process-card-step">
                    <span class="process-badge-num">2</span>
                    <div class="process-icon-bg">
                        <i class="bi bi-file-earmark-ruled-fill"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Produk Katalog</h5>
                    <p class="small text-muted mb-0"> Produk yang diunggah akan tampil di marketplace PanenHub dan dapat dilihat oleh pembeli.</p>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="col-md-6 col-lg-3">
                <div class="process-card-step">
                    <span class="process-badge-num">3</span>
                    <div class="process-icon-bg">
                        <i class="bi bi-flower1"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Pemesanan</h5>
                    <p class="small text-muted mb-0">Pembeli memilih produk yang diinginkan dan melakukan pemesanan langsung melalui platform.</p>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="col-md-6 col-lg-3">
                <div class="process-card-step">
                    <span class="process-badge-num">4</span>
                    <div class="process-icon-bg">
                        <i class="bi bi-truck"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Pengiriman & Transaksi</h5>
                    <p class="small text-muted mb-0">Produk dikirim ke pembeli, lalu transaksi dikonfirmasi selesai setelah barang diterima.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- WHY CHOOSE US & NEWSLETTER SECTION -->
<section class="why-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <!-- Left grid Features -->
            <div class="col-lg-6">
                <span class="process-title-tag">Solusi AgriTech Modern</span>
                <h2 class="fw-bold mb-4 mt-2">Kenapa Anda Harus Memilih PanenHub?</h2>
                <p class="text-muted mb-5">Kami bukan sekadar marketplace, PanenHub adalah ekosistem digital yang menghubungkan petani lokal dengan pembeli secara langsung, transparan, dan efisien untuk mendukung distribusi hasil panen yang lebih adil.</p>
                
                <!-- Feature 1 -->
                <div class="why-feature-row">
                    <div class="why-feature-icon">
                        <i class="bi bi-shield-fill-check"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Direct from Farmers Marketplace</h6>
                        <p class="small text-muted">Setiap produk berasal langsung dari petani lokal tanpa perantara berlebihan, sehingga kualitas lebih terjamin dan harga tetap kompetitif.</p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="why-feature-row">
                    <div class="why-feature-icon">
                        <i class="bi bi-speedometer2"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Real-Time Market Price Insight</h6>
                        <p class="small text-muted">Dilengkapi informasi harga komoditas nasional sebagai acuan, membantu petani menentukan harga jual dan pembeli mendapatkan harga yang wajar dan transparan.</p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="why-feature-row">
                    <div class="why-feature-icon">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Simple & Transparent Transaction System</h6>
                        <p class="small text-muted">Proses pemesanan dilakukan langsung melalui platform mulai dari pemilihan produk, pemesanan, hingga konfirmasi transaksi secara mudah dan jelas.</p>
                    </div>
                </div>
            </div>

            <!-- Right grid newsletter -->
            <div class="col-lg-6">
                <div class="why-newsletter-card">
                    <div class="mb-4">
                        <i class="bi bi-stars fs-1 text-warning"></i>
                    </div>
                    <h3 class="fw-bold mb-2">Mulai Perjalanan Anda</h3>
                    <p class="mb-4 opacity-75">Bergabung dengan ribuan pembeli, agregator, dan mitra tani di seluruh Indonesia. Dapatkan akses penawaran eksklusif langsung dari lahan.</p>
                    
                    <form id="newsletterForm" onsubmit="handleNewsletter(event)">
                        <div class="news-input-pill">
                            <i class="bi bi-envelope-at fs-5 opacity-75 me-2"></i>
                            <input type="email" id="newsletterEmail" placeholder="Masukkan alamat email aktif Anda..." required>
                            <button type="submit" class="news-submit-btn">Gabung Gratis <i class="bi bi-arrow-right"></i></button>
                        </div>
                    </form>
                    <p class="small opacity-50 mt-3 mb-0 text-center text-sm-start"><i class="bi bi-info-circle"></i> Tanpa komitmen biaya. Berhenti langganan kapan saja.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- MODALS SYSTEM REDESIGNED -->

<!-- 1. LIVE CHART DETAILS POPUP MODAL -->
<div class="modal fade" id="chartAnalyticsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-premium">
            <div class="modal-header modal-header-premium">
                <h5 class="modal-title fw-bold" id="chartModalTitle"><i class="bi bi-graph-up-arrow me-2 text-warning"></i> Analisis Pergerakan Harga</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-body-premium">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <span class="text-muted small">Harga Rujukan Hari Ini</span>
                        <h3 class="fw-bold text-success mb-0" id="chartModalPrice">Rp 15.555</h3>
                    </div>
                    <span class="badge bg-success-subtle text-success py-2 px-3 rounded-pill fw-bold" id="chartModalTrend">+2.4%</span>
                </div>
                
                <p class="small text-muted mb-3">Tren perkembangan harga tingkat rujukan pasar (6 bulan terakhir):</p>
                
                <!-- Mock High Fidelity Vector Bars -->
                <div class="bg-light p-4 rounded-4 border mb-4">
                    <div class="d-flex align-items-end gap-3" style="height: 180px;" id="chartBarsContainer">
                        <!-- Bars dynamically loaded in JS -->
                    </div>
                    <div class="d-flex justify-content-between text-muted small mt-2 px-1" style="font-size: 0.72rem;">
                        <span>Des</span>
                        <span>Jan</span>
                        <span>Feb</span>
                        <span>Mar</span>
                        <span>Apr</span>
                        <span>Mei</span>
                    </div>
                </div>
                
                <div class="alert alert-success bg-success-subtle border-0 small mb-0 d-flex gap-2" id="chartModalAlertBox">
                    <i class="bi bi-info-circle-fill fs-5 mt-1" id="chartModalAlertIcon"></i>
                    <span id="chartModalAlertText">Indeks harga diperoleh secara objektif dari data rujukan gabungan penggilingan padi nasional dan pasar induk beras Jakarta.</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 2. PRE-HARVEST BID LOCK CALCULATOR MODAL -->
<div class="modal fade" id="bidNegotiationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content modal-content-premium">
            <div class="modal-header modal-header-premium">
                <h5 class="modal-title fw-bold"><i class="bi bi-shield-lock-fill text-warning me-2"></i> Kunci Penawaran Pra-Panen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-body-premium">
                <div class="row">
                    <!-- Left stats column -->
                    <div class="col-md-5 bg-light p-4 rounded-4 border mb-3 mb-md-0">
                        <span class="text-success fw-bold text-uppercase small" style="letter-spacing:0.5px;">Informasi Komoditas</span>
                        <h4 class="fw-bold mt-1 text-dark" id="bidModalItemName">Bawang Merah</h4>
                        <div class="text-muted small mt-2">Poktan Mitra: <strong class="text-dark" id="bidModalFarmer">Subur</strong></div>
                        <div class="text-muted small mt-1">Estimasi Panen: <strong class="text-dark" id="bidModalEst">5 Hari</strong></div>
                        
                        <hr>
                        
                        <div class="mb-3">
                            <span class="text-muted small">Harga Pokok Kontrak</span>
                            <h3 class="fw-bold text-success mb-0" id="bidModalPriceDisplay">Rp 28.000/kg</h3>
                        </div>
                        
                        <div class="p-3 bg-white rounded-3 border">
                            <span class="small text-muted d-block"><i class="bi bi-piggy-bank"></i> Ketentuan DP Lock</span>
                            <span class="small fw-semibold text-dark">Kunci penawaran dengan down payment minimum 20% dari total nilai transaksi.</span>
                        </div>
                    </div>
                    
                    <!-- Right calculator form -->
                    <div class="col-md-7 ps-md-4">
                        <h5 class="fw-bold text-dark mb-4">Kalkulator Pembayaran & Tonase</h5>
                        
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted d-flex justify-content-between">
                                <span>JUMLAH PESANAN (KILOGRAM)</span>
                                <span class="text-primary fw-bold" id="bidQtyDisplay">1,000 kg</span>
                            </label>
                            <input type="range" class="form-range calc-range" id="bidQtyInput" min="100" max="5000" step="50" value="1000" oninput="updateBidCalculator()">
                            <div class="d-flex justify-content-between text-muted small mt-1" style="font-size:0.75rem;">
                                <span>Min: 100 kg</span>
                                <span>Max Tonnage: <strong id="bidMaxTonnageDisplay">5,000 kg</strong></span>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-6">
                                <div class="p-3 bg-light rounded-3 border">
                                    <span class="text-muted small d-block" style="font-size:0.75rem;">Estimasi Total</span>
                                    <h5 class="fw-bold text-dark mb-0" id="bidCalcTotal">Rp 28,000,000</h5>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 bg-warning-subtle rounded-3 border border-warning border-opacity-25">
                                    <span class="text-warning-emphasis fw-semibold small d-block" style="font-size:0.75rem;"><i class="bi bi-wallet2"></i> DP Lock (20%)</span>
                                    <h5 class="fw-bold text-success mb-0" id="bidCalcDP">Rp 5,600,000</h5>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted">CATATAN NEGO & KESEPAKATAN</label>
                            <textarea class="form-control bg-light border border-success border-opacity-15 rounded-3" rows="3" placeholder="Contoh: Pengiriman menggunakan truk box berventilasi, kemasan karung 50kg..." id="bidNotesInput"></textarea>
                        </div>
                        
                        <button id="bidSubmitBtn" class="btn btn-premium-accent w-100 py-3 d-flex justify-content-center align-items-center gap-2" onclick="submitBidLock()">
                            <i class="bi bi-lock-fill"></i> Kunci Kontrak Penawaran
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 3. LOGIN & REGISTER MODALS SYSTEM -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content modal-content-premium">
            <div class="row g-0">
                <div class="col-md-6 auth-left p-5">
                    <button type="button" class="btn-close mb-3 float-end" data-bs-dismiss="modal"></button>
                    <h2 class="fw-bold mb-1">Selamat Datang!</h2>
                    <p class="text-muted small mb-4">Masuk untuk menikmati kemudahan transaksi pangan dari penggilingan petani lokal.</p>
                    <form action="/api/login" method="POST">
                        @csrf
                        <label class="small fw-bold text-muted mb-2">EMAIL PENGGUNA</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-light border-end-0 border-success border-opacity-15"><i class="bi bi-envelope text-success"></i></span>
                            <input type="email" name="email" class="form-control border-start-0 bg-light border-success border-opacity-15 shadow-none py-2" placeholder="email@contoh.com" required>
                        </div>
                        <label class="small fw-bold text-muted mb-2">PASSWORD</label>
                        <div class="input-group mb-4">
                            <span class="input-group-text bg-light border-end-0 border-success border-opacity-15"><i class="bi bi-shield-lock text-success"></i></span>
                            <input type="password" name="password" class="form-control border-start-0 bg-light border-success border-opacity-15 shadow-none py-2" placeholder="••••••••" required>
                        </div>
                        <button type="submit" class="btn-premium-solid w-100 py-3 justify-content-center">MASUK SEKARANG <i class="bi bi-arrow-right-short fs-5"></i></button>
                    </form>
                    
                    <div class="social-divider">atau masuk menggunakan</div>
                    <div class="social-group mb-4">
                        <a href="javascript:void(0)" class="btn-social" onclick="socialLogin('Google')"><i class="bi bi-google text-danger fs-5"></i></a>
                        <a href="javascript:void(0)" class="btn-social" onclick="socialLogin('Apple')"><i class="bi bi-apple fs-5"></i></a>
                        <a href="javascript:void(0)" class="btn-social" onclick="socialLogin('Facebook')"><i class="bi bi-facebook text-primary fs-5"></i></a>
                    </div>
                    <div class="text-center mt-3 small">
                        Belum punya akun? <a href="javascript:void(0)" onclick="bootstrap.Modal.getInstance(document.getElementById('loginModal')).hide(); setTimeout(openRegister, 400);" class="text-success fw-bold text-decoration-none">Daftar sekarang</a>
                    </div>
                </div>
                <div class="col-md-6 d-none d-md-flex auth-right bg-success-subtle p-5 text-center flex-column justify-content-center align-items-center">
                    <img src="{{ asset('images/logo-icon.png') }}" alt="PanenHub" class="login-logo-right mb-4" style="height: 90px; width: auto;" onerror="this.src='https://images.unsplash.com/photo-1595974482597-4b8da8879bc5?q=80&w=120'">
                    <h5 class="fw-bold text-success mb-2">Panen Raya Setiap Hari</h5>
                    <p class="small text-muted px-4 mb-0">Ribuan kelompok tani lokal menanti Anda. Dukung kesejahteraan agraris nasional bersama PanenHub.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="registerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content modal-content-premium">
            <div class="row g-0">
                <div class="col-md-6 auth-left p-5">
                    <button type="button" class="btn-close mb-3 float-end" data-bs-dismiss="modal"></button>
                    <h2 class="fw-bold mb-1">Daftar Akun</h2>
                    <p class="text-muted small mb-4">Buat akun pembeli untuk mendapatkan harga penawaran eksklusif dari petani.</p>
                    <form action="/api/register" method="POST">
                        @csrf
                        <label class="small fw-bold text-muted mb-2">NAMA LENGKAP</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-light border-end-0 border-success border-opacity-15"><i class="bi bi-person text-success"></i></span>
                            <input type="text" name="name" class="form-control border-start-0 bg-light border-success border-opacity-15 shadow-none py-2" placeholder="Nama Anda" required>
                        </div>
                        <label class="small fw-bold text-muted mb-2">EMAIL AKTIF</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-light border-end-0 border-success border-opacity-15"><i class="bi bi-envelope text-success"></i></span>
                            <input type="email" name="email" class="form-control border-start-0 bg-light border-success border-opacity-15 shadow-none py-2" placeholder="email@contoh.com" required>
                        </div>
                        <label class="small fw-bold text-muted mb-2">PASSWORD BARU</label>
                        <div class="input-group mb-4">
                            <span class="input-group-text bg-light border-end-0 border-success border-opacity-15"><i class="bi bi-shield-lock text-success"></i></span>
                            <input type="password" name="password" class="form-control border-start-0 bg-light border-success border-opacity-15 shadow-none py-2" placeholder="Buat password" required>
                        </div>
                        <button type="submit" class="btn-premium-solid w-100 py-3 justify-content-center">DAFTAR SEKARANG</button>
                    </form>
                    <div class="text-center mt-4 small">
                        Sudah memiliki akun? <a href="javascript:void(0)" onclick="bootstrap.Modal.getInstance(document.getElementById('registerModal')).hide(); setTimeout(openLogin, 400);" class="text-success fw-bold text-decoration-none">Login disini</a>
                    </div>
                </div>
                <div class="col-md-6 d-none d-md-flex auth-right bg-success-subtle p-5 text-center flex-column justify-content-center align-items-center">
                    <img src="{{ asset('images/logo-icon.png') }}" alt="PanenHub" class="login-logo-right mb-4" style="height: 90px; width: auto;" onerror="this.src='https://images.unsplash.com/photo-1595974482597-4b8da8879bc5?q=80&w=120'">
                    <h5 class="fw-bold text-success mb-2">Sejahtera Petani, Makmur Pembeli</h5>
                    <p class="small text-muted px-4 mb-0">Mulai transaksi dengan harga wajar terbaik. Tanpa calo, langsung dari produsen lokal Indonesia.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 4. MITRA TANI REGISTRATION MODAL -->
<div class="modal fade" id="mitraModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered"> 
        <div class="modal-content modal-content-premium bg-transparent">
            <div class="mitra-glass-card">
                <button type="button" class="btn-close m-4 position-absolute top-0 end-0" data-bs-dismiss="modal" style="z-index: 10;"></button>

                <div class="glass-side-left">
                    <div class="mb-4">
                        <i class="bi bi-stars text-success" style="font-size: 3.5rem;"></i>
                    </div>
                    <h1 class="fw-black text-success">MITRA</h1>
                    <h1 class="fw-black text-success">TANI</h1>
                    <p class="mt-3 text-success fw-bold uppercase" style="letter-spacing:1px; font-size:0.8rem;">PANENHUB AGRI-DIGITAL</p>
                </div>

                <div class="glass-side-right">
                    <div class="glass-auth-nav">
                        <button id="tabGabung" class="glass-nav-item active" onclick="switchMitraTab('gabung')">GABUNG MITRA</button>
                        <button id="tabMasuk" class="glass-nav-item" onclick="switchMitraTab('masuk')">LOGIN MITRA</button>
                    </div>

                    <div id="formGabung">
                        <form action="/api/register-mitra" method="POST">
                            @csrf
                            <h5 class="fw-bold mb-4 text-dark"><i class="bi bi-patch-plus text-success me-2"></i> Pendaftaran Mitra Kelompok Tani</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" name="name" class="glass-input" placeholder="Nama Kelompok Tani / Petani" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" name="location" class="glass-input" placeholder="Lokasi Lahan (Kecamatan, Kota)" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="tel" name="phone" class="glass-input" placeholder="No. WhatsApp Aktif" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="glass-input" placeholder="Komoditas Utama (Beras/Bumbu/Sayur)" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="email" name="email" class="glass-input" placeholder="Email Registrasi" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="password" name="password" class="glass-input" placeholder="Buat Password Keamanan" required>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <a href="#" class="text-muted small text-decoration-none"><i class="bi bi-question-circle me-1"></i> Butuh panduan pendaftaran?</a>
                                <button type="submit" class="btn-premium-solid py-3 px-5">DAFTAR SEKARANG</button>
                            </div>
                        </form>
                    </div>

                    <div id="formMasuk" style="display: none;">
                        <form action="/api/login" method="POST">
                            @csrf
                            <h5 class="fw-bold mb-4 text-dark"><i class="bi bi-box-arrow-in-right text-success me-2"></i> Login Khusus Mitra Tani</h5>
                            <div class="mb-4">
                                <input type="email" name="email" class="glass-input" placeholder="Email Terdaftar Mitra" required>
                            </div>
                            <div class="mb-4">
                                <input type="password" name="password" class="glass-input" placeholder="Password Akun" required>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <a href="#" class="text-muted small text-decoration-none">Lupa kata sandi Mitra?</a>
                                <button type="submit" class="btn-premium-solid py-3 px-5">MASUK SEKARANG</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ===== KERANJANG BELANJA MODAL (SHOPEE STYLE REDESIGNED) ===== -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content modal-content-premium bg-light" style="max-height: 90vh;">
            <div class="modal-header modal-header-premium">
                <h5 class="modal-title fw-bold d-flex align-items-center">
                    <img src="{{ asset('images/logo-icon.png') }}" alt="Logo" style="height: 30px; width: auto; margin-right: 8px;" onerror="this.src='https://images.unsplash.com/photo-1595974482597-4b8da8879bc5?q=80&w=120'">
                    Keranjang Belanja Pangan
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <div class="modal-body modal-body-premium position-relative">
                <div id="cartContent">
                    <!-- Loaded dynamically via JavaScript -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FLOATING AGRI-WIDGET FOR MITRA -->
<div class="fab-mitra-refined" onclick="openMitraModal()">
    <div class="fab-mitra-badge">Baru</div>
    <i class="bi bi-shop fs-5"></i>
    <span>Daftarkan Hasil Panen</span>
</div>

<!-- REDESIGNED SECURE PAYMENT MODAL -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-premium">
            <div class="modal-header modal-header-premium border-0 pb-0">
                <h5 class="modal-title fw-bold"><i class="bi bi-wallet2 me-2"></i> Secure Checkout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body modal-body-premium p-4">
                <form action="/api/checkout" method="POST" id="checkoutForm" onsubmit="return submitCheckout()" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="cart" id="checkoutCartData">
                    
                    <div class="mb-4 p-3 bg-light rounded-3 border d-flex justify-content-between align-items-center">
                        <div>
                            <span class="form-label small fw-bold text-muted d-block">TOTAL PEMBAYARAN</span>
                            <h3 class="fw-bold text-success mb-0" id="paymentTotalDisplay">Rp 0</h3>
                        </div>
                        <i class="bi bi-shield-fill-check text-success fs-2"></i>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">METODE PEMBAYARAN SECURE</label>
                        <select name="payment_method" id="paymentMethodSelect" class="form-select bg-light border border-success border-opacity-15 py-2.5 rounded-3 shadow-none" required onchange="toggleBankInstructions(this.value)">
                            <option value="">-- Pilih Metode Transaksi --</option>
                            <option value="Transfer ke Rekening Mitra">Rekening Mitra (Transfer Bank)</option>
                            <option value="COD (Bayar di Tempat)">COD (Bayar Kurir Saat Sampai)</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <div id="bankInstructions" class="mb-3 p-3 bg-warning-subtle rounded-3 border border-warning" style="display:none"></div>
                        <input type="hidden" name="selected_bank" id="selectedBankInput" value="">
                    </div>

                    <div id="proofOfPaymentContainer" class="mb-3" style="display:none">
                        <label class="form-label small fw-bold text-muted">UNGGAH BUKTI TRANSFER TRANSAKSI</label>
                        <div class="border rounded-3 p-3 bg-light text-center cursor-pointer">
                            <i class="bi bi-cloud-arrow-up fs-2 text-success mb-2 d-block"></i>
                            <input type="file" name="proof_of_payment" id="proofOfPaymentInput" class="form-control form-control-sm" accept="image/*">
                            <div class="form-text small mt-1">Unggah tangkapan layar bukti transfer transaksi Anda.</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">ALAMAT LENGKAP PENGIRIMAN</label>
                        <textarea name="address" class="form-control bg-light border border-success border-opacity-15 rounded-3" rows="3" placeholder="Jl. Raya Pertanian No. 45, Kecamatan Pakis, Kabupaten Malang, Jawa Timur" required></textarea>
                        <div class="form-text x-small mt-1 text-muted" style="font-size: 0.72rem;">*Pastikan alamat Anda detil untuk memudahkan kurir tani lokal mengantar pesanan Anda.</div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted">CATATAN KHUSUS (OPSIONAL)</label>
                        <input type="text" name="notes" class="form-control bg-light border border-success border-opacity-15 rounded-3 py-2" placeholder="Contoh: Pagar warna hijau, dekat masjid..." >
                    </div>

                    <div class="alert alert-success bg-success-subtle border-0 small mb-4">
                        <i class="bi bi-shield-check me-1"></i> Sistem Rekening Bersama PanenHub: Pembayaran Anda disimpan aman. Dana baru diserahkan ke Petani setelah Anda mengonfirmasi kelayakan produk.
                    </div>

                    <button type="submit" class="btn btn-premium-solid w-100 py-3 justify-content-center rounded-pill"><i class="bi bi-check2-all fs-5 me-1"></i> Bayar & Konfirmasi Sekarang</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- PREMIUM FOOTER DESIGN -->
<footer>
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="footer-logo">
                    <img src="{{ asset('images/logo-icon.png') }}" alt="Logo" style="height: 38px; width: auto; filter: invert(1) brightness(2);" onerror="this.src='https://images.unsplash.com/photo-1595974482597-4b8da8879bc5?q=80&w=120'">
                    PanenHub
                </div>
                <p class="small mb-4 opacity-75">Platform agroteknologi digital terpercaya di Indonesia yang mendigitalisasi distribusi pangan langsung dari lahan produsen lokal guna menjamin kedaulatan pangan nasional.</p>
                <div class="d-flex gap-3 fs-5">
                    <a href="#" class="text-white opacity-75 hover-opacity-100"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-white opacity-75 hover-opacity-100"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white opacity-75 hover-opacity-100"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="text-white opacity-75 hover-opacity-100"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-6">
                <h5 class="fw-bold text-white mb-4">Menu Utama</h5>
                <a href="#marketplace" class="footer-link">Beras</a>
                <a href="#marketplace" class="footer-link">Sayur</a>
                <a href="#marketplace" class="footer-link">Buah</a>
                <a href="#marketplace" class="footer-link">Lainnya</a>
            </div>

            <div class="col-lg-2 col-md-6">
                <h5 class="fw-bold text-white mb-4">Mitra & Hubungan</h5>
                <a href="javascript:void(0)" onclick="openMitraModal()" class="footer-link">Daftar Mitra Tani</a>
                <a href="javascript:void(0)" onclick="openMitraModal()" class="footer-link">Login Portal Mitra</a>
                <a href="#" class="footer-link">Direct & Secure Payment</a>
                <a href="#" class="footer-link">Panduan Kurir</a>
            </div>

            <div class="col-lg-4 col-md-6">
                <h5 class="fw-bold text-white mb-4">Kontak Layanan</h5>
                <p class="small mb-2 opacity-75"><i class="bi bi-geo-alt me-2 text-warning"></i> Gedung Agro Digital Indonesia, lt. 5-7, DKI Jakarta</p>
                <p class="small mb-2 opacity-75"><i class="bi bi-telephone me-2 text-warning"></i> +62 (21) 450-8800</p>
                <p class="small mb-0 opacity-75"><i class="bi bi-envelope me-2 text-warning"></i> support@panenhub.com</p>
            </div>
        </div>
        
        <hr class="footer-hr">
        
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 small">
            <p class="mb-0">© 2026 PanenHub Agri-Digital Project. Hak Cipta Dilindungi Undang-Undang.</p>
            <div class="d-flex gap-3">
                <a href="#" class="text-decoration-none text-muted">Syarat & Ketentuan</a>
                <a href="#" class="text-decoration-none text-muted">Kebijakan Privasi</a>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const isAuthenticated = @auth true @else false @endauth;
    const mitraBanks = {!! isset($mitraBanks) ? json_encode($mitraBanks) : '{}' !!};
    let activeMarketTab = 'spot';

    // ===== SPOT MARKET PAGINATION =====
    const PRODUCTS_PER_PAGE = 6;
    let spotCurrentPage = 1;
    let allSpotCards = [];
    let filteredSpotCards = [];

    function initSpotPagination() {
        allSpotCards = Array.from(document.querySelectorAll('#spotProductsRow .product-card-col'));
        filteredSpotCards = [...allSpotCards];
        spotCurrentPage = 1;
        renderSpotPage();
    }

    function renderSpotPage() {
        const total = filteredSpotCards.length;
        const totalPages = Math.max(1, Math.ceil(total / PRODUCTS_PER_PAGE));
        if (spotCurrentPage > totalPages) spotCurrentPage = totalPages;

        const start = (spotCurrentPage - 1) * PRODUCTS_PER_PAGE;
        const end = start + PRODUCTS_PER_PAGE;

        // Hide all, then show only current page
        allSpotCards.forEach(card => card.style.display = 'none');
        filteredSpotCards.forEach((card, idx) => {
            if (idx >= start && idx < end) {
                card.style.display = '';
            }
        });

        // Update pagination UI
        const prevBtn = document.getElementById('spotPrevBtn');
        const nextBtn = document.getElementById('spotNextBtn');
        const pageInfo = document.getElementById('spotPageInfo');

        prevBtn.disabled = spotCurrentPage <= 1;
        nextBtn.disabled = spotCurrentPage >= totalPages;

        // Style disabled buttons
        prevBtn.style.opacity = prevBtn.disabled ? '0.4' : '1';
        prevBtn.style.cursor = prevBtn.disabled ? 'not-allowed' : 'pointer';
        nextBtn.style.opacity = nextBtn.disabled ? '0.4' : '1';
        nextBtn.style.cursor = nextBtn.disabled ? 'not-allowed' : 'pointer';

        if (total === 0) {
            pageInfo.textContent = 'Tidak ada produk';
            document.getElementById('spotPaginationControls').style.display = 'none';
        } else {
            pageInfo.textContent = `Halaman ${spotCurrentPage} / ${totalPages}`;
            document.getElementById('spotPaginationControls').style.display = totalPages > 1 ? 'flex' : (total > 0 ? 'flex' : 'none');
        }
    }

    function changeSpotPage(direction) {
        const totalPages = Math.max(1, Math.ceil(filteredSpotCards.length / PRODUCTS_PER_PAGE));
        spotCurrentPage = Math.max(1, Math.min(totalPages, spotCurrentPage + direction));
        renderSpotPage();
        // Scroll to marketplace section smoothly
        document.getElementById('marketplace').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    // ===== PRE-HARVEST PAGINATION =====
    let preHarvestCurrentPage = 1;
    let allPreHarvestCards = [];
    let filteredPreHarvestCards = [];

    function initPreHarvestPagination() {
        allPreHarvestCards = Array.from(document.querySelectorAll('#preHarvestProductsRow .product-card-col'));
        filteredPreHarvestCards = [...allPreHarvestCards];
        preHarvestCurrentPage = 1;
        renderPreHarvestPage();
    }

    function renderPreHarvestPage() {
        const total = filteredPreHarvestCards.length;
        const totalPages = Math.max(1, Math.ceil(total / PRODUCTS_PER_PAGE));
        if (preHarvestCurrentPage > totalPages) preHarvestCurrentPage = totalPages;

        const start = (preHarvestCurrentPage - 1) * PRODUCTS_PER_PAGE;
        const end = start + PRODUCTS_PER_PAGE;

        // Hide all, then show only current page
        allPreHarvestCards.forEach(card => card.style.display = 'none');
        filteredPreHarvestCards.forEach((card, idx) => {
            if (idx >= start && idx < end) {
                card.style.display = '';
            }
        });

        // Update pagination UI
        const prevBtn = document.getElementById('preHarvestPrevBtn');
        const nextBtn = document.getElementById('preHarvestNextBtn');
        const pageInfo = document.getElementById('preHarvestPageInfo');

        prevBtn.disabled = preHarvestCurrentPage <= 1;
        nextBtn.disabled = preHarvestCurrentPage >= totalPages;

        // Style disabled buttons
        prevBtn.style.opacity = prevBtn.disabled ? '0.4' : '1';
        prevBtn.style.cursor = prevBtn.disabled ? 'not-allowed' : 'pointer';
        nextBtn.style.opacity = nextBtn.disabled ? '0.4' : '1';
        nextBtn.style.cursor = nextBtn.disabled ? 'not-allowed' : 'pointer';

        if (total === 0) {
            pageInfo.textContent = 'Tidak ada produk';
            document.getElementById('preHarvestPaginationControls').style.display = 'none';
        } else {
            pageInfo.textContent = `Halaman ${preHarvestCurrentPage} / ${totalPages}`;
            document.getElementById('preHarvestPaginationControls').style.display = totalPages > 1 ? 'flex' : (total > 0 ? 'flex' : 'none');
        }
    }

    function changePreHarvestPage(direction) {
        const totalPages = Math.max(1, Math.ceil(filteredPreHarvestCards.length / PRODUCTS_PER_PAGE));
        preHarvestCurrentPage = Math.max(1, Math.min(totalPages, preHarvestCurrentPage + direction));
        renderPreHarvestPage();
        document.getElementById('marketplace').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    document.addEventListener('DOMContentLoaded', function() {
        initSpotPagination();
        initPreHarvestPagination();
    });

    // Toggle Scroll Header class
    window.addEventListener('scroll', function() {
        const nav = document.querySelector('.navbar');
        if (window.scrollY > 40) {
            nav.classList.add('scrolled');
        } else {
            nav.classList.remove('scrolled');
        }
    });


    // Modals systems redefined to use dedicated custom pages
    function openLogin() { 
        new bootstrap.Modal(document.getElementById('loginModal')).show();
    }
    function openRegister() { 
        new bootstrap.Modal(document.getElementById('registerModal')).show();
    }
    function openMitraModal() { 
        @auth
            @if(Auth::user()->role === 'mitra')
                window.location.href = '{{ route('mitra.dashboard') }}';
            @else
                alert('Anda saat ini masuk sebagai akun Pembeli. Untuk mendaftar sebagai Mitra Tani, silakan keluar/logout terlebih dahulu dan mendaftar dengan akun baru sebagai Mitra Tani.');
            @endif
        @else
            window.location.href = '/register';
        @endauth
    }

    function openCart() { 
        renderCart(); 
        new bootstrap.Modal(document.getElementById('cartModal')).show(); 
    }
    function socialLogin(platform) { 
        window.location.href = "/auth/" + platform.toLowerCase() + "/redirect";
    }

    // Toggle Spot/Pre-Harvest tabs
    function switchMarketTab(tab) {
        activeMarketTab = tab;
        const btnSpot = document.getElementById('tabSpotMarket');
        const btnPre = document.getElementById('tabPreHarvest');
        const spotGrid = document.getElementById('spotMarketGrid');
        const preGrid = document.getElementById('preHarvestGrid');

        if (tab === 'spot') {
            btnSpot.classList.add('active');
            btnPre.classList.remove('active');
            spotGrid.style.display = 'block';
            preGrid.style.display = 'none';
        } else {
            btnSpot.classList.remove('active');
            btnPre.classList.add('active');
            spotGrid.style.display = 'none';
            preGrid.style.display = 'block';
        }
        runGridFilters();
    }

    // Interactive Commodity Analytics Modal Chart Builder
    function openChartModal(name, price, trend, direction, dataPoints) {
        document.getElementById('chartModalTitle').innerHTML = `<i class="bi bi-graph-up-arrow me-2 text-warning"></i> Analisis Pergerakan ${name}`;
        document.getElementById('chartModalPrice').textContent = `Rp ${price.toLocaleString('id-ID')}/kg`;
        
        const trendBadge = document.getElementById('chartModalTrend');
        trendBadge.textContent = trend;
        if (direction === 'naik') {
            trendBadge.className = "badge bg-success-subtle text-success py-2 px-3 rounded-pill fw-bold";
        } else if (direction === 'stabil') {
            trendBadge.className = "badge bg-info-subtle text-info py-2 px-3 rounded-pill fw-bold";
        } else {
            trendBadge.className = "badge bg-danger-subtle text-danger py-2 px-3 rounded-pill fw-bold";
        }

        // Dynamically style the bottom Alert Box
        const alertBox = document.getElementById('chartModalAlertBox');
        const alertIcon = document.getElementById('chartModalAlertIcon');
        const alertText = document.getElementById('chartModalAlertText');
        if (alertBox && alertIcon && alertText) {
            if (direction === 'naik') {
                alertBox.className = "alert alert-success bg-success-subtle border-0 small mb-0 d-flex gap-2 text-success-emphasis";
                alertIcon.className = "bi bi-info-circle-fill fs-5 mt-1 text-success";
                alertText.textContent = "Indeks harga diperoleh secara objektif dari data rujukan pergerakan pasar induk nasional dan volume transaksi mitra tani secara real-time.";
            } else if (direction === 'stabil') {
                alertBox.className = "alert alert-info bg-info-subtle border-0 small mb-0 d-flex gap-2 text-info-emphasis";
                alertIcon.className = "bi bi-info-circle-fill fs-5 mt-1 text-info";
                alertText.textContent = "Indeks harga stabil dengan pasokan yang mencukupi untuk memenuhi tingkat permintaan pasar nasional saat ini.";
            } else {
                alertBox.className = "alert alert-danger bg-danger-subtle border-0 small mb-0 d-flex gap-2 text-danger-emphasis";
                alertIcon.className = "bi bi-info-circle-fill fs-5 mt-1 text-danger";
                alertText.textContent = "Terjadi tren penurunan permintaan pasar secara berkala seiring melimpahnya pasokan musiman komoditas ini.";
            }
        }

        // Render dynamic high-fidelity CSS bars representing the chart
        const container = document.getElementById('chartBarsContainer');
        container.innerHTML = '';
        
        const maxVal = Math.max(...dataPoints);
        const minVal = Math.min(...dataPoints);
        
        dataPoints.forEach((val) => {
            const pct = ((val - minVal * 0.95) / (maxVal - minVal * 0.95)) * 80 + 20; // scale nicely
            const bar = document.createElement('div');
            bar.className = 'chart-mock-bar';
            bar.style.height = `${pct}%`;
            bar.setAttribute('data-val', `Rp ${val.toLocaleString('id-ID')}`);
            if (direction === 'turun') {
                bar.style.background = '#ffcdd2';
                bar.addEventListener('mouseover', function() { bar.style.background = '#d32f2f'; });
                bar.addEventListener('mouseout', function() { bar.style.background = '#ffcdd2'; });
            } else if (direction === 'stabil') {
                bar.style.background = '#b3e5fc';
                bar.addEventListener('mouseover', function() { bar.style.background = '#0288d1'; });
                bar.addEventListener('mouseout', function() { bar.style.background = '#b3e5fc'; });
            } else {
                bar.style.background = '#c8e6c9';
                bar.addEventListener('mouseover', function() { bar.style.background = '#2e7d32'; });
                bar.addEventListener('mouseout', function() { bar.style.background = '#c8e6c9'; });
            }
            container.appendChild(bar);
        });

        new bootstrap.Modal(document.getElementById('chartAnalyticsModal')).show();
    }

    // Integrated Search and Grid Filters
    function runGridFilters() {
        const query = document.getElementById('marketSearch').value.toLowerCase();
        const cat = document.getElementById('filterCategory').value.toLowerCase();
        const loc = document.getElementById('filterLocation').value.toLowerCase();
        
        if (activeMarketTab === 'spot') {
            // For spot market: filter and update pagination
            filteredSpotCards = allSpotCards.filter(card => {
                const nameAttr = card.getAttribute('data-name') || '';
                const catAttr = card.getAttribute('data-cat') || '';
                const locAttr = card.getAttribute('data-loc') || '';
                const mitAttr = card.getAttribute('data-mitra') || '';

                const matchesQuery = query === '' || nameAttr.includes(query) || mitAttr.includes(query) || locAttr.includes(query);
                const matchesCat = cat === '' || catAttr.includes(cat);
                const matchesLoc = loc === '' || locAttr.includes(loc);

                return matchesQuery && matchesCat && matchesLoc;
            });
            spotCurrentPage = 1;
            renderSpotPage();
        } else {
            // For pre-harvest: filter and update pagination
            filteredPreHarvestCards = allPreHarvestCards.filter(card => {
                const nameAttr = card.getAttribute('data-name') || '';
                const catAttr = card.getAttribute('data-cat') || '';
                const locAttr = card.getAttribute('data-loc') || '';
                const mitAttr = card.getAttribute('data-mitra') || '';

                const matchesQuery = query === '' || nameAttr.includes(query) || mitAttr.includes(query) || locAttr.includes(query);
                const matchesCat = cat === '' || catAttr.includes(cat);
                const matchesLoc = loc === '' || locAttr.includes(loc);

                return matchesQuery && matchesCat && matchesLoc;
            });
            preHarvestCurrentPage = 1;
            renderPreHarvestPage();
        }
    }

    function resetGridFilters() {
        document.getElementById('marketSearch').value = "";
        document.getElementById('filterCategory').value = "";
        document.getElementById('filterLocation').value = "";
        
        // sync to mobile search input too
        const inputM = document.getElementById('searchInputMobile');
        if (inputM) inputM.value = "";
        const inputD = document.getElementById('searchInput');
        if (inputD) inputD.value = "";

        runGridFilters();
    }

    // Sync header standard searches to the marketplace grid search
    function filterProducts() {
        const dQuery = document.getElementById('searchInput')?.value || "";
        const mQuery = document.getElementById('searchInputMobile')?.value || "";
        const finalQuery = dQuery || mQuery;
        
        const marketSearchInput = document.getElementById('marketSearch');
        if (marketSearchInput) {
            marketSearchInput.value = finalQuery;
            
            // Auto smooth scroll to marketplace section when searching from header
            document.getElementById('marketplace').scrollIntoView({ behavior: 'smooth' });
            
            runGridFilters();
        }
    }

    // Pre-Harvest Dynamic DP Lock Bidding Calculator
    let activeBidPrice = 0;
    let activeBidMaxQty = 0;
    let activeBidName = '';
    let activeBidFarmer = '';
    let activeBidMitraId = null;

    function openBidModal(name, price, farmer, maxQty, est, mitraId = null) {
        if (!isAuthenticated) {
            openLogin();
            return;
        }
        activeBidPrice = price;
        activeBidMaxQty = maxQty;
        activeBidName = name;
        activeBidFarmer = farmer;
        activeBidMitraId = mitraId;

        document.getElementById('bidModalItemName').textContent = name;
        document.getElementById('bidModalFarmer').textContent = farmer;
        document.getElementById('bidModalEst').textContent = est;
        document.getElementById('bidModalPriceDisplay').textContent = `Rp ${price.toLocaleString('id-ID')}/kg`;
        
        document.getElementById('bidMaxTonnageDisplay').textContent = `${maxQty.toLocaleString('id-ID')} kg`;
        
        const qtySlider = document.getElementById('bidQtyInput');
        qtySlider.max = maxQty;
        qtySlider.value = Math.min(1000, maxQty);
        
        document.getElementById('bidQtyDisplay').textContent = `${qtySlider.value.toLocaleString('id-ID')} kg`;

        updateBidCalculator();
        new bootstrap.Modal(document.getElementById('bidNegotiationModal')).show();
    }

    function updateBidCalculator() {
        const qty = parseInt(document.getElementById('bidQtyInput').value) || 0;
        document.getElementById('bidQtyDisplay').textContent = `${qty.toLocaleString('id-ID')} kg`;

        const total = qty * activeBidPrice;
        const dp = total * 0.20; // 20% down payment

        document.getElementById('bidCalcTotal').textContent = `Rp ${total.toLocaleString('id-ID')}`;
        document.getElementById('bidCalcDP').textContent = `Rp ${dp.toLocaleString('id-ID')}`;
    }

    function submitBidLock() {
        const qty = parseInt(document.getElementById('bidQtyInput').value);
        const notes = document.getElementById('bidNotesInput').value;
        const total = qty * activeBidPrice;
        const dp = Math.round(total * 0.20);

        // Disable button to prevent double submit
        const submitBtn = document.getElementById('bidSubmitBtn');
        if (submitBtn) { submitBtn.disabled = true; submitBtn.textContent = 'Mengirim...'; }

        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';

        // POST to server
        fetch('/api/penawaran/submit', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                product_name: activeBidName,
                farmer_name: activeBidFarmer,
                offer_qty: qty,
                offer_price: activeBidPrice,
                notes: notes,
                mitra_id: activeBidMitraId
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                bootstrap.Modal.getInstance(document.getElementById('bidNegotiationModal'))?.hide();
                triggerConfettiBurst();

                // Success toast with chat link
                setTimeout(function() {
                    var toast = document.createElement('div');
                    toast.innerHTML =
                        '<div class="mb-3"><i class="bi bi-shield-fill-check text-warning" style="font-size:4rem;display:block;"></i></div>' +
                        '<div class="fw-bold fs-4 mb-2">Penawaran Dikunci! 🎉</div>' +
                        '<div class="small opacity-90 mb-3">Penawaran <strong>' + qty.toLocaleString('id-ID') + ' kg</strong> berhasil dikirim ke petani.</div>' +
                        '<div class="mb-3" style="font-size:0.8rem;opacity:0.85;">DP (20%): <strong>Rp ' + dp.toLocaleString('id-ID') + '</strong></div>' +
                        '<a href="' + data.redirect_url + '" style="display:inline-block;background:white;color:#1b5e20;font-weight:800;padding:10px 24px;border-radius:50px;font-size:0.85rem;text-decoration:none;margin-top:4px;">💬 Buka Chat dengan Petani →</a>';
                    toast.style.cssText = 'position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);background:rgba(27,94,32,0.96);backdrop-filter:blur(15px);color:#fff;padding:45px 50px;border-radius:24px;z-index:9999;box-shadow:0 30px 60px rgba(0,0,0,0.4);animation:zoomIn .4s cubic-bezier(0.175,0.885,0.32,1.275) forwards;text-align:center;min-width:340px;border:1px solid rgba(255,255,255,0.15);';
                    document.body.appendChild(toast);

                    // Auto redirect after 5s
                    setTimeout(function() {
                        window.location.href = data.redirect_url;
                    }, 5000);
                }, 300);
            } else {
                if (submitBtn) { submitBtn.disabled = false; submitBtn.textContent = 'Kunci Penawaran'; }
                alert('Gagal mengirim penawaran. Silakan coba lagi.');
            }
        })
        .catch(err => {
            console.error(err);
            if (submitBtn) { submitBtn.disabled = false; submitBtn.textContent = 'Kunci Penawaran'; }
            alert('Terjadi kesalahan. Pastikan Anda sudah login.');
        });
    }

    // Custom Interactive Confetti Burst
    function triggerConfettiBurst() {
        const container = document.getElementById('confettiContainer');
        container.innerHTML = '';
        container.style.display = 'block';
        
        const colors = ['#ffd700', '#ffd54f', '#81c784', '#a5d6a7', '#2e7d32', '#ff8a80', '#80d8ff'];
        
        for (let i = 0; i < 100; i++) {
            const particle = document.createElement('div');
            particle.className = 'confetti-particle';
            particle.style.background = colors[Math.floor(Math.random() * colors.length)];
            particle.style.left = `${Math.random() * 100}vw`;
            particle.style.transform = `scale(${Math.random() * 0.8 + 0.4})`;
            
            // Random horizontal movement
            particle.style.animationName = 'fall';
            particle.style.animationDuration = `${Math.random() * 2 + 1.5}s`;
            particle.style.animationDelay = `${Math.random() * 0.3}s`;
            
            container.appendChild(particle);
        }
        
        setTimeout(() => {
            container.style.display = 'none';
        }, 3500);
    }

    // Switch Mitra Tab inside modal
    function switchMitraTab(tab) {
        const formGabung = document.getElementById('formGabung');
        const formMasuk = document.getElementById('formMasuk');
        const tabGabung = document.getElementById('tabGabung');
        const tabMasuk = document.getElementById('tabMasuk');
        
        if (tab === 'gabung') {
            formGabung.style.display = 'block'; formMasuk.style.display = 'none';
            tabGabung.classList.add('active'); tabMasuk.classList.remove('active');
        } else {
            formGabung.style.display = 'none'; formMasuk.style.display = 'block';
            tabGabung.classList.remove('active'); tabMasuk.classList.add('active');
        }
    }

    // Dynamic Newsletter handler with particles
    function handleNewsletter(e) {
        e.preventDefault();
        const email = document.getElementById('newsletterEmail').value;
        
        triggerConfettiBurst();

        // Show floating custom toast
        var toast = document.createElement('div');
        toast.innerHTML = '<div class="mb-2"><i class="bi bi-stars text-warning" style="font-size: 3rem; display: block;"></i></div>' + 
                         '<div class="fw-bold fs-4 mb-2">Sukses Berlangganan!</div>' +
                         '<div class="small opacity-80">Email Anda: ' + email + ' telah terdaftar di ekosistem PanenHub. Dapatkan info komoditas & rilis harga setiap harinya.</div>';
        toast.style.cssText = 'position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);background:rgba(27, 94, 32, 0.96);backdrop-filter:blur(12px);color:#fff;padding:35px 45px;border-radius:24px;z-index:9999;box-shadow:0 25px 50px rgba(0,0,0,0.3);animation:zoomIn .4s forwards;text-align:center;max-width:350px;border:1px solid rgba(255,255,255,0.1);';
        document.body.appendChild(toast);
        
        document.getElementById('newsletterEmail').value = '';

        setTimeout(function() { 
            toast.style.animation = 'fadeOut .3s ease forwards';
            setTimeout(function() { toast.remove(); }, 300);
        }, 5000);
    }

    // LOCAL STORAGE CART OPERATIONS
    function getCart() {
        var raw = JSON.parse(localStorage.getItem('panenhub_cart') || '[]');
        var needsSave = false;
        var clean = raw.filter(function(item) {
            return item && item.id && item.name && item.price && item.image && item.mitra;
        }).map(function(item) {
            if (typeof item.selected === 'undefined') {
                item.selected = true;
                needsSave = true;
            }
            return item;
        });
        if (clean.length !== raw.length || needsSave) {
            localStorage.setItem('panenhub_cart', JSON.stringify(clean));
        }
        return clean;
    }

    function saveCart(cart) {
        localStorage.setItem('panenhub_cart', JSON.stringify(cart));
        updateCartBadge();
    }

    function addToCart(id, name, price, image, mitra) {
        if (!isAuthenticated) {
            openLogin();
            return;
        }
        var cart = getCart();
        var idx = -1;
        for (var i = 0; i < cart.length; i++) {
            if (cart[i].id === id) { idx = i; break; }
        }
        if (idx >= 0) {
            cart[idx].qty += 1;
        } else {
            cart.push({ id: id, name: name, price: price, image: image, mitra: mitra, qty: 1 });
        }
        saveCart(cart);

        // Micro zoom notification modal feedback
        var toast = document.createElement('div');
        toast.innerHTML = '<div class="mb-3"><i class="bi bi-cart-check-fill" style="font-size: 3.5rem; display: block; color: #ffb300;"></i></div>' + 
                         '<div class="fw-bold fs-4 mb-2">Berhasil!</div>' +
                         '<div class="small opacity-75">' + name + ' dimasukkan dalam keranjang belanja.</div>';
        toast.style.cssText = 'position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);background:rgba(27, 94, 32, 0.95);backdrop-filter:blur(10px);color:#fff;padding:35px 50px;border-radius:24px;z-index:9999;box-shadow:0 20px 45px rgba(0,0,0,0.3);animation:zoomIn .4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;text-align:center;min-width:300px;border:1px solid rgba(255,255,255,0.1);';
        document.body.appendChild(toast);
        
        setTimeout(function() { 
            toast.style.animation = 'fadeOut .3s ease forwards';
            setTimeout(function() { toast.remove(); }, 300);
        }, 1800);
    }

    function removeFromCart(id) {
        var cart = getCart();
        var newCart = [];
        for (var i = 0; i < cart.length; i++) {
            if (cart[i].id !== id) newCart.push(cart[i]);
        }
        saveCart(newCart);
        renderCart();
    }

    function changeQty(id, delta) {
        var cart = getCart();
        for (var i = 0; i < cart.length; i++) {
            if (cart[i].id === id) {
                cart[i].qty += delta;
                if (cart[i].qty < 1) cart[i].qty = 1;
                break;
            }
        }
        saveCart(cart);
        renderCart();
    }

    function formatRupiah(num) {
        return 'Rp ' + num.toLocaleString('id-ID');
    }

    function updateCartBadge() {
        var cart = getCart();
        var badge = document.getElementById('cartCount');
        if (!badge) return;
        var totalItems = 0;
        for (var i = 0; i < cart.length; i++) { totalItems += cart[i].qty; }
        if (totalItems > 0) {
            badge.textContent = totalItems;
            badge.style.display = 'inline-block';
        } else {
            badge.style.display = 'none';
        }
    }

    // Shopee grouped rendering styled for modern aesthetics
    function renderCart() {
        var cart = getCart();
        var container = document.getElementById('cartContent');
        if (!container) return;

        if (cart.length === 0) {
            container.innerHTML = '<div class="text-center py-5 text-muted">' +
                '<i class="bi bi-cart-x fs-1 d-block mb-3 text-success"></i>' +
                '<h5 class="fw-bold">Keranjang Belanja Kosong</h5>' +
                '<p class="small text-muted">Belum ada beras/komoditas yang ditambahkan, silakan berbelanja terlebih dahulu.</p>' +
                '</div>';
            return;
        }

        var grandTotal = 0;
        var totalQty = 0;
        var allSelected = true;
        
        var groupedCart = {};
        for (var i = 0; i < cart.length; i++) {
            var item = cart[i];
            if (!item.selected) allSelected = false;
            if (item.selected) {
                var lineTotal = item.price * item.qty;
                grandTotal += lineTotal;
                totalQty += item.qty;
            }
            if (!groupedCart[item.mitra]) groupedCart[item.mitra] = [];
            groupedCart[item.mitra].push(item);
        }

        var html = '<div class="d-none d-md-flex align-items-center bg-white border rounded-3 p-3 mb-3 text-muted small fw-bold text-center">' +
            '<div class="col-checkbox" style="width: 5%;"><input type="checkbox" ' + (allSelected ? 'checked' : '') + ' data-action="toggle-all" class="cursor-pointer"></div>' +
            '<div class="col-product" style="width: 42%; text-align:left; padding-left: 15px;">KOMODITAS HASIL BUMI</div>' +
            '<div class="col-price" style="width: 16%;">HARGA</div>' +
            '<div class="col-qty" style="width: 16%;">JUMLAH</div>' +
            '<div class="col-total" style="width: 16%;">TOTAL HARGA</div>' +
            '<div class="col-action" style="width: 5%;">AKSI</div>' +
        '</div>';

        for (var mitra in groupedCart) {
            var items = groupedCart[mitra];
            var storeSelected = items.every(function(i) { return i.selected; });

            html += '<div class="cart-group-card">';
            html += '<div class="cart-group-header">' +
                        '<input type="checkbox" ' + (storeSelected ? 'checked' : '') + ' data-action="toggle-store" data-mitra="' + mitra + '" class="me-3 cursor-pointer" style="accent-color:var(--primary);">' +
                        '<span class="badge bg-success-subtle text-success border border-success border-opacity-10 me-2"><i class="bi bi-patch-check"></i> Petani Terverifikasi</span>' +
                        '<span class="fw-bold text-dark">' + mitra + '</span>' +
                    '</div>';
            
            for (var j = 0; j < items.length; j++) {
                var item = items[j];
                var lineTotal = item.price * item.qty;
                
                html += '<div class="cart-item-row flex-column flex-md-row">' +
                    '<div class="d-flex align-items-center w-100 flex-grow-1">' +
                        '<div class="col-checkbox" style="width: 5%; text-align:center;"><input type="checkbox" ' + (item.selected ? 'checked' : '') + ' data-action="toggle-item" data-id="' + item.id + '" class="cursor-pointer" style="accent-color:var(--primary);"></div>' +
                        '<div class="col-product d-flex align-items-center ms-3" style="width: 80%;">' +
                            '<img src="' + item.image + '" alt="' + item.name + '" class="cart-img">' +
                            '<div class="ms-3">' +
                                '<div class="fw-bold text-dark" style="font-size:0.95rem;">' + item.name + '</div>' +
                                '<div class="small text-muted" style="font-size:0.75rem;">Garansi Kesegaran PanenHub 100%</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                    
                    '<div class="d-flex w-100 justify-content-between align-items-center mt-3 mt-md-0" style="max-width: 50%; width: 100%;">' +
                        '<div class="col-price text-muted text-center" style="width: 33%;">' + formatRupiah(item.price) + '</div>' +
                        '<div class="col-qty text-center" style="width: 33%;">' +
                            '<div class="btn-group border rounded" style="overflow:hidden; background:white;">' +
                                '<button type="button" class="btn btn-sm btn-light border-0 px-2.5" data-action="minus" data-id="' + item.id + '">&minus;</button>' +
                                '<span class="px-3 py-1 bg-white small fw-bold">' + item.qty + '</span>' +
                                '<button type="button" class="btn btn-sm btn-light border-0 px-2.5" data-action="plus" data-id="' + item.id + '">+</button>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-total text-success fw-bold text-center" style="width: 33%;">' + formatRupiah(lineTotal) + '</div>' +
                        '<div class="col-action text-end" style="width: 10%;">' +
                            '<button type="button" class="btn btn-link text-danger p-0" data-action="delete" data-id="' + item.id + '"><i class="bi bi-trash3 fs-5"></i></button>' +
                        '</div>' +
                    '</div>' +
                '</div>';
            }
            html += '</div>';
        }

        // Platforms vouchers mock
        html += '<div class="bg-white border rounded-3 p-3 mb-3 d-flex justify-content-between align-items-center small">' +
            '<div class="fw-bold text-dark d-flex align-items-center gap-2"><i class="bi bi-ticket-fill text-success fs-5"></i> Voucher Platform PanenHub</div>' +
            '<div class="text-success fw-bold cursor-pointer"><i class="bi bi-plus-circle"></i> Gunakan/Masukkan Kode</div>' +
        '</div>';

        // Shipping card gratis ongkir
        html += '<div class="bg-white border rounded-3 p-3 mb-4 d-flex align-items-center gap-3">' +
            '<i class="bi bi-truck text-success fs-4"></i>' +
            '<div class="small text-dark">Gratis Ongkir Instan s/d Rp60.000 berlaku dengan minimal belanja spot hasil tani Rp150.000.</div>' +
        '</div>';

        // Sticky cart footer checkout
        html += '<div class="bg-white border rounded-4 p-4 d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 shadow-sm sticky-bottom" style="z-index: 100;">' +
            '<div class="d-flex align-items-center gap-2">' +
                '<input type="checkbox" ' + (allSelected ? 'checked' : '') + ' data-action="toggle-all" class="cursor-pointer" style="width: 18px; height: 18px; accent-color: var(--primary);">' +
                '<span class="text-dark fw-bold small">Pilih Semua (' + totalQty + ' produk)</span>' +
            '</div>' +
            '<div class="d-flex align-items-center gap-4">' +
                '<div class="text-end">' +
                    '<span class="text-muted small">Total Pembayaran:</span>' +
                    '<h3 class="fw-bold text-success mb-0">' + formatRupiah(grandTotal) + '</h3>' +
                '</div>' +
                '<button class="btn btn-premium-accent py-3 px-5 fw-bold shadow-sm" id="btnCheckout" style="font-size:1.05rem;">Lanjutkan ke Checkout</button>' +
            '</div>' +
        '</div>';

        container.innerHTML = html;
    }

    function submitCheckout() {
        var cart = getCart().filter(function(i) { return i.selected; });
        if (cart.length === 0) {
            alert("Harap pilih minimal 1 produk untuk melakukan checkout!");
            return false;
        }
        document.getElementById('checkoutCartData').value = JSON.stringify(cart);
        return true;
    }

    // Toggle Bank Account detail based on checkout selections
    function toggleBankInstructions(val) {
        var box = document.getElementById('bankInstructions');
        var hiddenInput = document.getElementById('selectedBankInput');
        var proofContainer = document.getElementById('proofOfPaymentContainer');
        var proofInput = document.getElementById('proofOfPaymentInput');
        
        hiddenInput.value = '';
        box.innerHTML = '';
        box.style.display = 'none';
        proofContainer.style.display = 'none';
        proofInput.required = false;

        if (val === 'Transfer ke Rekening Mitra') {
            proofContainer.style.display = 'block';
            proofInput.required = true;
            box.style.display = 'block';
            
            var selectedCart = getCart().filter(function(i) { return i.selected; });
            var mitraNames = new Set();
            selectedCart.forEach(function(item) { mitraNames.add(item.mitra); });
            var html = '';
            
            mitraNames.forEach(function(m) {
                if (mitraBanks[m] && mitraBanks[m].length > 0) {
                    html += '<h6 class="fw-bold mt-2 text-dark border-bottom pb-2"><i class="bi bi-wallet2 text-success"></i> Transfer Bank Mitra: ' + m + '</h6>';
                    mitraBanks[m].forEach(function(b) {
                        var radioId = 'bank_' + b.id;
                        html += '<div class="form-check mb-3">';
                        html += '<input class="form-check-input mt-2" type="radio" name="bank_option" id="' + radioId + '" value="' + b.id + '" onchange="document.getElementById(\'selectedBankInput\').value = this.value;">';
                        html += '<label class="form-check-label w-100 cursor-pointer" for="' + radioId + '">';
                        html += '<div class="bank-detail bg-white p-3 rounded-3 border">';
                        html += '<p class="mb-1 small fw-bold text-success">' + b.bank_name + '</p>';
                        html += '<h4 class="fw-bold mb-1 text-dark" style="letter-spacing:0.5px;">' + b.account_number + '</h4>';
                        html += '<div class="small text-muted">Atas nama: <strong>' + b.account_name + '</strong></div>';
                        html += '</div>';
                        html += '</label></div>';
                    });
                } else {
                    html += '<div class="small text-danger mb-2 p-2 bg-white rounded border"><i class="bi bi-exclamation-triangle"></i> Mitra <strong>' + m + '</strong> belum menyetel rekening bank. Silakan pilih opsi Cash on Delivery (COD) atau hubungi dukungan.</div>';
                }
            });
            box.innerHTML = html;
        }
    }

    // Checkbox and item quantity event handlers inside Cart Modal
    document.addEventListener('change', function(e) {
        var target = e.target.closest('input[type="checkbox"]');
        if (!target) return;
        var action = target.getAttribute('data-action');
        var cart = getCart();

        if (action === 'toggle-item') {
            var id = target.getAttribute('data-id');
            for (var i = 0; i < cart.length; i++) {
                if (cart[i].id === id) cart[i].selected = target.checked;
            }
            saveCart(cart);
            renderCart();
        } else if (action === 'toggle-store') {
            var mitra = target.getAttribute('data-mitra');
            for (var i = 0; i < cart.length; i++) {
                if (cart[i].mitra === mitra) cart[i].selected = target.checked;
            }
            saveCart(cart);
            renderCart();
        } else if (action === 'toggle-all') {
            for (var i = 0; i < cart.length; i++) {
                cart[i].selected = target.checked;
            }
            saveCart(cart);
            renderCart();
        }
    });

    document.addEventListener('click', function(e) {
        var target = e.target.closest('[data-action]');
        if (!target || target.tagName === 'INPUT') return; 
        var action = target.getAttribute('data-action');
        var id = target.getAttribute('data-id');
        if (action === 'delete') {
            removeFromCart(id);
        } else if (action === 'minus') {
            changeQty(id, -1);
        } else if (action === 'plus') {
            changeQty(id, 1);
        }
    });

    // Handle opening Checkout Secure payment modal
    document.addEventListener('click', function(e) {
        if (e.target && e.target.id === 'btnCheckout') {
            if (!isAuthenticated) {
                openLogin();
                return;
            }
            var selectedCart = getCart().filter(function(i) { return i.selected; });
            if (selectedCart.length === 0) {
                alert("Pilih minimal 1 komoditas terlebih dahulu untuk checkout!");
                return;
            }
            
            var grandTotal = 0;
            var mitraNames = new Set();
            for (var i = 0; i < selectedCart.length; i++) {
                grandTotal += selectedCart[i].price * selectedCart[i].qty;
                mitraNames.add(selectedCart[i].mitra);
            }
            document.getElementById('paymentTotalDisplay').textContent = formatRupiah(grandTotal);

            // Set select values and pre-instructions
            const pmSelect = document.getElementById('paymentMethodSelect');
            pmSelect.value = '';
            toggleBankInstructions('');

            // Hide Cart modal
            var cartModalEl = document.getElementById('cartModal');
            if (cartModalEl) {
                bootstrap.Modal.getInstance(cartModalEl)?.hide();
            }
            
            // Show secure payment modal
            setTimeout(function() {
                var pmEl = document.getElementById('paymentModal');
                if (pmEl) new bootstrap.Modal(pmEl).show();
            }, 450);
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        getCart();
        updateCartBadge();
        
        @if(session('success') && str_contains(session('success'), 'Checkout berhasil'))
            localStorage.removeItem('panenhub_cart');
            updateCartBadge();
            triggerConfettiBurst();
        @endif
    });
</script>

@if($errors->any())
<script>
    alert("{{ $errors->first() }}");
</script>
@endif
@if(session('success'))
<script>
    alert("{{ session('success') }}");
</script>
@endif

</body>
</html>