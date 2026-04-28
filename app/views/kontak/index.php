<style>
    .contact-page {
        background-color: #fff;
        padding-bottom: 50px;
    }

    /* Hero Section */
    .contact-hero {
        background: #FDF8F4;
        padding: 140px 0 80px;
        position: relative;
        overflow: hidden;
    }

    @media (max-width: 991px) {
        .contact-hero {
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
        margin-bottom: 0;
        line-height: 1.1;
    }

    .hero-content h2 {
        font-family: 'Yellowtail', cursive;
        color: var(--primary-red);
        font-size: 4.5rem;
        font-weight: 400;
        margin-bottom: 30px;
    }

    .hero-content p {
        font-size: 1.1rem;
        color: #666;
        max-width: 500px;
        line-height: 1.8;
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

    /* Section Headers */
    .section-title {
        font-size: 2rem;
        font-weight: 900;
        color: #1a1a1a;
        margin-bottom: 40px;
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

    /* Contact Info */
    .contact-info-list {
        display: flex;
        flex-direction: column;
        gap: 25px;
    }

    .contact-info-item {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 25px;
        background: white;
        border-radius: 30px;
        border: 1px solid #f8f8f8;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
    }

    .contact-info-item:hover {
        border-color: var(--primary-red);
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 20px 40px rgba(163, 13, 17, 0.08);
    }

    .info-icon-circle {
        width: 60px;
        height: 60px;
        background: #FFF5F5;
        color: var(--primary-red);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        flex-shrink: 0;
        transition: 0.3s;
    }

    .contact-info-item:hover .info-icon-circle {
        background: var(--primary-red);
        color: white;
        transform: rotate(10deg);
    }

    .info-text h5 {
        font-weight: 900;
        font-size: 1.05rem;
        margin-bottom: 5px;
        color: #333;
    }

    .info-text p {
        font-size: 0.95rem;
        color: #777;
        margin-bottom: 0;
        font-weight: 500;
    }

    /* Contact Form */
    .contact-form-card {
        background: white;
        padding: 50px;
        border-radius: 40px;
        box-shadow: 0 30px 80px rgba(0,0,0,0.04);
        border: 1px solid #f8f8f8;
    }

    .form-control {
        background: #FDFDFD;
        border: 1.5px solid #f0f0f0;
        padding: 18px 25px;
        border-radius: 20px;
        font-size: 0.95rem;
        font-weight: 600;
        transition: 0.3s;
    }

    .form-control:focus {
        background: white;
        border-color: var(--primary-red);
        box-shadow: 0 10px 25px rgba(163, 13, 17, 0.05);
    }

    .btn-send {
        background: var(--primary-red);
        color: white;
        border: none;
        padding: 20px 40px;
        border-radius: 20px;
        font-weight: 900;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
        transition: all 0.3s ease;
        font-size: 1.1rem;
        letter-spacing: 0.5px;
    }

    .btn-send:hover {
        background: var(--dark-red);
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(163, 13, 17, 0.25);
    }

    /* FAQ Accordion */
    .accordion-item {
        border: none;
        margin-bottom: 20px;
        border-radius: 25px !important;
        overflow: hidden;
        border: 1px solid #f8f8f8;
        box-shadow: 0 5px 15px rgba(0,0,0,0.02);
    }

    .accordion-button {
        padding: 25px 30px;
        font-weight: 800;
        color: #333;
        background: white;
        box-shadow: none !important;
        font-size: 1.05rem;
    }

    .accordion-button:not(.collapsed) {
        background: #FFF9F9;
        color: var(--primary-red);
    }

    .accordion-body {
        padding: 0 30px 30px;
        color: #666;
        font-size: 1rem;
        line-height: 1.8;
    }

    /* Map Box */
    .map-box {
        background: white;
        padding: 20px;
        border-radius: 35px;
        border: 1px solid #f8f8f8;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    }

    .map-img {
        width: 100%;
        border-radius: 25px;
        margin-bottom: 20px;
        height: 250px;
        object-fit: cover;
    }

    .btn-google-maps {
        background: white;
        border: 2px solid #f0f0f0;
        color: #333;
        padding: 12px 25px;
        border-radius: 15px;
        font-size: 0.95rem;
        font-weight: 800;
        display: inline-flex;
        align-items: center;
        gap: 12px;
        text-decoration: none !important;
        transition: 0.3s;
    }

    .btn-google-maps:hover {
        background: #f8f9fa;
        border-color: var(--primary-red);
        color: var(--primary-red);
    }

    /* Red Banner */
    .cta-banner {
        background: var(--primary-red);
        border-radius: 45px;
        padding: 60px;
        margin-top: 100px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 50px rgba(163, 13, 17, 0.2);
    }

    .cta-content {
        display: flex;
        align-items: center;
        gap: 60px;
        color: white;
        position: relative;
        z-index: 2;
    }

    .cta-product-img {
        width: 280px;
        flex-shrink: 0;
        filter: drop-shadow(0 20px 30px rgba(0,0,0,0.2));
    }

    .cta-text h3 {
        font-weight: 900;
        font-size: 2.2rem;
        margin-bottom: 15px;
        line-height: 1.2;
    }

    .cta-text p {
        font-size: 1.2rem;
        opacity: 0.95;
        margin-bottom: 0;
        font-weight: 500;
    }

    .heart-icon {
        color: #FFD700;
        font-size: 1.8rem;
        margin-left: 10px;
        animation: heartBeat 1.5s infinite;
        display: inline-block;
    }

    @keyframes heartBeat {
        0% { transform: scale(1); }
        15% { transform: scale(1.3); }
        30% { transform: scale(1); }
        45% { transform: scale(1.3); }
        70% { transform: scale(1); }
    }

    @media (max-width: 991px) {
        .contact-hero { text-align: center; }
        .hero-content h1 { font-size: 3.5rem; }
        .hero-content h2 { font-size: 3.5rem; }
        .hero-content p { margin: 0 auto 40px; }
        .cta-content { flex-direction: column; text-align: center; gap: 30px; }
        .cta-banner { padding: 40px; }
        .cta-product-img { width: 200px; }
        .contact-form-card { padding: 30px 20px; border-radius: 30px; }
    }
</style>

<div class="contact-page">
    <!-- Hero Section -->
    <section class="contact-hero">
        <i class="fas fa-pepper-hot bg-illustration bg-chili"></i>
        <i class="fas fa-drumstick-bite bg-illustration bg-leg"></i>
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 hero-content">
                    <h1>Hubungi Kami</h1>
                    <h2>Kami Siap Melayani Anda!</h2>
                    <p>Punya pertanyaan, saran, atau ingin bekerja sama? Jangan ragu untuk menghubungi kami melalui saluran informasi di bawah ini.</p>
                </div>
                <div class="col-lg-6 hero-img-wrapper text-center">
                    <img src="https://pngimg.com/uploads/fried_chicken/fried_chicken_PNG14092.png" alt="Fried Chicken" class="hero-img">
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-5 mt-5">
        <div class="container">
            <div class="row g-5">
                <!-- Left: Contact Info -->
                <div class="col-lg-5">
                    <h3 class="section-title">Informasi Kontak</h3>
                    <div class="contact-info-list">
                        <div class="contact-info-item">
                            <div class="info-icon-circle">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="info-text">
                                <h5>Alamat</h5>
                                <p><?= $data['pengaturan']['alamat'] ?? 'Jl. Crispy No. 123, Jakarta Indonesia'; ?></p>
                            </div>
                        </div>
                        <div class="contact-info-item">
                            <div class="info-icon-circle">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div class="info-text">
                                <h5>Telepon / WhatsApp</h5>
                                <p><?= $data['pengaturan']['telepon'] ?? '0812-3456-7890'; ?></p>
                            </div>
                        </div>
                        <div class="contact-info-item">
                            <div class="info-icon-circle">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="info-text">
                                <h5>Email</h5>
                                <p><?= $data['pengaturan']['email'] ?? 'info@gambarfriedchicken.com'; ?></p>
                            </div>
                        </div>
                        <div class="contact-info-item">
                            <div class="info-icon-circle">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="info-text">
                                <h5>Jam Operasional</h5>
                                <p>Setiap Hari 09.00 - 22.00 WIB</p>
                            </div>
                        </div>
                        <div class="contact-info-item">
                            <div class="info-icon-circle">
                                <i class="fab fa-instagram"></i>
                            </div>
                            <div class="info-text">
                                <h5>Instagram</h5>
                                <p>@gambarfriedchicken.id</p>
                            </div>
                        </div>
                        <div class="contact-info-item">
                            <div class="info-icon-circle">
                                <i class="fab fa-facebook-f"></i>
                            </div>
                            <div class="info-text">
                                <h5>Facebook</h5>
                                <p>Gambar Fried Chicken</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Contact Form -->
                <div class="col-lg-7">
                    <div class="contact-form-card">
                        <h3 class="fw-bold mb-4">Kirim Pesan</h3>
                        <form action="#" method="POST">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="Nama Lengkap">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="No. Telepon">
                                </div>
                                <div class="col-12">
                                    <input type="email" class="form-control" placeholder="Email">
                                </div>
                                <div class="col-12">
                                    <input type="text" class="form-control" placeholder="Subjek">
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control" rows="5" placeholder="Pesan Anda"></textarea>
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="button" class="btn-send">
                                        <i class="fas fa-paper-plane"></i> Kirim Pesan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Bottom Section -->
            <div class="row g-5 mt-5">
                <!-- Map -->
                <div class="col-lg-5">
                    <h3 class="section-title">Lokasi Kami</h3>
                    <div class="map-box">
                        <img src="https://www.google.com/maps/vt/pb=!1m4!1m3!1i15!2i26284!3i12484!2m3!1e0!2sm!3i615024765!3m8!2sid!3s0x2e69f436b8c74b27%3A0x62957f4955745145!5m2!1zLTUuMzA0MDAwLCAxMDUuNjQ4MDAw!12m1!1e1!4e0!5m1!5f2!23i1301875?authuser=0" alt="Map Location" class="map-img">
                        <div class="text-center">
                            <a href="#" class="btn-google-maps">
                                <i class="fas fa-external-link-alt text-danger"></i> Lihat di Google Maps
                            </a>
                        </div>
                    </div>
                </div>

                <!-- FAQ -->
                <div class="col-lg-7">
                    <h3 class="section-title">Pertanyaan yang Sering Diajukan</h3>
                    <div class="accordion" id="accordionFAQ">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    Apakah ada layanan pesan antar?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#accordionFAQ">
                                <div class="accordion-body">
                                    Ya, kami menyediakan layanan pesan antar melalui WhatsApp dan aplikasi ojek online favorit Anda.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    Berapa biaya ongkir pengantaran?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                                <div class="accordion-body">
                                    Biaya pengantaran bervariasi tergantung jarak lokasi Anda dari outlet terdekat kami.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    Apakah bisa pesan dalam jumlah besar?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                                <div class="accordion-body">
                                    Tentu saja! Kami melayani pesanan partai besar untuk acara ulang tahun, rapat, atau syukuran. Silakan hubungi WA kami minimal H-1.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                    Metode pembayaran apa saja yang tersedia?
                                </button>
                            </h2>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                                <div class="accordion-body">
                                    Kami menerima pembayaran tunai (Cash), Transfer Bank, dan berbagai E-Wallet (QRIS).
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Red Banner -->
            <div class="cta-banner">
                <div class="cta-content">
                    <img src="https://pngimg.com/uploads/fried_chicken/fried_chicken_PNG14082.png" alt="Ayam Nasi" class="cta-product-img">
                    <div class="cta-text">
                        <h3>Kami selalu siap mendengar dari Anda!</h3>
                        <p>Kepuasan Anda adalah prioritas kami. <i class="fas fa-heart heart-icon"></i></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
