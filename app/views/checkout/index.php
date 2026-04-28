<style>
    :root {
        --primary-red: #A30D11;
        --dark-red: #820A0D;
        --soft-bg: #FDF8F4;
    }

    .checkout-page {
        padding: 140px 0 100px;
        background-color: var(--soft-bg);
        min-height: 100vh;
    }

    @media (max-width: 991px) {
        .checkout-page {
            padding: 100px 0 120px; /* Extra bottom padding for mobile bar */
        }
    }

    /* Progress Stepper */
    .checkout-stepper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 600px;
        margin: 0 auto 50px;
        position: relative;
    }

    .checkout-stepper::before {
        content: '';
        position: absolute;
        top: 25px;
        left: 0;
        width: 100%;
        height: 3px;
        background: #eee;
        z-index: 1;
    }

    .step-item {
        position: relative;
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }

    .step-icon {
        width: 50px;
        height: 50px;
        background: white;
        border: 3px solid #eee;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #888;
        font-weight: 900;
        transition: all 0.4s ease;
    }

    .step-item.active .step-icon {
        background: var(--primary-red);
        border-color: var(--primary-red);
        color: white;
        box-shadow: 0 10px 20px rgba(163, 13, 17, 0.2);
    }

    .step-item.completed .step-icon {
        background: #27ae60;
        border-color: #27ae60;
        color: white;
    }

    .step-label {
        font-size: 0.85rem;
        font-weight: 800;
        color: #888;
        transition: 0.3s;
    }

    .step-item.active .step-label {
        color: var(--primary-red);
    }

    /* Header */
    .page-title-section {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 10px;
    }

    .back-btn-circle {
        width: 45px;
        height: 45px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-red);
        text-decoration: none !important;
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        border: 1px solid #f0f0f0;
    }

    .back-btn-circle:hover {
        background: var(--primary-red);
        color: white;
        transform: translateX(-5px);
    }

    .page-title-section h2 {
        font-weight: 900;
        font-size: 2rem;
        color: #1a1a1a;
        margin: 0;
    }

    /* Checkout Card */
    .checkout-card {
        background: white;
        border-radius: 35px;
        margin-bottom: 30px;
        border: 1px solid #f0f0f0;
        box-shadow: 0 20px 60px rgba(0,0,0,0.03);
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .checkout-card:hover {
        transform: translateY(-2px);
    }

    .checkout-section {
        padding: 40px;
        border-bottom: 1px solid #f8f8f8;
    }

    .section-title-new {
        font-weight: 900;
        font-size: 1.1rem;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 15px;
        color: #1a1a1a;
    }

    .section-icon-box {
        width: 40px;
        height: 40px;
        background: #FFF5F5;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-red);
        font-size: 1rem;
    }

    /* Order Type / Payment Selection */
    .custom-radio-group-horizontal {
        display: grid;
        grid-template-columns: repeat(3, 1fr); /* 3 Kolom untuk Dine-in, Takeaway, Delivery */
        gap: 12px;
    }

    @media (max-width: 576px) {
        .custom-radio-group-horizontal {
            gap: 8px;
        }
    }

    .radio-item-horizontal {
        padding: 20px 15px;
        background: #ffffff;
        border: 1px solid #eee;
        border-radius: 25px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        cursor: pointer;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
        text-align: center;
        position: relative;
    }

    .radio-item-horizontal:hover {
        border-color: var(--primary-red);
        background: #FFF9F9;
        transform: translateY(-3px);
    }

    .radio-item-horizontal.active {
        border-color: var(--primary-red);
        background: white;
        box-shadow: 0 15px 35px rgba(163, 13, 17, 0.1);
        transform: scale(1.05);
    }

    .radio-item-horizontal i {
        font-size: 1.8rem;
        color: #eee;
        transition: 0.4s;
    }

    .radio-item-horizontal.active i {
        color: var(--primary-red);
    }

    .radio-label-new {
        font-weight: 800;
        font-size: 0.9rem;
        color: #444;
    }

    /* Cart Items */
    .cart-item-new {
        display: flex;
        gap: 20px;
        padding: 20px 0;
        border-bottom: 1px solid #f8f8f8;
    }

    .item-img-new {
        width: 90px;
        height: 90px;
        border-radius: 18px;
        object-fit: cover;
    }

    .item-info-new {
        flex: 1;
    }

    .item-info-new h5 {
        font-weight: 900;
        font-size: 1.1rem;
        margin-bottom: 5px;
    }

    .item-price-new {
        font-weight: 800;
        color: var(--primary-red);
        font-size: 1.05rem;
    }

    .qty-control-minimal {
        display: flex;
        align-items: center;
        gap: 12px;
        background: #f8f8f8;
        padding: 5px 12px;
        border-radius: 50px;
    }

    .btn-qty-minimal {
        background: rgba(163, 13, 17, 0.05);
        border: none;
        width: 26px;
        height: 26px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 900;
        color: var(--primary-red);
        transition: all 0.2s ease;
        font-size: 0.7rem;
    }

    .btn-qty-minimal:hover {
        background: var(--primary-red);
        color: white;
        transform: scale(1.1);
    }

    /* Info Table */
    .rincian-table {
        width: 100%;
    }

    .rincian-table td {
        padding: 12px 0;
        font-size: 0.95rem;
        color: #666;
        font-weight: 500;
    }

    .rincian-table td:last-child {
        text-align: right;
        color: #1a1a1a;
        font-weight: 800;
    }

    /* Summary Card */
    .summary-card-new {
        background: linear-gradient(165deg, #ffffff 0%, #fdf9f9 100%);
        border-radius: 35px;
        padding: 35px;
        border: 1px solid #f0f0f0;
        position: sticky;
        top: 140px;
        box-shadow: 0 40px 80px rgba(163, 13, 17, 0.05);
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        font-weight: 600;
        color: #666;
    }

    .summary-total-section {
        margin-top: 25px;
        padding-top: 25px;
        border-top: 2px dashed #eee;
    }

    .total-price-large {
        font-weight: 900;
        color: var(--primary-red);
        font-size: 2.2rem;
        letter-spacing: -1px;
        margin-top: 5px;
    }

    /* Premium Form Styling */
    .form-group-modern {
        margin-bottom: 25px;
        position: relative;
    }

    .form-label-modern {
        font-size: 0.72rem;
        font-weight: 800;
        color: #999;
        letter-spacing: 1px;
        margin-bottom: 10px;
        display: block;
        text-transform: uppercase;
        padding-left: 5px;
    }

    .input-wrapper-modern {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input-wrapper-modern i {
        position: absolute;
        left: 20px;
        color: #ccc;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        z-index: 5;
    }

    .form-control-modern {
        width: 100%;
        background: #F8F9FA !important;
        border: 2px solid transparent !important;
        padding: 16px 20px 16px 52px !important;
        border-radius: 20px !important;
        font-weight: 700 !important;
        font-size: 0.95rem !important;
        color: #333 !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        box-shadow: none !important;
    }

    .form-control-modern:focus {
        background: #ffffff !important;
        border-color: var(--primary-red) !important;
        box-shadow: 0 10px 25px rgba(163, 13, 17, 0.08) !important;
    }

    .form-control-modern:focus + i {
        color: var(--primary-red);
        transform: scale(1.1);
    }

    textarea.form-control-modern {
        padding-top: 18px !important;
    }

    /* Select Styling */
    .select-wrapper-modern {
        position: relative;
        display: flex;
        align-items: center;
    }

    .select-wrapper-modern::after {
        content: '\f078';
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        position: absolute;
        right: 20px;
        color: #888;
        pointer-events: none;
        font-size: 0.8rem;
    }

    .form-select-modern {
        appearance: none;
        width: 100%;
        background: #F8F9FA !important;
        border: 2px solid transparent !important;
        padding: 16px 20px 16px 52px !important;
        border-radius: 20px !important;
        font-weight: 700 !important;
        cursor: pointer;
    }

    /* Modern Clear Button - Ultra Minimalist */
    .btn-clear-cart-premium {
        background: transparent !important;
        border: none !important;
        color: var(--primary-red) !important;
        font-size: 0.8rem !important;
        font-weight: 800 !important;
        padding: 8px 0 !important;
        display: flex !important;
        align-items: center !important;
        gap: 6px !important;
        transition: all 0.3s ease;
        opacity: 0.7;
        cursor: pointer;
        outline: none !important;
        box-shadow: none !important;
    }

    .btn-clear-cart-premium:hover {
        opacity: 1;
        transform: translateX(-3px);
    }

    .btn-clear-cart-premium i {
        font-size: 0.9rem;
    }

    .btn-submit-order {
        width: 100%;
        background: var(--primary-red);
        color: white;
        border: none;
        padding: 20px;
        border-radius: 20px;
        font-weight: 900;
        font-size: 1.1rem;
        margin-top: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 10px 25px rgba(163, 13, 17, 0.25);
    }

    .btn-submit-order:hover {
        transform: translateY(-5px);
        background: var(--dark-red);
    }

    /* Mobile Footer Bar */
    .mobile-checkout-footer {
        display: none;
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background: white;
        padding: 15px 25px;
        box-shadow: 0 -10px 30px rgba(0,0,0,0.05);
        z-index: 1060;
        border-radius: 30px 30px 0 0;
    }

    @media (max-width: 991px) {
        .mobile-checkout-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .summary-card-new {
            display: none; /* Hide main summary on mobile, use floating footer */
        }

        .checkout-section {
            padding: 30px 20px;
        }
    }

    .mobile-total-box {
        display: flex;
        flex-direction: column;
    }

    .mobile-total-label {
        font-size: 0.75rem;
        font-weight: 700;
        color: #888;
        text-transform: uppercase;
    }

    .mobile-total-price {
        font-size: 1.2rem;
        font-weight: 900;
        color: var(--primary-red);
    }

    .btn-submit-mobile {
        background: var(--primary-red);
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 15px;
        font-weight: 800;
        font-size: 0.95rem;
    }

    /* Trust Items */
    .trust-section {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-top: 50px;
    }

    .trust-item {
        background: white;
        padding: 25px;
        border-radius: 25px;
        text-align: center;
        border: 1px solid #f8f8f8;
        transition: 0.3s;
    }

    .trust-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.03);
    }

    .trust-item i {
        font-size: 1.8rem;
        color: var(--primary-red);
        margin-bottom: 15px;
    }

    .trust-item h6 {
        font-weight: 900;
        font-size: 0.9rem;
        margin-bottom: 5px;
    }

    .trust-item p {
        font-size: 0.75rem;
        color: #888;
        margin: 0;
    }

    @media (max-width: 768px) {
        .trust-section {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>

<div class="checkout-page">
    <div class="container">
        <!-- Progress Stepper -->
        <div class="checkout-stepper">
            <div class="step-item completed">
                <div class="step-icon"><i class="fas fa-check"></i></div>
                <span class="step-label">Keranjang</span>
            </div>
            <div class="step-item active">
                <div class="step-icon">2</div>
                <span class="step-label">Konfirmasi</span>
            </div>
            <div class="step-item">
                <div class="step-icon">3</div>
                <span class="step-label">Pembayaran</span>
            </div>
        </div>

        <!-- Header -->
        <div class="page-title-section">
            <a href="<?= BASEURL; ?>/menu" class="back-btn-circle">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h2>Checkout</h2>
        </div>
        <p class="text-muted mb-4 ms-2 small fw-500">Periksa kembali detail pesanan Anda sebelum melakukan pembayaran</p>

        <div id="checkoutMainRow" class="row g-4" style="display:none;">
            <div class="col-lg-8">
                <div class="checkout-card">
                    <!-- 1. Menu List -->
                    <div class="checkout-section">
                        <div class="section-title-new d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-2">
                                <div class="section-icon-box"><i class="fas fa-shopping-basket"></i></div>
                                <span>Menu yang Dipesan</span>
                            </div>
                            <button class="btn-clear-cart-premium" onclick="clearCart()">
                                <i class="fas fa-trash-alt"></i> Bersihkan
                            </button>
                        </div>
                        <div id="cartItemsContainer">
                            <!-- JS Generated -->
                        </div>
                    </div>

                    <!-- 2. Order Type -->
                    <div class="checkout-section">
                        <div class="section-title-new">
                            <div class="section-icon-box"><i class="fas fa-utensils"></i></div>
                            <span>Pilih Cara Makan</span>
                        </div>
                        <div class="custom-radio-group-horizontal" id="orderTypeOptions">
                            <div class="radio-item-horizontal active" data-type="dine-in">
                                <i class="fas fa-chair"></i>
                                <span class="radio-label-new">Dine In</span>
                            </div>
                            <div class="radio-item-horizontal" data-type="takeaway">
                                <i class="fas fa-shopping-bag"></i>
                                <span class="radio-label-new">Takeaway</span>
                            </div>
                            <div class="radio-item-horizontal" data-type="delivery">
                                <i class="fas fa-motorcycle"></i>
                                <span class="radio-label-new">Delivery</span>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Payment Method -->
                    <div class="checkout-section">
                        <div class="section-title-new">
                            <div class="section-icon-box"><i class="fas fa-credit-card"></i></div>
                            <span>Metode Pembayaran</span>
                        </div>
                        <div class="custom-radio-group-horizontal" id="paymentMethodOptions">
                            <?php if(!empty($data['metode_pembayaran'])): ?>
                                <?php foreach($data['metode_pembayaran'] as $index => $m): ?>
                                    <div class="radio-item-horizontal <?= $index === 0 ? 'active' : ''; ?>" data-method="<?= $m['nama_metode']; ?>">
                                        <?php 
                                            $icon = 'fa-money-bill-wave';
                                            if($m['tipe'] == 'qris') $icon = 'fa-qrcode';
                                            if($m['tipe'] == 'transfer') $icon = 'fa-university';
                                            if($m['tipe'] == 'ewallet') $icon = 'fa-wallet';
                                        ?>
                                        <i class="fas <?= $icon; ?>"></i>
                                        <span class="radio-label-new"><?= $m['nama_metode']; ?></span>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="col-12 text-center p-3 bg-light rounded-4">
                                    <p class="small text-muted mb-0">Maaf, belum ada metode pembayaran aktif.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- 4. Dine In Details -->
                    <div id="dineInFields" class="checkout-section">
                        <div class="section-title-new">
                            <div class="section-icon-box"><i class="fas fa-hashtag"></i></div>
                            <span>Pilih Nomor Meja</span>
                        </div>
                        <div class="form-group-modern">
                            <label class="form-label-modern">NOMOR MEJA ANDA</label>
                            <div class="select-wrapper-modern">
                                <i class="fas fa-chair" style="position: absolute; left: 20px; color: #ccc;"></i>
                                <select class="form-select-modern" id="mejaSelect">
                                    <option value="">-- Pilih Nomor Meja --</option>
                                    <?php foreach($data['meja'] as $m): ?>
                                        <option value="<?= $m['id']; ?>" <?= ($m['status'] == 'terpakai') ? 'disabled style="color: #ccc; background: #f8f8f8;"' : ''; ?>>
                                            Meja Nomor <?= $m['nomor_meja']; ?> <?= ($m['status'] == 'terpakai') ? ' — (Berisi)' : ''; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- 5. Delivery Details -->
                        <div id="deliveryDetailFields" class="checkout-section" style="display:none;">
                            <div class="section-title-new">
                                <div class="section-icon-box" id="deliveryIconBox"><i class="fas fa-map-marker-alt"></i></div>
                                <span id="deliveryTitleSpan">Detail Pemesan</span>
                            </div>
                            
                            <div id="mapSection">
                                <div id="mapContainer" style="height: 250px; border-radius: 20px; margin-bottom: 20px; border: 1px solid #eee;"></div>
                                <button type="button" class="btn btn-outline-danger w-100 mb-4 fw-bold" id="btnAutoLoc" style="border-radius: 15px;">
                                    <i class="fas fa-location-arrow me-2"></i> Gunakan Lokasi Saat Ini
                                </button>
                            </div>
                            
                            <div class="row g-3">
                                <div class="col-12" id="addressSection">
                                    <div class="form-group-modern">
                                        <label class="form-label-modern">ALAMAT LENGKAP PENGIRIMAN</label>
                                        <div class="input-wrapper-modern">
                                            <textarea class="form-control-modern" id="deliveryAddress" rows="3" placeholder="Tulis alamat lengkap..."></textarea>
                                            <i class="fas fa-map-marked-alt" style="top: 20px;"></i>
                                        </div>
                                    </div>
                                </div>
                            <div class="col-md-6" id="nameSection">
                                <div class="form-group-modern">
                                    <label class="form-label-modern" id="nameLabel">NAMA PENERIMA</label>
                                    <div class="input-wrapper-modern">
                                        <input type="text" class="form-control-modern" id="customerName" placeholder="Nama Anda">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" id="phoneSection">
                                <div class="form-group-modern">
                                    <label class="form-label-modern">NOMOR WHATSAPP</label>
                                    <div class="input-wrapper-modern">
                                        <input type="text" class="form-control-modern" id="customerPhone" placeholder="08xxxx">
                                        <i class="fab fa-whatsapp"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 6. Note -->
                    <div class="checkout-section border-0">
                        <div class="section-title-new">
                            <div class="section-icon-box"><i class="fas fa-sticky-note"></i></div>
                            <span>Catatan Pesanan (Opsional)</span>
                        </div>
                        <div class="form-group-modern">
                            <label class="form-label-modern">INSTRUKSI KHUSUS</label>
                            <div class="input-wrapper-modern">
                                <textarea class="form-control-modern" id="orderNote" rows="2" placeholder="Contoh: Sambal dipisah ya..."></textarea>
                                <i class="fas fa-comment-dots" style="top: 20px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar (Desktop) -->
            <div class="col-lg-4">
                <div class="summary-card-new">
                    <h5 class="fw-900 mb-4">Ringkasan Pembayaran</h5>
                    
                    <div class="summary-row">
                        <span>Total Harga Menu</span>
                        <span id="summarySubtotalRight">Rp 0</span>
                    </div>
                    
                    <div id="deliveryFeeWrapper" style="display:none;">
                        <div class="summary-row">
                            <span>Ongkos Kirim</span>
                            <span class="text-success fw-bold" id="deliveryFeeText">Rp <?= number_format($data['pengaturan']['ongkir_per_km'] ?? 0, 0, ',', '.'); ?></span>
                        </div>
                    </div>

                    <div class="summary-total-section">
                        <span class="fw-bold text-muted small">TOTAL PEMBAYARAN</span>
                        <div class="total-price-large" id="summaryTotalPrice">Rp 0</div>
                    </div>

                    <div class="p-3 bg-light rounded-4 mt-4 mb-2 d-flex gap-3 align-items-center">
                        <div class="text-danger fs-3"><i class="fas fa-shield-alt"></i></div>
                        <div class="small fw-600 text-muted">Pembayaran Anda terenkripsi dan aman 100%.</div>
                    </div>

                    <button class="btn-submit-order" onclick="submitOrder()">
                        <i class="fas fa-check-circle"></i> Buat Pesanan Sekarang
                    </button>
                </div>
            </div>
        </div>

        <!-- Empty Cart -->
        <div id="emptyCartWrapper" style="display:none;">
            <div class="text-center py-5">
                <img src="https://illustrations.popsy.co/amber/shopping-cart.svg" alt="Empty" style="width: 280px;" class="mb-4">
                <h3 class="fw-900">Keranjang Anda Kosong</h3>
                <p class="text-muted">Sepertinya Anda belum memilih menu lezat kami.</p>
                <a href="<?= BASEURL; ?>/menu" class="btn btn-danger px-5 py-3 mt-3 fw-bold rounded-pill">Lihat Menu Sekarang</a>
            </div>
        </div>

        <!-- Trust Section -->
        <div class="trust-section">
            <div class="trust-item">
                <i class="fas fa-clock"></i>
                <h6>Cepat Sampai</h6>
                <p>Estimasi 15-20 menit</p>
            </div>
            <div class="trust-item">
                <i class="fas fa-utensils"></i>
                <h6>Higienis</h6>
                <p>Bahan segar pilihan</p>
            </div>
            <div class="trust-item">
                <i class="fas fa-wallet"></i>
                <h6>Hemat</h6>
                <p>Harga paling bersahabat</p>
            </div>
            <div class="trust-item">
                <i class="fas fa-smile"></i>
                <h6>Puas</h6>
                <p>Layanan sepenuh hati</p>
            </div>
        </div>
    </div>
</div>

<!-- Mobile Floating Footer -->
<div class="mobile-checkout-footer">
    <div class="mobile-total-box">
        <span class="mobile-total-label">Total Pembayaran</span>
        <span class="mobile-total-price" id="summaryTotalPriceMobile">Rp 0</span>
    </div>
    <button class="btn-submit-mobile" onclick="submitOrder()">
        Pesan Sekarang <i class="fas fa-chevron-right ms-1 small"></i>
    </button>
</div>

<form id="orderForm" action="<?= BASEURL; ?>/checkout/proses" method="POST" style="display:none;">
    <input type="hidden" name="cart_data" id="cartDataInput">
    <input type="hidden" name="meja_id" id="mejaIdInput">
    <input type="hidden" name="tipe_pesanan" id="tipePesananInput">
    <input type="hidden" name="nama_pelanggan" id="namaPelangganInput">
    <input type="hidden" name="no_telp" id="noTelpInput">
    <input type="hidden" name="alamat_pengantaran" id="alamatInput">
    <input type="hidden" name="lat" id="latInput">
    <input type="hidden" name="lng" id="lngInput">
    <input type="hidden" name="metode_bayar" id="metodeBayarInput">
    <input type="hidden" name="catatan" id="catatanInput">
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let cart = JSON.parse(localStorage.getItem('dkriuk_cart')) || [];
        const itemsContainer = document.getElementById('cartItemsContainer');
        const mainRow = document.getElementById('checkoutMainRow');
        const emptyWrapper = document.getElementById('emptyCartWrapper');
        
        let selectedType = 'dine-in';
        // Ambil metode pembayaran aktif pertama sebagai default
        const activeMethod = document.querySelector('#paymentMethodOptions .radio-item-horizontal.active');
        let selectedMethod = activeMethod ? activeMethod.getAttribute('data-method') : 'cash';

        function renderCart() {
            cart = JSON.parse(localStorage.getItem('dkriuk_cart')) || [];
            
            if (cart.length === 0) {
                mainRow.style.display = 'none';
                emptyWrapper.style.display = 'block';
                return;
            }

            mainRow.style.display = 'flex';
            emptyWrapper.style.display = 'none';

            let itemsHtml = '';
            let subtotal = 0;
            let totalQty = 0;

            cart.forEach((item, index) => {
                const harga = Number(item.harga) || 0;
                const qty = Number(item.qty) || 0;
                subtotal += (harga * qty);
                totalQty += qty;
                
                itemsHtml += `
                    <div class="cart-item-new">
                        <img src="<?= BASEURL; ?>/assets/img/produk/${item.foto}" class="item-img-new" onerror="this.src='https://placehold.co/200x200?text=Menu+DKriuk'">
                        <div class="item-info-new">
                            <h5 class="mb-1">${item.nama}</h5>
                            <div class="item-price-new mb-2">Rp ${harga.toLocaleString('id-ID')}</div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="qty-control-minimal">
                                    <button class="btn-qty-minimal" onclick="updateQty(${index}, -1)"><i class="fas fa-minus"></i></button>
                                    <span class="mx-2 fw-bold small">${qty}</span>
                                    <button class="btn-qty-minimal" onclick="updateQty(${index}, 1)"><i class="fas fa-plus"></i></button>
                                </div>
                                <button class="btn btn-sm text-muted" onclick="removeItem(${index})"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>
                    </div>
                `;
            });

            itemsContainer.innerHTML = itemsHtml;
            updateTotals(subtotal);
        }

        function updateTotals(subtotal) {
            const deliveryFeeWrapper = document.getElementById('deliveryFeeWrapper');
            const summarySubtotalRight = document.getElementById('summarySubtotalRight');
            const summaryTotalPrice = document.getElementById('summaryTotalPrice');
            const summaryTotalPriceMobile = document.getElementById('summaryTotalPriceMobile');
            const deliveryFeeText = document.getElementById('deliveryFeeText');

            summarySubtotalRight.textContent = 'Rp ' + subtotal.toLocaleString('id-ID');

            let total = subtotal;
            if (selectedType === 'delivery') {
                const ongkir = <?= $data['pengaturan']['ongkir_per_km'] ?? 0; ?>;
                deliveryFeeWrapper.style.display = 'flex';
                deliveryFeeText.textContent = 'Rp ' + ongkir.toLocaleString('id-ID');
                total += parseInt(ongkir);
            } else {
                deliveryFeeWrapper.style.display = 'none';
            }

            summaryTotalPrice.textContent = 'Rp ' + total.toLocaleString('id-ID');
            summaryTotalPriceMobile.textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        // --- RADIO LISTENERS ---
        const typeOptions = document.querySelectorAll('#orderTypeOptions .radio-item-horizontal');
        const deliveryDetailFields = document.getElementById('deliveryDetailFields');
        const dineInFields = document.getElementById('dineInFields');

        typeOptions.forEach(opt => {
            opt.addEventListener('click', function() {
                typeOptions.forEach(o => o.classList.remove('active'));
                this.classList.add('active');
                selectedType = this.getAttribute('data-type');

                if (selectedType === 'delivery') {
                    deliveryDetailFields.style.display = 'block';
                    document.getElementById('mapSection').style.display = 'block';
                    document.getElementById('addressSection').style.display = 'block';
                    document.getElementById('phoneSection').style.display = 'block';
                    document.getElementById('nameSection').className = 'col-md-6';
                    document.getElementById('nameLabel').textContent = 'NAMA PENERIMA';
                    document.getElementById('deliveryTitleSpan').textContent = 'Detail Pengiriman';
                    document.getElementById('deliveryIconBox').innerHTML = '<i class="fas fa-map-marker-alt"></i>';
                    
                    if(dineInFields) dineInFields.style.display = 'none';
                    setTimeout(() => { if(!map) initMap(); if(map) map.invalidateSize(); }, 300);
                } else if (selectedType === 'takeaway') {
                    deliveryDetailFields.style.display = 'block';
                    document.getElementById('mapSection').style.display = 'none';
                    document.getElementById('addressSection').style.display = 'none';
                    document.getElementById('phoneSection').style.display = 'none';
                    document.getElementById('nameSection').className = 'col-12';
                    document.getElementById('nameLabel').textContent = 'ATAS NAMA PESANAN';
                    document.getElementById('deliveryTitleSpan').textContent = 'Detail Pemesan';
                    document.getElementById('deliveryIconBox').innerHTML = '<i class="fas fa-user"></i>';
                    
                    if(dineInFields) dineInFields.style.display = 'none';
                } else {
                    deliveryDetailFields.style.display = 'none';
                    if(dineInFields) dineInFields.style.display = 'block';
                }
                
                let subtotal = 0;
                cart.forEach(item => { subtotal += (item.harga * item.qty); });
                updateTotals(subtotal);
            });
        });

        const methodOptions = document.querySelectorAll('#paymentMethodOptions .radio-item-horizontal');
        methodOptions.forEach(opt => {
            opt.addEventListener('click', function() {
                methodOptions.forEach(o => o.classList.remove('active'));
                this.classList.add('active');
                selectedMethod = this.getAttribute('data-method');
            });
        });

        window.updateQty = function(index, delta) {
            cart[index].qty += delta;
            if (cart[index].qty < 1) cart[index].qty = 1;
            localStorage.setItem('dkriuk_cart', JSON.stringify(cart));
            renderCart();
        };

        window.removeItem = function(index) {
            Swal.fire({
                title: 'Hapus Item?',
                text: "Menu ini akan dihapus dari keranjang",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A30D11',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    cart.splice(index, 1);
                    localStorage.setItem('dkriuk_cart', JSON.stringify(cart));
                    renderCart();
                }
            });
        };

        window.clearCart = function() {
            Swal.fire({
                title: 'Bersihkan Keranjang?',
                text: "Semua menu pilihan Anda akan dihapus",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A30D11',
                confirmButtonText: 'Ya, Bersihkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    cart = [];
                    localStorage.setItem('dkriuk_cart', JSON.stringify(cart));
                    renderCart();
                }
            });
        };

        window.submitOrder = function() {
            if (selectedType === 'dine-in') {
                const mejaId = document.getElementById('mejaSelect').value;
                if (!mejaId) {
                    Swal.fire('Opps!', 'Silakan pilih nomor meja Anda.', 'warning');
                    return;
                }
                document.getElementById('mejaIdInput').value = mejaId;
            } else if (selectedType === 'delivery') {
                const address = document.getElementById('deliveryAddress').value;
                const name = document.getElementById('customerName').value;
                const phone = document.getElementById('customerPhone').value;
                if (!address || !name || !phone) {
                    Swal.fire('Opps!', 'Lengkapi detail pengiriman Anda.', 'warning');
                    return;
                }
                document.getElementById('alamatInput').value = address;
                document.getElementById('namaPelangganInput').value = name;
                document.getElementById('noTelpInput').value = phone;
                document.getElementById('latInput').value = marker ? marker.getLatLng().lat : '';
                document.getElementById('lngInput').value = marker ? marker.getLatLng().lng : '';
            } else if (selectedType === 'takeaway') {
                const name = document.getElementById('customerName').value;
                if (!name) {
                    Swal.fire('Opps!', 'Silakan masukkan nama Anda untuk pesanan ini.', 'warning');
                    return;
                }
                document.getElementById('namaPelangganInput').value = name;
                document.getElementById('noTelpInput').value = ''; // Takeaway tidak perlu WA
                document.getElementById('alamatInput').value = '';
            }

            document.getElementById('cartDataInput').value = JSON.stringify(cart);
            document.getElementById('tipePesananInput').value = selectedType;
            document.getElementById('metodeBayarInput').value = selectedMethod;
            document.getElementById('catatanInput').value = document.getElementById('orderNote').value;

            Swal.fire({
                title: 'Konfirmasi Pesanan?',
                text: "Pesanan akan segera kami proses setelah konfirmasi.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#A30D11',
                confirmButtonText: 'Ya, Pesan Sekarang!',
                cancelButtonText: 'Cek Kembali'
            }).then((result) => {
                if (result.isConfirmed) {
                    localStorage.removeItem('dkriuk_cart');
                    document.getElementById('orderForm').submit();
                }
            });
        };

        // --- GEOLOCATION ---
        const btnAutoLoc = document.getElementById('btnAutoLoc');
        if (btnAutoLoc) {
            btnAutoLoc.addEventListener('click', function() {
                if (navigator.geolocation) {
                    Swal.fire({
                        title: 'Mencari Lokasi...',
                        text: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        didOpen: () => { Swal.showLoading(); }
                    });

                    navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;
                        const latlng = [lat, lng];
                        
                        if (marker) marker.setLatLng(latlng);
                        if (map) map.setView(latlng, 16);
                        
                        // Reverse Geocode
                        fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                            .then(response => response.json())
                            .then(data => {
                                if (data.display_name) {
                                    document.getElementById('deliveryAddress').value = data.display_name;
                                }
                                Swal.close();
                            })
                            .catch(() => { Swal.close(); });
                    }, function(error) {
                        Swal.fire('Gagal', 'Tidak dapat mengambil lokasi Anda. Pastikan izin lokasi (GPS) sudah diaktifkan di browser/HP Anda.', 'error');
                    });
                } else {
                    Swal.fire('Gagal', 'Browser Anda tidak mendukung Geolocation.', 'error');
                }
            });
        }

        renderCart();
    });

    // --- LEAFLET MAP ---
    let map, marker;
    function initMap() {
        if (map) return;
        map = L.map('mapContainer').setView([-6.200000, 106.816666], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        marker = L.marker([-6.200000, 106.816666], {draggable: true}).addTo(map);
        
        map.on('click', function(e) {
            marker.setLatLng(e.latlng);
            reverseGeocode(e.latlng.lat, e.latlng.lng);
        });

        marker.on('dragend', function() {
            const pos = marker.getLatLng();
            reverseGeocode(pos.lat, pos.lng);
        });
    }

    function reverseGeocode(lat, lng) {
        fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
            .then(response => response.json())
            .then(data => {
                if (data.display_name) {
                    document.getElementById('deliveryAddress').value = data.display_name;
                }
            })
            .catch(err => console.error(err));
    }
</script>
