<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul']; ?> - D'Kriuk Fried Chicken</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Yellowtail&display=swap"
        rel="stylesheet">
    <!-- Leaflet Maps -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <style>
        :root {
            --primary-red: #A30D11;
            --dark-red: #8B0A0D;
            --accent-orange: #F2994A;
            --bg-light: #FDFDFD;
            --text-dark: #2D3436;
            --text-muted: #636E72;
        }

        html,
        body {
            max-width: 100%;
            overflow-x: hidden !important;
            position: relative;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FDF8F4;
            color: var(--text-dark);
            width: 100%;
        }

        /* Navbar Styles */
        .navbar {
            position: fixed !important;
            top: 0;
            left: 0;
            right: 0;
            background-color: var(--primary-red) !important;
            padding: 15px 0;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            z-index: 1050;
            border-bottom-left-radius: 30px;
            border-bottom-right-radius: 30px;
        }

        .navbar-brand img {
            height: 45px;
        }

        .nav-link {
            color: white !important;
            font-weight: 600;
            margin: 0 15px;
            font-size: 15px;
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: white;
            transition: width 0.3s;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .btn-checkout {
            background-color: white;
            color: var(--primary-red) !important;
            border-radius: 12px;
            padding: 8px 24px;
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
        }

        .btn-checkout:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        /* Mobile Layout Adjustments */
        .mobile-top-header {
            display: none;
            background-color: var(--primary-red);
            padding: 15px 25px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1060;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-bottom-left-radius: 25px;
            border-bottom-right-radius: 25px;
        }

        .bottom-nav {
            display: none;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            box-shadow: 0 -5px 25px rgba(0, 0, 0, 0.1);
            z-index: 1060;
            padding: 12px 0;
            border-top-left-radius: 30px;
            border-top-right-radius: 30px;
            justify-content: space-around;
            align-items: center;
        }

        .bottom-nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none !important;
            color: #A0A0A0 !important;
            font-size: 0.7rem;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            width: 25%;
            position: relative;
        }

        .bottom-nav-item i {
            font-size: 1.2rem;
            margin-bottom: 4px;
            width: 45px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .bottom-nav-item.active {
            color: var(--primary-red) !important;
        }

        .bottom-nav-item.active i {
            background-color: rgba(163, 13, 17, 0.1);
            color: var(--primary-red);
            transform: translateY(-5px);
            font-weight: 900;
        }

        .bottom-nav-item.active span {
            color: var(--primary-red);
            font-weight: 800;
        }

        @media (max-width: 991px) {
            .navbar {
                display: none !important;
            }

            .mobile-top-header {
                display: flex;
            }

            .bottom-nav {
                display: flex;
            }

            body {
                padding-top: 0 !important;
                /* Hero starts from top */
                padding-bottom: 80px;
                /* Space for bottom nav */
            }

            /* Responsive Typography */
            .hero-title {
                font-size: 2.5rem !important;
                margin-top: 20px;
            }

            .hero-title span {
                font-size: 3rem !important;
            }

            .hero-subtitle {
                font-size: 0.95rem !important;
                margin-bottom: 2rem !important;
            }

            .section-title {
                font-size: 1.6rem !important;
            }

            .section-title::after {
                right: -10px !important;
                font-size: 0.9rem !important;
            }

            .hero-image-container {
                margin-top: 30px;
            }

            .btn-primary-custom,
            .btn-outline-custom {
                padding: 10px 15px !important;
                font-size: 0.85rem !important;
                width: auto !important;
                margin-left: 0 !important;
                margin-bottom: 0 !important;
                flex: 1;
                justify-content: center;
            }

            .hero-buttons {
                display: flex;
                flex-direction: row;
                gap: 10px !important;
            }

            /* Compact Cards for 2-Grid Mobile */
            .category-card {
                padding: 10px !important;
                border-radius: 20px !important;
            }

            .category-img {
                height: 120px !important;
                border-radius: 15px !important;
            }

            .category-card h6 {
                font-size: 0.95rem !important;
                margin-top: 5px;
            }

            .category-card p {
                font-size: 0.7rem !important;
                display: -webkit-box;
                -webkit-line-clamp: 1;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            /* Horizontal Slider for Mobile */
            .mobile-scroll-row {
                display: flex !important;
                flex-wrap: nowrap !important;
                overflow-x: auto !important;
                -webkit-overflow-scrolling: touch;
                padding-bottom: 15px !important;
                padding-left: 15px !important;
                padding-right: 15px !important;
                margin-left: -15px !important;
                margin-right: -15px !important;
                scroll-snap-type: x mandatory;
                scrollbar-width: none; /* Firefox */
            }

            .mobile-scroll-row::-webkit-scrollbar {
                display: none; /* Chrome/Safari */
            }

            .mobile-scroll-row .col-6 {
                flex: 0 0 200px !important; /* Increased width */
                width: 200px !important;
                padding-left: 8px !important; /* Reduced gap */
                padding-right: 8px !important; /* Reduced gap */
                scroll-snap-align: start;
            }

            .product-card {
                padding: 10px !important;
                border-radius: 20px !important;
            }

            .product-img {
                height: 130px !important;
                border-radius: 15px !important;
            }

            .product-title {
                font-size: 0.95rem !important;
                margin-top: 10px !important;
            }

            .product-desc {
                font-size: 0.7rem !important;
                margin-bottom: 10px !important;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            .product-price {
                font-size: 0.9rem !important;
            }

            .btn-add-cart {
                width: 32px !important;
                height: 32px !important;
                font-size: 0.8rem !important;
            }

            .badge-best-seller {
                font-size: 0.6rem !important;
                padding: 3px 8px !important;
            }

            .hero-section {
                padding-top: 100px !important;
                padding-bottom: 60px !important;
                min-height: auto !important;
                background-position: center top !important;
                background-size: cover !important;
                background-repeat: no-repeat !important;
            }

            section.py-5 {
                padding-top: 2rem !important;
                padding-bottom: 2rem !important;
            }
            .mt-5 {
                margin-top: 1rem !important;
            }

            .feature-bar {
                display: grid !important;
                grid-template-columns: 1fr 1fr;
                gap: 15px !important;
                padding: 15px !important;
                margin-top: 20px !important;
                margin-bottom: 20px !important;
                align-items: stretch !important;
                background: white;
                border-radius: 25px;
                box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            }

            .feature-item {
                flex-direction: column !important;
                align-items: center !important;
                text-align: center !important;
                padding: 10px !important;
            }

            .feature-icon-red, .feature-icon-gold {
                font-size: 1.8rem !important;
                margin-bottom: 10px !important;
            }

            .feature-info h6 {
                font-size: 0.85rem !important;
                margin-bottom: 4px !important;
            }

            .feature-info p {
                font-size: 0.65rem !important;
                line-height: 1.2 !important;
            }

            .feature-divider {
                display: none;
            }
        }

        /* Hero Section */
        .hero-section {
            padding: 120px 0 80px 0;
            min-height: 85vh;
            display: flex;
            align-items: center;
            background: radial-gradient(circle at right, rgba(163, 13, 17, 0.05) 0%, transparent 50%);
            position: relative;
            overflow: hidden;
            background-size: cover;
            background-position: center top;
        }

        .hero-image-container {
            position: relative;
            overflow: hidden;
        }

        .hero-image-container::after {
            content: '';
            position: absolute;
            width: 110%;
            height: 110%;
            background: var(--primary-red);
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.1;
            z-index: -1;
            top: -5%;
            right: -5%;
        }

        .hero-title {
            font-size: 4.5rem;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 1.5rem;
            color: var(--text-dark);
        }

        .hero-title span {
            color: var(--primary-red);
            font-family: 'Yellowtail', cursive;
            font-size: 5rem;
            display: block;
            margin-top: 10px;
            font-weight: 400;
        }

        .hero-subtitle {
            color: var(--text-muted);
            font-size: 1.1rem;
            max-width: 500px;
            margin-bottom: 2.5rem;
            line-height: 1.6;
        }

        .btn-primary-custom {
            background-color: var(--primary-red);
            color: white;
            border-radius: 12px;
            padding: 15px 35px;
            font-weight: 700;
            border: none;
            transition: 0.3s;
        }

        .btn-primary-custom:hover {
            background-color: var(--dark-red);
            transform: scale(1.05);
        }

        .btn-outline-custom {
            background-color: white;
            color: var(--text-dark);
            border-radius: 12px;
            padding: 15px 35px;
            font-weight: 700;
            border: 1px solid #ddd;
            margin-left: 15px;
            transition: 0.3s;
        }

        /* Category Section */
        .section-title {
            font-size: 2.2rem;
            font-weight: 800;
            margin-bottom: 2.5rem;
            color: #1a1a1a;
            display: inline-block;
            position: relative;
        }

        .section-title::after {
            content: '✨';
            font-size: 1.2rem;
            position: absolute;
            top: -10px;
            right: -30px;
        }

        .category-card {
            background: white;
            border-radius: 30px;
            padding: 15px;
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            position: relative;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
            text-align: left;
        }

        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(163, 13, 17, 0.1);
        }

        .category-img {
            width: 100%;
            height: 200px;
            border-radius: 20px;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .category-card h6 {
            font-weight: 800;
            margin-bottom: 5px;
            color: var(--primary-red);
            font-size: 1.2rem;
        }

        .category-card p {
            font-size: 0.85rem;
            color: #6b7280;
            margin-bottom: 0;
        }

        .btn-circle-arrow {
            position: absolute;
            bottom: 20px;
            right: 20px;
            width: 35px;
            height: 35px;
            background: var(--primary-red);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
        }

        /* Product Card */
        .product-card {
            background: white;
            border-radius: 30px;
            padding: 15px;
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.4s ease;
            position: relative;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(163, 13, 17, 0.1);
        }

        .product-img-wrapper {
            position: relative;
            margin-bottom: 15px;
        }

        .product-img {
            width: 100%;
            height: 200px;
            border-radius: 20px;
            object-fit: cover;
        }

        .badge-best-seller {
            position: absolute;
            top: 15px;
            left: 15px;
            background: #A30D11;
            color: white;
            padding: 6px 16px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 700;
            z-index: 2;
        }

        .product-title {
            font-weight: 800;
            font-size: 1.1rem;
            color: #1a1a1a;
            margin-bottom: 5px;
        }

        .product-desc {
            font-size: 0.8rem;
            color: #6b7280;
            margin-bottom: 15px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.5;
        }

        .product-price {
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--primary-red);
        }

        .btn-add-cart {
            width: 40px;
            height: 40px;
            background: var(--primary-red);
            color: white;
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            transition: 0.3s;
        }

        .btn-add-cart:hover {
            background: var(--dark-red);
            transform: scale(1.1);
        }

        /* Feature Bar */
        .feature-bar {
            background: white;
            border-radius: 25px;
            padding: 25px 40px;
            margin-top: 60px;
            margin-bottom: 60px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.02);
            border: 1px solid #F3E5D8;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 20px;
            flex: 1;
        }

        .feature-icon-red {
            font-size: 2.8rem;
            color: #A30D11;
        }

        .feature-icon-gold {
            font-size: 2.8rem;
            color: #F2994A;
        }

        .feature-info h6 {
            font-weight: 800;
            margin-bottom: 2px;
            color: #1a1a1a;
            font-size: 1rem;
        }

        .feature-info p {
            font-size: 0.85rem;
            color: #6b7280;
            margin-bottom: 0;
            line-height: 1.3;
        }

        .feature-divider {
            width: 1px;
            height: 40px;
            background: #F3E5D8;
            margin: 0 30px;
        }

        @media (max-width: 1199px) {
            .feature-bar {
                flex-wrap: wrap;
                justify-content: center;
                gap: 30px;
            }

            .feature-divider {
                display: none;
            }

            .feature-item {
                flex: 0 0 45%;
                justify-content: flex-start;
            }
        }

        @media (max-width: 767px) {
            .feature-item {
                flex: 0 0 100%;
            }
        }

        /* Footer Section */
        footer {
            background-color: #A30D11;
            color: white;
            padding: 60px 0 0;
            margin-top: 100px;
            position: relative;
        }

        .footer-logo {
            height: 50px;
            margin-bottom: 20px;
            filter: brightness(0) invert(1);
        }

        .footer-desc {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.6;
            margin-bottom: 25px;
            max-width: 300px;
        }

        .social-links {
            display: flex;
            gap: 15px;
        }

        .social-link {
            width: 35px;
            height: 35px;
            background: white;
            color: #A30D11;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            transform: translateY(-3px);
            background: #f8f9fa;
        }

        .footer-heading {
            font-weight: 800;
            font-size: 1.1rem;
            margin-bottom: 25px;
            color: white;
        }

        .footer-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-menu li {
            margin-bottom: 12px;
        }

        .footer-menu li a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 0.9rem;
            transition: 0.3s;
        }

        .footer-menu li a:hover {
            color: white;
            padding-left: 5px;
        }

        .contact-info {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .contact-info li {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.8);
        }

        .contact-info i {
            font-size: 1.1rem;
            width: 20px;
        }

        .newsletter-desc {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 20px;
        }

        .newsletter-form {
            position: relative;
            display: flex;
        }

        .newsletter-input {
            background: #FDF8F4;
            border: none;
            border-radius: 12px;
            padding: 12px 20px;
            width: 100%;
            font-size: 0.9rem;
            color: #333;
        }

        .newsletter-input::placeholder {
            color: #999;
        }

        .btn-newsletter {
            position: absolute;
            right: 4px;
            top: 4px;
            bottom: 4px;
            background: #A30D11;
            color: white;
            border: none;
            border-radius: 10px;
            width: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.3s;
        }

        .btn-newsletter:hover {
            background: #8B0A0D;
        }

        .footer-divider {
            width: 1px;
            height: 150px;
            background: rgba(255, 255, 255, 0.1);
            margin: 0 auto;
        }

        @media (min-width: 992px) {
            .border-start-lg {
                border-left: 1px solid rgba(255, 255, 255, 0.1);
            }
        }

        .copyright-bar {
            background: #8B0A0D;
            padding: 20px 0;
            margin-top: 60px;
            text-align: center;
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.7);
        }

        @media (max-width: 991px) {
            .footer-divider {
                display: none;
            }
        }
    </style>
</head>

<body>