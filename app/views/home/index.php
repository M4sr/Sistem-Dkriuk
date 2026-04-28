<!-- Hero Section (Slider) -->
<?php if (!empty($data['banners'])): ?>
    <section id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <?php foreach ($data['banners'] as $index => $b): ?>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="<?= $index; ?>"
                    class="<?= $index == 0 ? 'active' : ''; ?>" aria-current="true"></button>
            <?php endforeach; ?>
        </div>
        <div class="carousel-inner">
            <?php foreach ($data['banners'] as $index => $b): ?>
                <div class="carousel-item <?= $index == 0 ? 'active' : ''; ?>" data-bs-interval="5000">
                    <?php
                    $hero_banner = !empty($b['gambar']) ? BASEURL . '/assets/img/banner/' . $b['gambar'] : BASEURL . '/assets/img/hero_fried_chicken.png';
                    ?>
                    <div class="hero-section"
                        style="background: linear-gradient(90deg, rgba(255,255,255,0.8) 0%, rgba(255,255,255,0.1) 60%, rgba(255,255,255,0) 100%), url('<?= $hero_banner; ?>'); background-size: cover; background-position: center;">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-7" data-aos="fade-right">
                                    <h1 class="hero-title" style="text-shadow: 0 2px 10px rgba(255,255,255,0.5);">
                                        <?= !empty($b['judul']) ? $b['judul'] : 'Ayam Goreng'; ?>
                                        <span><?= !empty($b['subjudul']) ? $b['subjudul'] : 'Crispy, Gurih & Juicy!'; ?></span>
                                    </h1>
                                    <p class="hero-subtitle mb-4" style="max-width: 500px; color: #4b5563;">
                                        <?= !empty($b['deskripsi']) ? $b['deskripsi'] : 'Nikmati berbagai pilihan menu favorit dengan harga terjangkau.'; ?>
                                    </p>
                                    <div class="hero-buttons d-flex flex-wrap gap-3 mt-4">
                                        <button class="btn btn-primary-custom d-flex align-items-center shadow-lg px-4">
                                            <i class="fas fa-utensils me-2"></i> Pesan Sekarang
                                        </button>
                                        <button class="btn btn-outline-custom px-4 ms-0 shadow-sm">
                                            Lihat Menu
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev"
            style="width: 5%;">
            <span class="carousel-control-prev-icon bg-dark rounded-circle p-3 opacity-25" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next"
            style="width: 5%;">
            <span class="carousel-control-next-icon bg-dark rounded-circle p-3 opacity-25" aria-hidden="true"></span>
        </button>
    </section>
<?php else: ?>
    <!-- Default Hero if no banners -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="hero-title">Ayam Goreng <span>Crispy, Gurih & Juicy!</span></h1>
                    <p class="hero-subtitle">Nikmati berbagai pilihan menu favorit dengan kualitas terbaik dan harga yang
                        sangat terjangkau.</p>
                    <div class="hero-buttons d-flex flex-wrap gap-3">
                        <button class="btn btn-primary-custom d-flex align-items-center shadow-lg px-4">
                            <i class="fas fa-utensils me-2"></i> Pesan Sekarang
                        </button>
                        <button class="btn btn-outline-custom px-4 ms-0">
                            Lihat Menu
                        </button>
                    </div>
                </div>
                <div class="col-lg-6 mt-5 mt-lg-0">
                    <div class="hero-image-container text-center">
                        <img src="<?= BASEURL; ?>/assets/img/hero_fried_chicken.png" alt="Hero Fried Chicken"
                            class="img-fluid" style="max-height: 500px; filter: drop-shadow(0 20px 30px rgba(0,0,0,0.1));">
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<div class="container">
    <!-- Categories -->
    <section class="py-5 mt-5">
        <h3 class="section-title">Kategori Menu</h3>
        <div class="row g-4 mobile-scroll-row">
            <?php
            $dummy_cats = [
                ['nama' => 'Original', 'desc' => 'Menu utama favorit', 'img' => 'https://images.unsplash.com/photo-1562967914-608f82629710?w=400'],
                ['nama' => 'Hot', 'desc' => 'Pedas nikmat', 'img' => 'https://images.unsplash.com/photo-1626082896492-766af4eb6501?w=400'],
                ['nama' => 'Saus', 'desc' => 'Aneka pilihan saus', 'img' => 'https://images.unsplash.com/photo-1527477396000-e27163b481c2?w=400'],
                ['nama' => 'Cemilan', 'desc' => 'Camilan enak & lezat', 'img' => 'https://images.unsplash.com/photo-1567620832903-9fc6debc209f?w=400']
            ];
            foreach ($data['kategori'] as $index => $k):
                $img = $dummy_cats[$index % 4]['img'];
                $desc = $dummy_cats[$index % 4]['desc'];
                ?>
                <div class="col-6 col-sm-6 col-lg-3">
                    <a href="<?= BASEURL; ?>/menu/index/<?= $k['id']; ?>" class="text-decoration-none">
                        <div class="category-card h-100">
                            <img src="<?= $img; ?>" class="category-img" alt="<?= $k['nama']; ?>">
                            <h6><?= $k['nama']; ?></h6>
                            <p><?= $desc; ?></p>
                            <div class="btn-circle-arrow">
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Best Sellers -->
    <section class="py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="section-title mb-0">Best Seller</h3>
            <a href="<?= BASEURL; ?>/menu" class="text-danger fw-bold text-decoration-none small d-flex align-items-center">
                Lihat Semua
                <span class="ms-2 d-flex align-items-center justify-content-center bg-danger text-white rounded-circle"
                    style="width: 24px; height: 24px; font-size: 10px;">
                    <i class="fas fa-arrow-right"></i>
                </span>
            </a>
        </div>
        <div class="row g-4 mobile-scroll-row">
            <?php foreach ($data['best_seller'] as $p): ?>
                <div class="col-6 col-sm-6 col-lg-3">
                    <div class="product-card">
                        <div class="product-img-wrapper">
                            <span class="badge-best-seller">Best Seller</span>
                            <img src="<?= BASEURL; ?>/assets/img/produk/<?= $p['foto']; ?>" class="product-img"
                                alt="<?= $p['nama']; ?>"
                                onerror="this.src='https://placehold.co/400x400?text=Menu+DKriuk'">
                        </div>
                        <h6 class="product-title"><?= $p['nama']; ?></h6>
                        <p class="product-desc"><?= $p['deskripsi'] ?? 'Ayam goreng crispy dengan bumbu rahasia.'; ?></p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <span class="product-price">Rp <?= number_format($p['harga'], 0, ',', '.'); ?></span>
                            <button class="btn-add-cart" 
                                    data-id="<?= $p['id']; ?>" 
                                    data-nama="<?= $p['nama']; ?>" 
                                    data-harga="<?= $p['harga']; ?>" 
                                    data-foto="<?= $p['foto']; ?>">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Features Bar -->
    <div class="feature-bar mx-0">
        <div class="feature-item">
            <i class="fas fa-motorcycle feature-icon-red"></i>
            <div class="feature-info">
                <h6>Pengiriman Cepat</h6>
                <p>Sampai di tujuan dengan cepat</p>
            </div>
        </div>
        <div class="feature-divider"></div>
        <div class="feature-item">
            <i class="fas fa-award feature-icon-red"></i>
            <div class="feature-info">
                <h6>Bahan Berkualitas</h6>
                <p>Menggunakan bahan segar dan berkualitas</p>
            </div>
        </div>
        <div class="feature-divider"></div>
        <div class="feature-item">
            <i class="fas fa-circle-dollar-to-slot feature-icon-gold"></i>
            <div class="feature-info">
                <h6>Harga Terjangkau</h6>
                <p>Kualitas terbaik dengan harga bersahabat</p>
            </div>
        </div>
        <div class="feature-divider"></div>
        <div class="feature-item">
            <i class="fas fa-heart feature-icon-red"></i>
            <div class="feature-info">
                <h6>Disukai Banyak Orang</h6>
                <p>Rasa lezat yang disukai semua kalangan</p>
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

<style>
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
    @keyframes bounce {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.2); }
    }

    .cart-bounce {
        animation: bounce 0.4s ease;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cartBtns = document.querySelectorAll('.btn-add-cart');
        const checkoutBar = document.getElementById('checkoutBar');
        const cartCountEl = document.getElementById('cartCount');
        const cartTotalEl = document.getElementById('cartTotal');

        let cart = JSON.parse(localStorage.getItem('dkriuk_cart')) || [];

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
                const imgElement = this.closest('.product-card').querySelector('.product-img');
                const cartTarget = document.getElementById('cartCount');
                
                if (imgElement && cartTarget) {
                    const imgRect = imgElement.getBoundingClientRect();
                    const cartRect = cartTarget.getBoundingClientRect();
                    
                    const flyImg = document.createElement('img');
                    flyImg.src = imgElement.src;
                    flyImg.className = 'fly-item';
                    flyImg.style.left = `${imgRect.left}px`;
                    flyImg.style.top = `${imgRect.top}px`;
                    flyImg.style.width = `${imgRect.width}px`;
                    flyImg.style.height = `${imgRect.height}px`;
                    
                    document.body.appendChild(flyImg);
                    
                    requestAnimationFrame(() => {
                        flyImg.style.left = `${cartRect.left + (cartRect.width / 2) - 20}px`;
                        flyImg.style.top = `${cartRect.top + (cartRect.height / 2) - 20}px`;
                        flyImg.style.width = '40px';
                        flyImg.style.height = '40px';
                        flyImg.style.opacity = '0.5';
                        flyImg.style.transform = 'rotate(360deg)';
                    });
                    
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

                // Simple feedback animation on button
                this.style.transform = 'scale(0.9)';
                setTimeout(() => this.style.transform = '', 100);
            });
        });

        updateUI();
    });
</script>