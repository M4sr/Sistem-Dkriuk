<style>
    :root {
        --primary-red: #A30D11;
        --dark-red: #820A0D;
        --soft-bg: #FDF8F4;
    }

    .payment-page {
        padding: 120px 0 100px;
        background-color: var(--soft-bg);
        min-height: 100vh;
    }

    @media (max-width: 991px) {
        .payment-page {
            padding: 100px 0 80px;
        }
    }

    /* Success Hero */
    .success-hero {
        text-align: center;
        margin-bottom: 50px;
        position: relative;
    }

    .success-icon-box {
        width: 90px;
        height: 90px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px;
        box-shadow: 0 15px 35px rgba(40, 167, 69, 0.15);
        color: #27ae60;
        font-size: 2.5rem;
        position: relative;
    }

    .success-icon-box::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        border: 2px solid #27ae60;
        border-radius: 50%;
        animation: success-pulse 2s infinite;
    }

    @keyframes success-pulse {
        0% {
            transform: scale(1);
            opacity: 0.8;
        }

        100% {
            transform: scale(1.5);
            opacity: 0;
        }
    }

    .success-hero h2 {
        font-weight: 900;
        color: #1a1a1a;
        margin-bottom: 10px;
        font-size: 2.2rem;
    }

    .order-code-pill {
        display: inline-block;
        background: white;
        padding: 12px 30px;
        border-radius: 50px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
        border: 1px solid #f0f0f0;
        margin-top: 15px;
    }

    .order-code-pill span {
        font-size: 0.75rem;
        font-weight: 700;
        color: #888;
        text-transform: uppercase;
        letter-spacing: 1px;
        display: block;
    }

    .order-code-pill strong {
        font-size: 1.8rem;
        font-weight: 900;
        color: var(--primary-red);
        display: block;
        margin-top: 2px;
    }

    /* Countdown Panel */
    .timer-panel {
        background: linear-gradient(135deg, #1a1a1a 0%, #333 100%);
        border-radius: 25px;
        padding: 30px;
        color: white;
        text-align: center;
        margin-bottom: 30px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
    }

    .timer-panel::after {
        content: '\f252';
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        position: absolute;
        right: -20px;
        bottom: -20px;
        font-size: 8rem;
        opacity: 0.05;
        transform: rotate(-15deg);
    }

    .timer-label {
        font-size: 0.85rem;
        font-weight: 600;
        opacity: 0.7;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 15px;
        display: block;
    }

    #paymentTimer {
        font-size: 3rem;
        font-weight: 900;
        font-family: 'Courier New', Courier, monospace;
        letter-spacing: 4px;
        display: block;
    }

    /* Payment Cards */
    .payment-card {
        background: white;
        border-radius: 35px;
        padding: 40px;
        height: 100%;
        border: 1px solid #f0f0f0;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.03);
    }

    .card-title-premium {
        font-weight: 900;
        font-size: 1.2rem;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .title-icon-box {
        width: 45px;
        height: 45px;
        background: #FFF5F5;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-red);
    }

    /* Bank Account UI */
    .bank-ui-card {
        background: #f8f9fa;
        border-radius: 25px;
        padding: 25px;
        border: 1px solid #eee;
        position: relative;
    }

    .bank-logo {
        font-weight: 900;
        font-size: 1.4rem;
        color: #1a1a1a;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .acc-number-box {
        background: white;
        padding: 15px 20px;
        border-radius: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        border: 1px solid #eee;
    }

    .acc-number {
        font-size: 1.4rem;
        font-weight: 800;
        color: var(--primary-red);
        letter-spacing: 1px;
    }

    .btn-copy {
        background: #FFF5F5;
        color: var(--primary-red);
        border: none;
        padding: 8px 15px;
        border-radius: 10px;
        font-size: 0.75rem;
        font-weight: 800;
        transition: 0.3s;
    }

    .btn-copy:hover {
        background: var(--primary-red);
        color: white;
    }

    /* QRIS UI */
    .qris-ui-box {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 20px 0;
    }

    .qris-frame {
        width: 260px;
        height: 260px;
        background: white;
        margin: 0 auto 30px;
        border-radius: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        box-shadow: 0 15px 45px rgba(0, 0, 0, 0.06);
        border: 1px solid #f0f0f0;
    }

    .qris-img {
        width: 220px;
        height: 220px;
        object-fit: contain;
    }

    /* Tracker UI */
    .tracker-card {
        background: white;
        border-radius: 35px;
        padding: 40px;
        margin-top: 30px;
        border: 1px solid #f0f0f0;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.03);
    }

    .tracker-steps {
        display: flex;
        justify-content: space-between;
        margin-top: 40px;
        position: relative;
    }

    .tracker-line {
        position: absolute;
        top: 25px;
        left: 50px;
        right: 50px;
        height: 4px;
        background: #eee;
        z-index: 1;
    }

    .tracker-line-progress {
        position: absolute;
        top: 0;
        left: 0;
        width: 25%;
        /* Based on status */
        height: 100%;
        background: var(--primary-red);
        transition: width 1s ease;
    }

    .step-node {
        position: relative;
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
        width: 100px;
    }

    .node-circle {
        width: 55px;
        height: 55px;
        background: white;
        border: 4px solid #eee;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        color: #ccc;
        transition: all 0.5s ease;
    }

    .step-node.active .node-circle {
        border-color: var(--primary-red);
        color: var(--primary-red);
        background: #FFF5F5;
        box-shadow: 0 0 20px rgba(163, 13, 17, 0.2);
        animation: node-pulse 2s infinite;
    }

    .step-node.completed .node-circle {
        background: var(--primary-red);
        border-color: var(--primary-red);
        color: white;
    }

    @keyframes node-pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(163, 13, 17, 0.4);
        }

        70% {
            box-shadow: 0 0 0 15px rgba(163, 13, 17, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(163, 13, 17, 0);
        }
    }

    .node-label {
        font-size: 0.8rem;
        font-weight: 800;
        color: #888;
        text-align: center;
    }

    .step-node.active .node-label {
        color: var(--primary-red);
    }

    /* Proof Upload */
    .upload-section {
        background: #FFF9F9;
        border: 2px dashed #FFDada;
        border-radius: 25px;
        padding: 30px;
        text-align: center;
        margin-top: 30px;
        transition: 0.3s;
    }

    .upload-section:hover {
        border-color: var(--primary-red);
        background: #FFF5F5;
    }

    /* Summary Details */
    .summary-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        font-weight: 600;
        color: #666;
    }

    .summary-total-large {
        margin-top: 20px;
        padding-top: 20px;
        border-top: 2px dashed #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .total-price-premium {
        font-size: 1.8rem;
        font-weight: 900;
        color: var(--primary-red);
    }

    /* Payment Steps */
    .payment-steps {
        background: #fdfdfd;
        border-radius: 15px;
        padding: 20px;
        border: 1px solid #f0f0f0;
    }

    .step-item {
        display: flex;
        gap: 15px;
        margin-bottom: 15px;
        align-items: flex-start;
    }

    .step-item:last-child {
        margin-bottom: 0;
    }

    .step-number {
        width: 24px;
        height: 24px;
        background: var(--primary-red);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        font-weight: 900;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .step-text {
        font-size: 0.85rem;
        color: #444;
        line-height: 1.5;
        font-weight: 600;
    }

    .step-text b {
        color: var(--primary-red);
    }

    /* Action Grid */
    .action-grid-premium {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        margin-top: 40px;
    }

    .btn-payment-action {
        padding: 16px 15px;
        border-radius: 20px;
        font-weight: 900;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: all 0.3s ease;
        text-decoration: none;
        font-size: 0.9rem;
    }

    @media (max-width: 576px) {
        .action-grid-premium {
            gap: 8px;
        }

        .btn-payment-action {
            padding: 14px 8px;
            font-size: 0.75rem;
            gap: 6px;
        }

        .btn-payment-action i {
            font-size: 0.85rem;
        }
    }

    .btn-secondary-outline {
        border: 2px solid #eee;
        color: #555;
    }

    .btn-primary-red {
        background: var(--primary-red);
        color: white;
        box-shadow: 0 10px 25px rgba(163, 13, 17, 0.2);
    }

    .btn-payment-action:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }

    @media (max-width: 768px) {
        .tracker-line {
            left: 30px;
            right: 30px;
        }

        .step-node {
            width: 70px;
        }

        .node-circle {
            width: 45px;
            height: 45px;
            font-size: 1.1rem;
        }

        .node-label {
            font-size: 0.7rem;
        }
    }
    /* Digital Ticket */
    .digital-ticket-wrapper {
        max-width: 500px;
        margin: 0 auto 50px;
    }

    .ticket-card-premium {
        background: white;
        border-radius: 30px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0,0,0,0.08);
        border: 1px solid #f0f0f0;
        position: relative;
    }

    .ticket-top {
        background: var(--primary-red);
        padding: 20px;
        color: white;
        text-align: center;
        position: relative;
    }

    .ticket-top::after {
        content: '';
        position: absolute;
        bottom: -15px;
        left: 0;
        right: 0;
        height: 30px;
        background: white;
        border-radius: 50% 50% 0 0;
    }

    .ticket-title {
        font-weight: 900;
        font-size: 0.9rem;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .ticket-body-new {
        padding: 40px 30px;
        text-align: center;
        background-image: radial-gradient(#f0f0f0 1.5px, transparent 0);
        background-size: 20px 20px;
    }

    .qr-box-premium {
        width: 180px;
        height: 180px;
        background: white;
        margin: 0 auto 25px;
        padding: 15px;
        border-radius: 25px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        border: 1px solid #f8f8f8;
    }

    .qr-img-premium {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .ticket-code-big {
        font-size: 2.2rem;
        font-weight: 900;
        color: #1a1a1a;
        margin-bottom: 5px;
        letter-spacing: 2px;
    }

    .ticket-customer-name {
        font-size: 1.1rem;
        font-weight: 700;
        color: #666;
        margin-bottom: 15px;
    }

    .ticket-footer-dashed {
        border-top: 2px dashed #eee;
        padding: 25px 30px;
        background: #fafafa;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
    }

    /* Cutouts for ticket look */
    .ticket-footer-dashed::before,
    .ticket-footer-dashed::after {
        content: '';
        position: absolute;
        top: -15px;
        width: 30px;
        height: 30px;
        background: var(--soft-bg);
        border-radius: 50%;
    }

    .ticket-footer-dashed::before { left: -15px; }
    .ticket-footer-dashed::after { right: -15px; }

    .ticket-info-pill {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .info-label {
        font-size: 0.7rem;
        font-weight: 800;
        color: #999;
        text-transform: uppercase;
    }

    .info-value {
        font-size: 0.9rem;
        font-weight: 900;
        color: #333;
    }

    .btn-print-ticket {
        background: white;
        border: 2px solid #eee;
        padding: 10px 20px;
        border-radius: 15px;
        font-weight: 800;
        font-size: 0.85rem;
        color: #555;
        transition: 0.3s;
        width: 100%;
        margin-top: 20px;
    }

    .btn-print-ticket:hover {
        background: #f8f8f8;
        border-color: #ddd;
    }

    @media print {
        .navbar, .mobile-top-header, .bottom-nav, footer, #footer, .timer-panel, .tracker-card, .action-grid-premium, .support-section, .footer, .btn-print-ticket, .upload-section {
            display: none !important;
        }
        .payment-page { padding: 0; background: white; }
        .digital-ticket-wrapper { max-width: 100%; margin: 0; }
        .ticket-card-premium { box-shadow: none; border: 1px solid #ccc; }
    }
</style>

<div class="payment-page">
    <div class="container">
        <?php Flasher::flash(); ?>
        <!-- Hero -->
        <div class="success-hero">
            <div class="success-icon-box">
                <i class="fas fa-check"></i>
            </div>
            <h2>Pesanan Terkirim!</h2>
            <p class="text-muted">Yeay! Pesanan Anda sudah masuk ke dapur kami. <br> Selesaikan pembayaran untuk
                memproses lebih cepat.</p>

            <div class="order-code-pill d-none"> <!-- Hidden as we use ticket below -->
                <span>NOMOR PESANAN ANDA</span>
                <strong><?= $data['pesanan']['kode_pesanan']; ?></strong>
            </div>
        </div>

        <!-- Digital Ticket Section -->
        <div class="digital-ticket-wrapper">
            <div class="ticket-card-premium">
                <div class="ticket-top">
                    <div class="ticket-title">TIKET PESANAN DKRIUK</div>
                </div>
                <div class="ticket-body-new">
                    <div class="qr-box-premium">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=<?= $data['pesanan']['kode_pesanan']; ?>" 
                             class="qr-img-premium" alt="Order QR">
                    </div>
                    <div class="ticket-code-big"><?= $data['pesanan']['kode_pesanan']; ?></div>
                    <div class="ticket-customer-name"><?= $data['pesanan']['nama_pelanggan'] ?: 'Pelanggan Setia'; ?></div>
                    
                    <div class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-4 py-2 fw-800">
                        <i class="fas fa-info-circle me-1"></i> Tunjukkan Tiket Ini ke Kasir
                    </div>
                </div>
                <div class="ticket-footer-dashed">
                    <div class="ticket-info-pill">
                        <span class="info-label">Tipe Pesanan</span>
                        <span class="info-value"><?= strtoupper($data['pesanan']['tipe_pesanan']); ?></span>
                    </div>
                    <div class="ticket-info-pill text-end">
                        <span class="info-label"><?= $data['pesanan']['tipe_pesanan'] == 'dine-in' ? 'No. Meja' : 'Status Bayar'; ?></span>
                        <span class="info-value">
                            <?php 
                                if($data['pesanan']['tipe_pesanan'] == 'dine-in') {
                                    echo "Meja #" . $data['pesanan']['nomor_meja'];
                                } else {
                                    echo strtoupper($data['pesanan']['status_bayar'] == 'lunas' ? 'LUNAS' : 'PENDING');
                                }
                            ?>
                        </span>
                    </div>
                </div>
            </div>
            <button class="btn-print-ticket" onclick="window.print()">
                <i class="fas fa-print me-2"></i> Cetak / Simpan Tiket
            </button>
        </div>

        <div class="row g-4 align-items-start">
            <!-- Left: Payment Instructions -->
            <div class="col-lg-6">
                <!-- Timer Panel -->
                <div class="timer-panel">
                    <span class="timer-label">Selesaikan Pembayaran Dalam</span>
                    <div id="paymentTimer">23:59:59</div>
                </div>

                <div class="payment-card">
                    <div class="card-title-premium">
                        <div class="title-icon-box"><i class="fas fa-wallet"></i></div>
                        <span>Instruksi Pembayaran</span>
                    </div>

                    <!-- Total Re-check -->
                    <div
                        class="mb-4 p-3 bg-danger bg-opacity-10 rounded-4 text-center border border-danger border-opacity-25">
                        <span class="text-muted small fw-bold d-block mb-1">TOTAL YANG HARUS DIBAYAR</span>
                        <h4 class="fw-900 text-danger mb-0">Rp
                            <?= number_format($data['pesanan']['total_harga'], 0, ',', '.'); ?></h4>
                    </div>

                    <?php
                    $metode = $data['metode_pilihan'];
                    if ($metode && $metode['tipe'] == 'qris'):
                        ?>
                        <div class="qris-ui-box">
                            <div class="qris-frame">
                                <?php if (!empty($metode['logo_qr'])): ?>
                                    <img src="<?= BASEURL; ?>/assets/img/pembayaran/<?= $metode['logo_qr']; ?>" class="qris-img"
                                        id="qrisImg">
                                <?php else: ?>
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=DKriukFriedChicken"
                                        class="qris-img" id="qrisImg">
                                <?php endif; ?>
                            </div>

                            <div class="payment-steps mt-4">
                                <h6 class="fw-800 text-start mb-3"><i class="fas fa-list-ol me-2 text-danger"></i> Langkah
                                    Pembayaran:</h6>
                                <div class="step-item">
                                    <div class="step-number">1</div>
                                    <div class="step-text">Buka aplikasi e-wallet Anda (Dana, OVO, GoPay, dll)</div>
                                </div>
                                <div class="step-item">
                                    <div class="step-number">2</div>
                                    <div class="step-text">Pilih menu <b>Scan / Bayar</b> lalu arahkan ke kode QR di atas
                                    </div>
                                </div>
                                <div class="step-item">
                                    <div class="step-number">3</div>
                                    <div class="step-text">Masukkan nominal <b>Rp
                                            <?= number_format($data['pesanan']['total_harga'], 0, ',', '.'); ?></b></div>
                                </div>
                                <div class="step-item">
                                    <div class="step-number">4</div>
                                    <div class="step-text">Selesaikan transaksi dan simpan bukti pembayarannya</div>
                                </div>
                            </div>
                        </div>
                    <?php elseif ($metode && ($metode['tipe'] == 'transfer' || $metode['tipe'] == 'ewallet')): ?>
                        <div class="bank-ui-card">
                            <div class="bank-logo">
                                <i
                                    class="fas <?= $metode['tipe'] == 'transfer' ? 'fa-university' : 'fa-wallet'; ?> text-primary"></i>
                                <span><?= $metode['nama_metode']; ?></span>
                            </div>
                            <div class="acc-number-box">
                                <div class="acc-number" id="accNumber"><?= $metode['nomor_rekening']; ?></div>
                                <button class="btn-copy" onclick="copyToClipboard('accNumber', this)">
                                    <i class="far fa-copy me-1"></i> SALIN
                                </button>
                            </div>
                            <div class="d-flex justify-content-between align-items-center px-2">
                                <span class="small text-muted fw-bold">ATAS NAMA</span>
                                <span class="small fw-800"><?= $metode['atas_nama']; ?></span>
                            </div>
                        </div>

                        <div class="payment-steps mt-4">
                            <h6 class="fw-800 text-start mb-3"><i class="fas fa-list-ol me-2 text-danger"></i> Langkah
                                Pembayaran:</h6>
                            <div class="step-item">
                                <div class="step-number">1</div>
                                <div class="step-text">Buka aplikasi m-Banking atau pergi ke ATM terdekat</div>
                            </div>
                            <div class="step-item">
                                <div class="step-number">2</div>
                                <div class="step-text">Pilih menu <b>Transfer</b> ke rekening
                                    <b><?= $metode['nama_metode']; ?></b> di atas</div>
                            </div>
                            <div class="step-item">
                                <div class="step-number">3</div>
                                <div class="step-text">Pastikan nominal transfer adalah <b>Rp
                                        <?= number_format($data['pesanan']['total_harga'], 0, ',', '.'); ?></b></div>
                            </div>
                            <div class="step-item">
                                <div class="step-number">4</div>
                                <div class="step-text">Simpan bukti transfer Anda untuk proses verifikasi</div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="p-4 bg-light rounded-4 text-center">
                            <i class="fas fa-store fs-1 text-danger mb-3"></i>
                            <h6 class="fw-900">Bayar di Kasir (Cash)</h6>
                            <p class="text-muted small mb-4">
                                <?= $metode ? $metode['instruksi'] : 'Silakan tunjukkan Nomor Pesanan Anda ke petugas kasir di outlet terdekat.'; ?>
                            </p>

                            <div class="payment-steps text-start">
                                <div class="step-item">
                                    <div class="step-number">1</div>
                                    <div class="step-text">Sebutkan <b>Nomor Pesanan</b> Anda ke kasir</div>
                                </div>
                                <div class="step-item">
                                    <div class="step-number">2</div>
                                    <div class="step-text">Lakukan pembayaran tunai sebesar <b>Rp
                                            <?= number_format($data['pesanan']['total_harga'], 0, ',', '.'); ?></b></div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Upload Section -->
                    <?php if ($data['pesanan']['status_bayar'] == 'belum'): ?>
                        <div class="upload-section">
                            <i class="fas fa-cloud-upload-alt fs-2 text-danger mb-2"></i>
                            <h6 class="fw-900 mb-1">Sudah Bayar?</h6>
                            <p class="small text-muted mb-3">Upload bukti transfer Anda di sini untuk konfirmasi instan.</p>
                            <button type="button" class="btn btn-danger rounded-pill px-4 fw-bold small"
                                data-bs-toggle="modal" data-bs-target="#modalUploadBukti">
                                <i class="fas fa-file-upload me-1"></i> Upload Bukti Sekarang
                            </button>
                        </div>
                    <?php elseif ($data['pesanan']['status_bayar'] == 'menunggu_verifikasi'): ?>
                        <div
                            class="p-4 bg-warning bg-opacity-10 rounded-4 text-center border border-warning border-opacity-25 mt-4">
                            <i class="fas fa-clock fs-3 text-warning mb-2"></i>
                            <h6 class="fw-900 text-warning mb-1">Pembayaran Sedang Diverifikasi</h6>
                            <p class="small text-muted mb-0">Terima kasih! Bukti bayar sudah kami terima. Pesanan akan
                                segera diproses setelah divalidasi admin.</p>
                        </div>
                    <?php elseif ($data['pesanan']['status_bayar'] == 'lunas'): ?>
                        <div
                            class="p-4 bg-success bg-opacity-10 rounded-4 text-center border border-success border-opacity-25 mt-4">
                            <i class="fas fa-check-circle fs-3 text-success mb-2"></i>
                            <h6 class="fw-900 text-success mb-1">Pembayaran Berhasil!</h6>
                            <p class="small text-muted mb-0">Pembayaran Anda telah divalidasi. Pesanan Anda kini sedang
                                diprioritaskan di dapur kami.</p>
                        </div>
                    <?php elseif ($data['pesanan']['status_bayar'] == 'gagal'): ?>
                        <div
                            class="p-4 bg-danger bg-opacity-10 rounded-4 text-center border border-danger border-opacity-25 mt-4">
                            <i class="fas fa-times-circle fs-3 text-danger mb-2"></i>
                            <h6 class="fw-900 text-danger mb-1">Pembayaran Ditolak</h6>
                            <p class="small text-muted mb-3">Mohon maaf, bukti pembayaran Anda tidak valid. Silakan upload
                                ulang bukti yang benar.</p>
                            <button type="button" class="btn btn-danger btn-sm rounded-pill px-3 fw-bold"
                                data-bs-toggle="modal" data-bs-target="#modalUploadBukti">
                                <i class="fas fa-redo me-1"></i> Upload Ulang Bukti
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Right: Order Details -->
            <div class="col-lg-6">
                <div class="payment-card">
                    <div class="card-title-premium">
                        <div class="title-icon-box"><i class="fas fa-receipt"></i></div>
                        <span>Detail Pesanan</span>
                    </div>

                    <div class="order-id-label mb-4">
                        <span class="text-muted">No. Pesanan:</span>
                        <span class="fw-800 text-danger ms-1">#<?= $data['pesanan']['kode_pesanan']; ?></span>
                    </div>

                    <div class="order-items-list mb-4">
                        <?php foreach ($data['detail'] as $item): ?>
                            <div class="order-item-row">
                                <div class="item-main-info">
                                    <span class="item-qty"><?= $item['qty']; ?>x</span>
                                    <span class="item-name"><?= $item['nama']; ?></span>
                                </div>
                                <span class="item-subtotal">Rp <?= number_format($item['subtotal'], 0, ',', '.'); ?></span>
                            </div>
                        <?php endforeach; ?>
                        <?php if ($data['pesanan']['tipe_pesanan'] == 'delivery'): ?>
                            <div class="summary-item">
                                <span>Ongkos Kirim (Delivery)</span>
                                <span>Rp <?= number_format($data['pesanan']['ongkir'], 0, ',', '.'); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="summary-total-large">
                        <span class="fw-bold text-muted small">TOTAL TAGIHAN</span>
                        <div class="total-price-premium">Rp
                            <?= number_format($data['pesanan']['total_harga'], 0, ',', '.'); ?></div>
                    </div>

                    <div class="tracker-card p-0 border-0 shadow-none mt-5">
                        <h6 class="fw-900 mb-1">Status Pesanan Real-Time</h6>
                        <p class="small text-muted mb-4">Pantau progress pesanan Anda di bawah ini:</p>

                        <?php
                        $status = $data['pesanan']['status_pesanan'];
                        $tipe = $data['pesanan']['tipe_pesanan'];
                        $created_at = strtotime($data['pesanan']['created_at']);
                        
                        // Logika Estimasi
                        $durasi = ($tipe == 'delivery') ? 45 : 20;
                        $waktu_estimasi = $created_at + ($durasi * 60);
                        $jam_estimasi = date('H:i', $waktu_estimasi);
                        ?>

                        <?php if($status != 'selesai' && $status != 'dibatalkan'): ?>
                        <div class="mb-5">
                            <div class="d-flex align-items-center bg-white p-3 px-3 px-md-4 rounded-4 rounded-pill-md border shadow-sm mx-auto justify-content-between" style="width: 100%;">
                                <div class="d-flex align-items-center gap-2 gap-md-3">
                                    <div class="bg-danger bg-opacity-10 text-danger rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; flex-shrink: 0;">
                                        <i class="fas fa-history fs-5"></i>
                                    </div>
                                    <div class="pe-2 pe-md-3 border-end" style="border-color: #eee !important;">
                                        <span class="d-block small text-muted fw-800" style="letter-spacing: 0.5px; line-height: 1.2; font-size: 0.6rem;">ESTIMASI SELESAI</span>
                                        <span class="fw-900 text-dark fs-5" style="white-space: nowrap;"><?= $jam_estimasi; ?> <small class="fw-bold">WIB</small></span>
                                    </div>
                                </div>
                                <div class="ps-1 ps-md-2 text-end">
                                    <span class="d-block small text-muted fw-800" style="letter-spacing: 0.5px; line-height: 1.2; font-size: 0.6rem;">DURASI</span>
                                    <span class="badge bg-danger rounded-pill px-2 px-md-3 py-1 fw-800" style="white-space: nowrap;"><?= $durasi; ?> Menit</span>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php
                        $status = $data['pesanan']['status_pesanan'];
                        $step = 1;
                        if ($status == 'diproses')
                            $step = 2;
                        if ($status == 'siap_diambil' || $status == 'siap_diantar')
                            $step = 3;
                        if ($status == 'selesai')
                            $step = 4;
                        if ($status == 'dibatalkan')
                            $step = 0;
                        ?>
                        <div class="tracker-steps">
                            <div class="tracker-line">
                                <div class="tracker-line-progress" id="trackerProgress" data-step="<?= $step; ?>"></div>
                            </div>

                            <div class="step-node <?= ($step >= 1) ? ($step > 1 ? 'completed' : 'active') : ''; ?>">
                                <div class="node-circle"><i class="fas fa-receipt"></i></div>
                                <span class="node-label">Dibuat</span>
                            </div>
                            <div class="step-node <?= ($step >= 2) ? ($step > 2 ? 'completed' : 'active') : ''; ?>">
                                <div class="node-circle"><i class="fas fa-fire"></i></div>
                                <span class="node-label">Proses</span>
                            </div>
                            <div class="step-node <?= ($step >= 3) ? ($step > 3 ? 'completed' : 'active') : ''; ?>">
                                <div class="node-circle"><i class="fas fa-box-open"></i></div>
                                <span class="node-label">Siap</span>
                            </div>
                            <div class="step-node <?= ($step >= 4) ? 'completed active' : ''; ?>">
                                <div class="node-circle"><i class="fas fa-check-double"></i></div>
                                <span class="node-label">Selesai</span>
                            </div>
                        </div>
                    </div>

                    <div class="action-grid-premium">
                        <a href="<?= BASEURL; ?>" class="btn-payment-action btn-primary-red">
                            <i class="fas fa-home"></i> Beranda
                        </a>
                        <a href="<?= BASEURL; ?>/profile/pesanan" class="btn-payment-action btn-secondary-outline">
                            <i class="fas fa-history"></i> Riwayat
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Support Section -->
        <div class="mt-5 text-center p-5 bg-white rounded-5 border shadow-sm">
            <h5 class="fw-900 mb-2">Butuh Bantuan?</h5>
            <p class="text-muted small mb-4">Hubungi Admin kami jika Anda mengalami kendala dalam pembayaran.</p>
            <a href="https://wa.me/6281234567890" target="_blank"
                class="btn btn-success px-5 py-3 rounded-pill fw-bold">
                <i class="fab fa-whatsapp me-2"></i> Chat WhatsApp Admin
            </a>
        </div>
    </div>
</div>

<!-- Modal Upload Bukti -->
<div class="modal fade" id="modalUploadBukti" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-5 overflow-hidden">
            <div class="modal-header bg-danger p-4 border-0">
                <h5 class="fw-bold mb-0 text-white"><i class="fas fa-cloud-upload-alt me-2"></i> Konfirmasi Bayar</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= BASEURL; ?>/checkout/konfirmasi_pembayaran" method="post" enctype="multipart/form-data">
                <input type="hidden" name="pesanan_id" value="<?= $data['pesanan']['id']; ?>">
                <div class="modal-body p-4">
                    <div class="mb-4">
                        <label class="form-label small fw-800 text-dark">NOMINAL YANG DIBAYAR</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 rounded-start-3 fw-bold">Rp</span>
                            <input type="number" name="jumlah_bayar"
                                class="form-control rounded-end-3 py-2 border-start-0 fw-bold"
                                value="<?= $data['pesanan']['total_harga']; ?>" required>
                        </div>
                    </div>
                    <div class="mb-0">
                        <label class="form-label small fw-800 text-dark">FOTO BUKTI TRANSFER</label>
                        <input type="file" name="bukti_foto" class="form-control rounded-3 py-2" accept="image/*"
                            required>
                        <p class="text-muted small mt-2 mb-0" style="font-size: 10px;">Pastikan foto terlihat jelas
                            (Format: JPG, PNG, Max 2MB)</p>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger rounded-pill px-4 fw-bold">Kirim Bukti
                        Pembayaran</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Countdown Timer Logic
    function startTimer(duration, display) {
        let timer = duration, hours, minutes, seconds;
        setInterval(function () {
            hours = parseInt(timer / 3600, 10);
            minutes = parseInt((timer % 3600) / 60, 10);
            seconds = parseInt(timer % 60, 10);

            hours = hours < 10 ? "0" + hours : hours;
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = hours + ":" + minutes + ":" + seconds;

            if (--timer < 0) {
                timer = 0;
                display.textContent = "EXPIRED";
            }
        }, 1000);
    }

    window.onload = function () {
        const twentyFourHours = 24 * 60 * 60;
        const display = document.querySelector('#paymentTimer');
        startTimer(twentyFourHours, display);

        // Bersihkan keranjang belanja
        localStorage.removeItem('dkriuk_cart');
    };

    // Copy to Clipboard Function
    function copyToClipboard(elementId, btn) {
        const text = document.getElementById(elementId).innerText;
        navigator.clipboard.writeText(text).then(() => {
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-1"></i> TERSALIN!';
            btn.classList.add('btn-success');
            btn.classList.remove('btn-copy');

            setTimeout(() => {
                btn.innerHTML = originalText;
                btn.classList.remove('btn-success');
                btn.classList.add('btn-copy');
            }, 2000);
        });
    }

    // Tracker Progress Bar Logic (Based on status index)
    // 1: Dibuat, 2: Proses, 3: Siap, 4: Selesai
    const trackerEl = document.getElementById('trackerProgress');
    const currentStatusIndex = parseInt(trackerEl.getAttribute('data-step'));
    const progressWidth = currentStatusIndex > 0 ? ((currentStatusIndex - 1) / 3) * 100 : 0;
    trackerEl.style.width = progressWidth + '%';
    // Check for Status from URL
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');

    if (status === 'success') {
        Swal.fire({
            title: 'Berhasil Terkirim!',
            text: 'Bukti pembayaran Anda telah kami terima dan akan segera diverifikasi oleh tim.',
            icon: 'success',
            confirmButtonText: 'Oke Sip!',
            confirmButtonColor: '#A30D11',
            borderRadius: '20px'
        });
    } else if (status === 'error') {
        Swal.fire({
            title: 'Gagal Upload',
            text: 'Terjadi kesalahan saat mengupload bukti. Pastikan file adalah foto (JPG/PNG) dan ukuran maksimal 2MB.',
            icon: 'error',
            confirmButtonText: 'Coba Lagi',
            confirmButtonColor: '#A30D11'
        });
    }
</script>