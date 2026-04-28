<style>
    .about-page {
        background-color: #fff;
        padding-bottom: 50px;
    }

    /* Hero Section */
    .about-hero {
        background: #FDF8F4;
        padding: 140px 0 80px;
        position: relative;
        overflow: hidden;
    }

    @media (max-width: 991px) {
        .about-hero {
            padding: 100px 0 60px;
        }
    }

    .bg-illustration {
        position: absolute;
        opacity: 0.04;
        z-index: 1;
        font-size: 15rem;
        color: var(--primary-red);
        pointer-events: none;
    }

    .bg-chili { top: -5%; left: -5%; transform: rotate(-25deg); }
    .bg-leg { bottom: -5%; right: -5%; transform: rotate(25deg); }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-content h1 {
        font-size: 4.5rem;
        font-weight: 900;
        color: #1a1a1a;
        margin-bottom: 10px;
        line-height: 1.1;
    }

    .hero-content h1 span {
        font-family: 'Yellowtail', cursive;
        color: var(--primary-red);
        font-size: 5rem;
        font-weight: 400;
        display: block;
        margin-top: -10px;
    }

    .hero-content p {
        font-size: 1.1rem;
        color: #666;
        max-width: 500px;
        line-height: 1.8;
        margin-top: 20px;
    }

    .hero-img-wrapper {
        position: relative;
        z-index: 2;
    }

    .hero-img {
        width: 100%;
        max-width: 600px;
        filter: drop-shadow(0 40px 60px rgba(163, 13, 17, 0.2));
    }

    /* Story Section */
    .story-section {
        padding: 100px 0;
    }

    .story-img {
        width: 100%;
        border-radius: 40px;
        box-shadow: 0 30px 60px rgba(0,0,0,0.08);
        transition: 0.5s;
    }

    .story-img:hover {
        transform: scale(1.02);
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 900;
        color: #1a1a1a;
        margin-bottom: 30px;
        position: relative;
        display: inline-block;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 60px;
        height: 5px;
        background: var(--primary-red);
        border-radius: 50px;
    }

    .story-text p {
        font-size: 1.1rem;
        color: #555;
        line-height: 1.8;
        margin-bottom: 25px;
    }

    /* Features Icons */
    .features-grid {
        padding: 80px 0;
        background: #fff;
    }

    .feature-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 40px 20px;
        position: relative;
        height: 100%;
        transition: 0.3s;
    }

    .feature-item:hover {
        transform: translateY(-10px);
    }

    /* Vertical Divider */
    .feature-column:not(:last-child) {
        border-right: 1px solid #f8f8f8;
    }

    .feature-icon-circle {
        width: 90px;
        height: 90px;
        background: #FFF5F5;
        color: var(--primary-red);
        border-radius: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px;
        transition: all 0.4s ease;
        font-size: 2.2rem;
    }

    .feature-item:hover .feature-icon-circle {
        background: var(--primary-red);
        color: white;
        transform: rotate(10deg);
        box-shadow: 0 15px 30px rgba(163, 13, 17, 0.2);
    }

    .feature-item h4 {
        font-weight: 900;
        font-size: 1.3rem;
        margin-bottom: 15px;
        color: #1a1a1a;
    }

    .feature-item p {
        font-size: 1rem;
        color: #777;
        line-height: 1.6;
        max-width: 240px;
        margin: 0 auto;
        font-weight: 500;
    }

    /* Values Card (Beige) */
    .values-card {
        background: #FDF8F4;
        border-radius: 60px;
        padding: 100px 50px;
        margin: 40px 0 100px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.02);
    }

    .values-header {
        text-align: center;
        margin-bottom: 80px;
    }

    .values-header h3 {
        font-weight: 900;
        font-size: 2.5rem;
        position: relative;
        display: inline-block;
    }

    .values-header h3::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 50px;
        height: 5px;
        background: var(--primary-red);
        border-radius: 50px;
    }

    .value-item {
        text-align: center;
        transition: 0.3s;
    }

    .value-item:hover {
        transform: scale(1.05);
    }

    .value-icon-wrapper {
        font-size: 3.5rem;
        color: var(--primary-red);
        margin-bottom: 25px;
        display: flex;
        justify-content: center;
        transition: 0.3s;
    }

    .value-item:hover .value-icon-wrapper {
        transform: translateY(-5px);
    }

    .value-item h5 {
        font-weight: 900;
        font-size: 1.4rem;
        margin-bottom: 15px;
        color: #1a1a1a;
    }

    .value-item p {
        font-size: 1rem;
        color: #666;
        line-height: 1.6;
        max-width: 220px;
        margin: 0 auto;
        font-weight: 500;
    }

    /* Footer CTA Banner */
    .cta-banner {
        background: var(--primary-red);
        border-radius: 45px;
        padding: 60px 80px;
        margin-top: 20px;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(163, 13, 17, 0.2);
    }

    .cta-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 40px;
        position: relative;
        z-index: 2;
    }

    .cta-left {
        display: flex;
        align-items: center;
        gap: 50px;
    }

    .cta-img {
        width: 250px;
        flex-shrink: 0;
        filter: drop-shadow(0 20px 30px rgba(0,0,0,0.25));
    }

    .cta-text h3 {
        font-weight: 900;
        font-size: 2rem;
        line-height: 1.2;
        margin-bottom: 0;
    }

    .cta-text h3 span {
        font-family: 'Yellowtail', cursive;
        font-weight: 400;
        font-size: 3rem;
        color: #FFD700;
        display: block;
        margin-top: 10px;
    }

    .btn-order-now {
        background: white;
        color: var(--primary-red);
        padding: 20px 45px;
        border-radius: 20px;
        font-weight: 900;
        display: flex;
        align-items: center;
        gap: 15px;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        text-decoration: none !important;
        white-space: nowrap;
        font-size: 1.1rem;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .btn-order-now:hover {
        transform: translateY(-5px) scale(1.05);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        background: #f8f9fa;
        color: var(--dark-red);
    }

    @media (max-width: 991px) {
        .about-hero { text-align: center; }
        .hero-content h1 { font-size: 3.5rem; }
        .hero-content h1 span { font-size: 4rem; }
        .hero-content p { margin: 20px auto 40px; }
        .cta-content { flex-direction: column; text-align: center; gap: 40px; }
        .cta-left { flex-direction: column; gap: 30px; }
        .feature-column { border-right: none !important; border-bottom: 1px solid #f8f8f8; }
        .values-card { padding: 60px 30px; }
        .cta-banner { padding: 50px 30px; }
    }
</style>

<div class="about-page">
    <!-- Hero Section -->
    <section class="about-hero">
        <i class="fas fa-pepper-hot bg-illustration bg-chili"></i>
        <i class="fas fa-drumstick-bite bg-illustration bg-leg"></i>
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 hero-content">
                    <h1>Tentang <span>Kami</span></h1>
                    <p>Dkriuk Fried Chicken hadir untuk memberikan pengalaman terbaik bagi pecinta ayam goreng dengan cita rasa khas dan kualitas terbaik.</p>
                </div>
                <div class="col-lg-6 hero-img-wrapper text-center">
                    <img src="https://pngimg.com/uploads/fried_chicken/fried_chicken_PNG14092.png" alt="Fried Chicken" class="hero-img">
                </div>
            </div>
        </div>
    </section>

    <!-- Story Section -->
    <section class="story-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=800" alt="Outlet DKriuk" class="story-img">
                </div>
                <div class="col-lg-6 story-text ps-lg-5">
                    <h3 class="section-title">Cerita Kami</h3>
                    <p>Berawal dari sebuah dapur kecil dengan resep turun-temurun, kami berkomitmen untuk menyajikan ayam goreng yang renyah di luar, juicy di dalam, dan penuh cita rasa.</p>
                    <p>Kami percaya bahwa makanan enak dibuat dari bahan pilihan, proses yang higienis, dan sentuhan hati yang tulus.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-grid">
        <div class="container">
            <div class="row g-0">
                <div class="col-lg-3 col-md-6 feature-column">
                    <div class="feature-item">
                        <div class="feature-icon-circle">
                            <i class="fas fa-drumstick-bite"></i>
                        </div>
                        <h4>Bahan Berkualitas</h4>
                        <p>Kami hanya menggunakan bahan segar dan berkualitas tinggi untuk rasa terbaik.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 feature-column">
                    <div class="feature-item">
                        <div class="feature-icon-circle">
                            <i class="fas fa-utensils fa-stroke"></i>
                        </div>
                        <h4>Resep Rahasia</h4>
                        <p>Racikan bumbu khas kami membuat rasa yang unik dan berbeda.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 feature-column">
                    <div class="feature-item">
                        <div class="feature-icon-circle">
                            <i class="fas fa-shield-halved fa-stroke"></i>
                        </div>
                        <h4>Higienis & Aman</h4>
                        <p>Proses memasak sesuai standar kebersihan untuk keamanan pelanggan.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 feature-column">
                    <div class="feature-item">
                        <div class="feature-icon-circle">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4>Pelayanan Ramah</h4>
                        <p>Kepuasan pelanggan adalah prioritas kami. Kami siap melayani sepenuh hati.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Card (Beige) -->
    <section class="container">
        <div class="values-card">
            <div class="values-header">
                <h3>Nilai Kami</h3>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="value-item">
                        <div class="value-icon-wrapper">
                            <i class="far fa-heart"></i>
                        </div>
                        <h5>Jujur</h5>
                        <p>Kami berkomitmen untuk selalu jujur dalam kualitas dan pelayanan.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="value-item">
                        <div class="value-icon-wrapper">
                            <i class="far fa-star"></i>
                        </div>
                        <h5>Berkualitas</h5>
                        <p>Selalu memberikan kualitas terbaik di setiap menu.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="value-item">
                        <div class="value-icon-wrapper">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h5>Terpercaya</h5>
                        <p>Kepercayaan pelanggan adalah aset terbesar kami.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="value-item">
                        <div class="value-icon-wrapper">
                            <i class="far fa-smile"></i>
                        </div>
                        <h5>Bersahabat</h5>
                        <p>Menciptakan pengalaman makan yang menyenangkan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Banner CTA -->
    <section class="container">
        <div class="cta-banner">
            <div class="cta-content">
                <div class="cta-left">
                    <img src="https://pngimg.com/uploads/fried_chicken/fried_chicken_PNG14082.png" alt="Product" class="cta-img">
                    <div class="cta-text">
                        <h3>Terima kasih telah menjadi<br>bagian dari keluarga besar<br><span>Gambar Fried Chicken</span></h3>
                    </div>
                </div>
                <div class="cta-right">
                    <a href="<?= BASEURL; ?>/menu" class="btn-order-now">
                        <i class="fas fa-heart"></i> Pesan Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
