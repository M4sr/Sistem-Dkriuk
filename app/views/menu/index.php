<style>
    .menu-page {
        min-height: 100vh;
        padding-bottom: 100px;
    }

    .menu-header-wrapper {
        position: relative;
        padding: 120px 0 60px;
        overflow: hidden;
    }

    .bg-illustration {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        opacity: 0.03;
        z-index: -1;
        font-size: 15rem;
        color: var(--primary-red);
        pointer-events: none;
    }

    .bg-chili { left: 5%; transform: translateY(-50%) rotate(-15deg); }
    .bg-leg { right: 5%; transform: translateY(-50%) rotate(15deg); }

    .btn-back-wrapper {
        display: inline-flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        color: #333;
        transition: 0.3s;
    }

    .btn-back-wrapper:hover {
        transform: scale(1.05);
        color: var(--primary-red);
    }

    .btn-back-circle {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: #FDF8F4;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #F3E5D8;
        font-size: 1.4rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    }

    .btn-back-text {
        font-size: 0.9rem;
        font-weight: 700;
        color: #888;
    }

    .menu-header h1 {
        font-size: 4.5rem;
        font-weight: 800;
        color: #1a1a1a;
        margin-bottom: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 20px;
        white-space: nowrap;
    }

    .menu-header h1 span {
        font-family: 'Yellowtail', cursive;
        color: var(--primary-red);
        font-weight: 400;
        font-size: 5rem;
        position: relative;
    }

    .menu-header h1 span::after {
        content: '✨';
        font-size: 1.5rem;
        position: absolute;
        top: -10px;
        right: -40px;
    }

    .menu-subtitle {
        color: #6b7280;
        font-size: 1.1rem;
        max-width: 650px;
        line-height: 1.6;
        margin: 15px auto 0;
    }

    /* Sidebar Styles */
    .menu-sidebar {
        background: #FDF8F4;
        border-radius: 30px;
        padding: 30px 20px;
        height: fit-content;
        border: 1px solid #F3E5D8;
    }

    .welcome-text h4 {
        font-family: 'Yellowtail', cursive;
        color: var(--primary-red);
        font-size: 2.5rem;
        margin-bottom: 10px;
    }

    .welcome-text p {
        font-size: 1.1rem;
        font-weight: 700;
        color: #333;
        line-height: 1.4;
        margin-bottom: 30px;
    }

    .category-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .category-item {
        display: flex;
        align-items: center;
        padding: 15px 20px;
        background: white;
        border-radius: 20px;
        text-decoration: none;
        color: #333;
        transition: all 0.3s ease;
        border: 1px solid #eee;
    }

    .category-item.active {
        background: var(--primary-red);
        color: white;
        border-color: var(--primary-red);
        box-shadow: 0 10px 20px rgba(163, 13, 17, 0.2);
    }

    .category-icon-wrapper {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        background: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        font-size: 1.2rem;
        color: var(--primary-red);
    }

    .category-item.active .category-icon-wrapper {
        background: rgba(255,255,255,0.2);
        color: white;
    }

    .category-info h6 {
        font-weight: 800;
        margin-bottom: 2px;
        font-size: 0.95rem;
    }

    .category-info p {
        font-size: 0.75rem;
        color: #666;
        margin-bottom: 0;
    }

    .category-item.active .category-info p {
        color: rgba(255,255,255,0.8);
    }

    .category-chevron {
        margin-left: auto;
        font-size: 0.8rem;
        opacity: 0.5;
    }

    .category-item.active .category-chevron {
        opacity: 1;
    }

    /* Product Horizontal Card */
    .product-row-card {
        background: white;
        border-radius: 30px;
        padding: 20px;
        border: 1px solid rgba(0,0,0,0.05);
        display: flex;
        align-items: center;
        gap: 25px;
        margin-bottom: 25px;
        transition: 0.3s;
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
    }

    .product-row-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.05);
    }

    .product-row-img {
        width: 180px;
        height: 150px;
        border-radius: 20px;
        object-fit: cover;
    }

    .product-row-info {
        flex: 1;
    }

    .product-row-title {
        font-weight: 800;
        font-size: 1.5rem;
        color: #1a1a1a;
        margin-bottom: 8px;
    }

    .product-row-desc {
        color: #6b7280;
        font-size: 0.95rem;
        margin-bottom: 15px;
        max-width: 500px;
    }

    .product-row-price {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--primary-red);
    }

    .btn-add-row {
        width: 50px;
        height: 50px;
        background: var(--primary-red);
        color: white;
        border: none;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        transition: 0.3s;
    }

    .btn-add-row:hover {
        background: var(--dark-red);
        transform: rotate(90deg) scale(1.1);
    }

    @media (max-width: 991px) {
        .menu-header-wrapper {
            padding: 80px 0 30px;
        }

        .menu-header h1 {
            font-size: 2.2rem;
            flex-wrap: wrap;
            gap: 10px;
            white-space: normal;
        }

        .menu-header h1 span {
            font-size: 2.5rem;
        }

        .menu-header h1 span::after {
            display: none;
        }

        .menu-subtitle {
            font-size: 0.9rem;
            padding: 0 15px;
        }

        .menu-sidebar {
            padding: 15px;
            margin-bottom: 20px;
            background: transparent;
            border: none;
        }

        .welcome-text {
            display: none;
        }

        .category-list {
            flex-direction: row;
            overflow-x: auto;
            padding-bottom: 15px;
            gap: 10px;
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none;  /* IE and Edge */
        }

        .category-list::-webkit-scrollbar {
            display: none; /* Chrome, Safari, Opera */
        }

        .category-item {
            flex: 0 0 auto;
            padding: 10px 18px;
            border-radius: 15px;
        }

        .category-icon-wrapper {
            width: 35px;
            height: 35px;
            margin-right: 10px;
            font-size: 1rem;
        }

        .category-info p, .category-chevron {
            display: none;
        }

        .category-info h6 {
            margin-bottom: 0;
            font-size: 0.85rem;
        }

        .product-row-card {
            padding: 12px;
            gap: 15px;
            border-radius: 20px;
            margin-bottom: 15px;
        }

        .product-row-img {
            width: 110px;
            height: 110px;
            border-radius: 15px;
            flex-shrink: 0;
        }

        .product-row-title {
            font-size: 1rem;
            margin-bottom: 4px;
            line-height: 1.2;
        }

        .product-row-desc {
            font-size: 0.8rem;
            margin-bottom: 6px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-row-price {
            font-size: 1.1rem;
        }

        .btn-add-row {
            width: 40px;
            height: 40px;
            font-size: 1rem;
            flex-shrink: 0;
        }
    }

    /* Floating Checkout Bar */
    .checkout-bar {
        position: fixed;
        left: 50%;
        transform: translateX(-50%) translateY(150%);
        z-index: 1050;
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: white;
        background: var(--primary-red);
    }

    .checkout-bar.active {
        transform: translateX(-50%) translateY(0);
    }

    .cart-info {
        display: flex;
        align-items: center;
    }

    /* DESKTOP STYLE (Gagah & Premium) */
    @media (min-width: 992px) {
        .checkout-bar {
            bottom: 30px;
            width: 90%;
            max-width: 800px;
            border-radius: 25px;
            padding: 15px 30px;
            box-shadow: 0 15px 40px rgba(163, 13, 17, 0.4);
        }

        .cart-info {
            gap: 20px;
        }

        .cart-count-badge {
            width: 50px;
            height: 50px;
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            font-size: 1.3rem;
            flex-shrink: 0;
        }

        .cart-price-info {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .cart-price-info span:first-child {
            font-size: 0.75rem;
            text-transform: uppercase;
            font-weight: 700;
            opacity: 0.8;
            letter-spacing: 1px;
        }

        .cart-total-price {
            font-size: 1.5rem;
            font-weight: 900;
        }

        .btn-go-checkout {
            background: white;
            color: var(--primary-red);
            border: none;
            padding: 12px 35px;
            border-radius: 18px;
            font-weight: 900;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s ease;
            text-decoration: none;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .btn-go-checkout:hover {
            transform: translateY(-3px) scale(1.05);
            color: var(--dark-red);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }
    }

    /* MOBILE STYLE (Diet & Ramping) */
    @media (max-width: 991px) {
        .checkout-bar {
            bottom: 95px;
            width: 92%;
            padding: 10px 15px;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(163, 13, 17, 0.3);
            border: 1px solid rgba(255,255,255,0.1);
        }

        .cart-info {
            gap: 12px;
        }

        .cart-count-badge {
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 10px;
            padding: 4px 12px;
            font-weight: 800;
            font-size: 1.1rem;
        }

        .cart-price-info {
            display: flex;
            flex-direction: column;
            line-height: 1.1;
        }

        .cart-price-info span:first-child {
            font-size: 0.6rem;
            text-transform: uppercase;
            font-weight: 700;
            opacity: 0.8;
        }

        .cart-total-price {
            font-size: 1rem;
            font-weight: 800;
        }

        .btn-go-checkout {
            background: rgba(255,255,255,0.1);
            color: white;
            border: 1px solid rgba(255,255,255,0.2);
            padding: 8px 15px;
            border-radius: 12px;
            font-weight: 800;
            font-size: 0.8rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 5px;
        }
    }

    /* Animation for adding */
    @keyframes bounce {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.2); }
    }

    .cart-bounce {
        animation: bounce 0.4s ease;
    }

    /* FLY TO CART ANIMATION CSS */
    .fly-item {
        position: fixed;
        z-index: 9999;
        width: 100px;
        height: 100px;
        border-radius: 20px;
        object-fit: cover;
        pointer-events: none;
        transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 10px 40px rgba(0,0,0,0.4);
        border: 4px solid white;
    }

    @keyframes cart-pop {
        0% { transform: scale(1); }
        50% { transform: scale(1.4); }
        100% { transform: scale(1); }
    }

    .cart-pop-active {
        animation: cart-pop 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
</style>

<div class="menu-page">
    <div class="container">
        <!-- Header Rata Tengah Halaman dengan Ilustrasi -->
        <div class="menu-header-wrapper">
            <!-- Ilustrasi Background (FontAwesome Icons) -->
            <i class="fas fa-pepper-hot bg-illustration bg-chili"></i>
            <i class="fas fa-drumstick-bite bg-illustration bg-leg"></i>

            <div class="row align-items-center">
                <div class="col-md-3 d-none d-md-block">
                    <a href="<?= BASEURL; ?>" class="btn-back-wrapper">
                        <div class="btn-back-circle">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                        <span class="btn-back-text">Kembali</span>
                    </a>
                </div>
                <div class="col-md-6 text-center">
                    <div class="menu-header">
                        <h1>Menu <span><?= $data['kategori_info']['nama']; ?></span></h1>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
            
            <div class="text-center">
                <p class="menu-subtitle mx-auto">Pilihan menu terbaik dengan cita rasa ayam goreng yang lezat dan berkualitas.</p>
            </div>
        </div>

        <div class="row g-5">
            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="menu-sidebar shadow-sm">
                    <div class="welcome-text">
                        <h4>Dkriuk</h4>
                        <p>Selamat Datang<br>Di D'Kriuk Fried<br>Menu Chicken</p>
                    </div>

                    <div class="category-list">
                        <?php 
                        foreach($data['kategori'] as $k): 
                            $isActive = ($k['id'] == $data['active_kategori']);
                            $icon = !empty($k['ikon']) ? $k['ikon'] : 'utensils';
                            // Tambahkan prefiks fa- jika belum ada
                            if (strpos($icon, 'fa-') !== 0) {
                                $icon = 'fa-' . $icon;
                            }
                            $desc = !empty($k['deskripsi']) ? $k['deskripsi'] : 'Menu pilihan terbaik';
                        ?>
                        <a href="<?= BASEURL; ?>/menu/index/<?= $k['id']; ?>" class="category-item <?= $isActive ? 'active' : ''; ?>">
                            <div class="category-icon-wrapper">
                                <i class="fas <?= $icon; ?>"></i>
                            </div>
                            <div class="category-info">
                                <h6><?= $k['nama']; ?></h6>
                                <p><?= $desc; ?></p>
                            </div>
                            <div class="category-chevron">
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Data Produk: <?= count($data['produk']); ?> items -->
                <div class="menu-items">
                    <?php if(count($data['produk']) == 0): ?>
                    <div class="text-center py-5">
                        <img src="https://illustrations.popsy.co/amber/no-messages-for-now.svg" style="height: 200px;" alt="Empty">
                        <h5 class="mt-4 text-muted">Belum ada produk di kategori ini.</h5>
                    </div>
                    <?php else: ?>
                        <?php foreach($data['produk'] as $p): ?>
                        <div class="product-row-card">
                            <img src="<?= BASEURL; ?>/assets/img/produk/<?= $p['foto']; ?>" class="product-row-img" alt="<?= $p['nama']; ?>" onerror="this.src='https://placehold.co/400x400?text=Menu+DKriuk'">
                            <div class="product-row-info">
                                <h3 class="product-row-title"><?= $p['nama']; ?></h3>
                                <p class="product-row-desc"><?= $p['deskripsi'] ?? 'Paket ayam goreng dengan nasi dan sambal spesial.'; ?></p>
                                <span class="product-row-price">Rp <?= number_format($p['harga'], 0, ',', '.'); ?></span>
                            </div>
                            <button class="btn-add-row btn-add-cart" 
                                    data-id="<?= $p['id']; ?>" 
                                    data-nama="<?= $p['nama']; ?>" 
                                    data-harga="<?= $p['harga']; ?>" 
                                    data-foto="<?= $p['foto']; ?>">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Floating Checkout Bar -->
<div class="checkout-bar" id="checkoutBar">
    <div class="cart-info">
        <div class="cart-count-badge" id="cartCount">0</div>
        <div class="cart-price-info">
            <span>Total Pesanan</span>
            <span class="cart-total-price" id="cartTotal">Rp 0</span>
        </div>
    </div>
    <a href="<?= BASEURL; ?>/checkout" class="btn-go-checkout">
        Lanjut Pesan <i class="fas fa-chevron-right"></i>
    </a>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cartBtns = document.querySelectorAll('.btn-add-cart');
        const checkoutBar = document.getElementById('checkoutBar');
        const cartCountEl = document.getElementById('cartCount');
        const cartTotalEl = document.getElementById('cartTotal');

        let cart = JSON.parse(localStorage.getItem('dkriuk_cart')) || [];

        // Cek jika ada perintah clear_cart dari backend (saat produk tidak valid/dihapus admin)
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('clear_cart')) {
            localStorage.removeItem('dkriuk_cart');
            cart = [];
            // Bersihkan URL dari parameter agar tidak loop
            window.history.replaceState({}, document.title, window.location.pathname);
        }

        function updateUI() {
            const totalItems = cart.reduce((acc, item) => acc + item.qty, 0);
            const totalPrice = cart.reduce((acc, item) => acc + (item.harga * item.qty), 0);

            if (totalItems > 0) {
                checkoutBar.classList.add('active');
                cartCountEl.textContent = totalItems;
                cartTotalEl.textContent = 'Rp ' + totalPrice.toLocaleString('id-ID');
                
                // Bounce animation
                cartCountEl.classList.remove('cart-bounce');
                void cartCountEl.offsetWidth; // trigger reflow
                cartCountEl.classList.add('cart-bounce');
            } else {
                checkoutBar.classList.remove('active');
            }
        }

        cartBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const nama = this.getAttribute('data-nama');
                const harga = parseInt(this.getAttribute('data-harga'));
                const foto = this.getAttribute('data-foto');

                // ANIMASI TERBANG (GOKIL!)
                const imgElement = this.closest('.product-row-card').querySelector('.product-row-img');
                const cartTarget = document.getElementById('cartCount');
                
                if (imgElement && cartTarget) {
                    const imgRect = imgElement.getBoundingClientRect();
                    const cartRect = cartTarget.getBoundingClientRect();
                    
                    // Buat kloning gambar untuk diterbangkan
                    const flyImg = document.createElement('img');
                    flyImg.src = imgElement.src;
                    flyImg.className = 'fly-item';
                    flyImg.style.left = `${imgRect.left}px`;
                    flyImg.style.top = `${imgRect.top}px`;
                    flyImg.style.width = `${imgRect.width}px`;
                    flyImg.style.height = `${imgRect.height}px`;
                    
                    document.body.appendChild(flyImg);
                    
                    // Jalankan animasi
                    requestAnimationFrame(() => {
                        flyImg.style.left = `${cartRect.left + (cartRect.width / 2) - 20}px`;
                        flyImg.style.top = `${cartRect.top + (cartRect.height / 2) - 20}px`;
                        flyImg.style.width = '40px';
                        flyImg.style.height = '40px';
                        flyImg.style.opacity = '0.5';
                        flyImg.style.transform = 'rotate(360deg)';
                    });
                    
                    // Bersihkan dan kasih efek pop ke keranjang
                    setTimeout(() => {
                        flyImg.remove();
                        cartTarget.classList.add('cart-pop-active');
                        setTimeout(() => cartTarget.classList.remove('cart-pop-active'), 400);
                    }, 800);
                }

                const existingItem = cart.find(item => item.id === id);

                if (existingItem) {
                    existingItem.qty += 1;
                } else {
                    cart.push({ id, nama, harga, foto, qty: 1 });
                }

                localStorage.setItem('dkriuk_cart', JSON.stringify(cart));
                updateUI();
            });
        });

        // Initial UI Update
        updateUI();
    });
</script>
