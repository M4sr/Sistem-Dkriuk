<style>
    .detail-page {
        padding: 120px 15px 100px;
        background-color: #FDF8F4;
        min-height: 100vh;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .detail-container {
        max-width: 950px;
        margin: 0 auto;
    }

    @media (max-width: 991px) {
        .detail-page {
            padding: 100px 10px 100px;
        }
    }

    .back-btn-wrapper {
        margin-bottom: 30px;
    }

    .back-btn-circle {
        width: 45px;
        height: 45px;
        background: #FFF;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-red);
        text-decoration: none;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        transition: 0.3s;
    }

    .back-btn-circle:hover {
        background: var(--primary-red);
        color: white;
        transform: translateX(-5px);
    }

    /* Custom Upload Area */
    .upload-zone {
        border: 2px dashed #eee;
        border-radius: 20px;
        padding: 30px 20px;
        text-align: center;
        transition: all 0.3s ease;
        background: #fff;
        cursor: pointer;
        position: relative;
    }

    .upload-zone:hover {
        border-color: var(--primary-red);
        background: #FFF5F5;
    }

    .upload-icon {
        font-size: 2.5rem;
        color: #adb5bd;
        margin-bottom: 15px;
        transition: 0.3s;
    }

    .upload-zone:hover .upload-icon {
        color: var(--primary-red);
        transform: translateY(-5px);
    }

    #imagePreview {
        width: 100%;
        max-height: 200px;
        object-fit: contain;
        border-radius: 15px;
        display: none;
        margin-top: 15px;
        border: 1px solid #eee;
    }

    .btn-kirim-bayar {
        background: var(--primary-red);
        border: none;
        padding: 15px;
        border-radius: 15px;
        font-weight: 700;
        letter-spacing: 0.5px;
        transition: 0.3s;
        color: white;
    }

    .btn-kirim-bayar:hover {
        background: #8B0A0D;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(163, 13, 17, 0.3);
        color: white;
    }

    /* Tracking Stepper */
    .tracking-card {
        background: white;
        border-radius: 30px;
        padding: 40px;
        border: 1px solid #eee;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        text-align: center;
    }

    .tracking-header h4 {
        font-weight: 900;
        margin-bottom: 10px;
        color: #333;
    }

    .tracking-header p {
        color: #888;
        font-size: 0.9rem;
        margin-bottom: 40px;
    }

    .stepper-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        max-width: 800px;
        margin: 0 auto;
    }

    .stepper-container::before {
        content: '';
        position: absolute;
        top: 25px;
        left: 50px;
        right: 50px;
        height: 2px;
        background: #eee;
        z-index: 1;
    }

    .step-progress {
        position: absolute;
        top: 25px;
        left: 50px;
        height: 2px;
        background: var(--primary-red);
        z-index: 1;
        transition: 0.5s ease;
    }

    .step-item {
        position: relative;
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100px;
    }

    .step-icon {
        width: 50px;
        height: 50px;
        background: white;
        border: 2px solid #eee;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: #ccc;
        margin-bottom: 15px;
        transition: 0.3s;
    }

    .step-label {
        font-size: 0.85rem;
        font-weight: 700;
        color: #ccc;
        transition: 0.3s;
    }

    .step-item.active .step-icon {
        background: var(--primary-red);
        border-color: var(--primary-red);
        color: white;
        box-shadow: 0 0 0 8px rgba(163, 13, 17, 0.1);
    }

    .step-item.active .step-label {
        color: var(--primary-red);
    }

    .step-item.completed .step-icon {
        background: #fff;
        border-color: var(--primary-red);
        color: var(--primary-red);
    }

    .step-item.completed .step-label {
        color: #333;
    }

    /* Cards */
    .info-card {
        background: white;
        border-radius: 30px;
        padding: 35px;
        border: 1px solid #eee;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        height: fit-content;
    }

    .sticky-card {
        position: sticky;
        top: 100px;
        z-index: 10;
    }

    .card-section-title {
        font-weight: 900;
        font-size: 1.15rem;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        gap: 15px;
        color: #333;
    }

    /* Items List */
    .item-row {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #f8f8f8;
    }

    .item-img {
        width: 65px;
        height: 65px;
        border-radius: 15px;
        object-fit: cover;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .item-details h6 {
        font-weight: 800;
        margin-bottom: 2px;
        font-size: 0.95rem;
        color: #333;
    }

    .item-price {
        margin-left: auto;
        text-align: right;
    }

    .item-price .qty {
        font-size: 0.8rem;
        color: #999;
        margin-right: 10px;
        font-weight: 700;
    }

    .item-price .total {
        font-weight: 800;
        color: #333;
        font-size: 1rem;
    }

    .summary-total {
        display: flex;
        justify-content: space-between;
        margin-top: 25px;
        padding-top: 25px;
        border-top: 2px dashed #eee;
        font-weight: 900;
        font-size: 1.4rem;
        color: var(--primary-red);
    }

    /* Payment Instruction */
    .payment-instruction-card {
        background: #FFF9F9;
        border: 1px dashed var(--primary-red);
        border-radius: 25px;
        padding: 30px;
        margin-top: 35px;
    }

    .instr-title {
        font-weight: 900;
        color: var(--primary-red);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .qris-display {
        text-align: center;
        background: white;
        padding: 25px;
        border-radius: 20px;
        margin-bottom: 20px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.02);
    }

    .qris-img-large {
        max-width: 280px;
        width: 100%;
        border-radius: 10px;
    }

    .bank-info-box {
        background: white;
        padding: 25px;
        border-radius: 20px;
        margin-bottom: 20px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.02);
    }

    .bank-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
    }

    .bank-row:last-child { margin-bottom: 0; }

    .bank-label {
        font-size: 0.85rem;
        color: #888;
        font-weight: 700;
    }

    .bank-value {
        font-weight: 900;
        color: #333;
    }

    .steps-box {
        background: white;
        padding: 25px;
        border-radius: 20px;
        border: 1px solid rgba(163, 13, 17, 0.05);
    }

    .steps-box .badge {
        width: 26px;
        height: 26px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        font-size: 0.8rem;
    }

    /* Info Grid */
    .info-grid-item {
        display: flex;
        align-items: flex-start;
        gap: 20px;
        margin-bottom: 25px;
    }

    .info-grid-item:last-child { margin-bottom: 0; }

    .info-icon {
        width: 42px;
        height: 42px;
        background: #F8F9FA;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #666;
        flex-shrink: 0;
        font-size: 1.1rem;
    }

    .info-text label {
        display: block;
        font-size: 0.8rem;
        color: #999;
        font-weight: 700;
        margin-bottom: 3px;
    }

    .info-text span {
        font-weight: 800;
        color: #333;
        font-size: 1rem;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 15px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-pending { background: #FFF3CD; color: #856404; }
    .status-diproses { background: #CCE5FF; color: #004085; }
    .status-disiapkan { background: #E0E7FF; color: #3730A3; }
    .status-dikirim { background: #DBEAFE; color: #1E40AF; }
    .status-selesai { background: #D4EDDA; color: #155724; }
    .status-dibatalkan { background: #F8D7DA; color: #721C24; }

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
        background: #FDF8F4;
        border-radius: 50%;
    }

    .ticket-footer-dashed::before { left: -15px; }
    .ticket-footer-dashed::after { right: -15px; }

    .ticket-info-pill {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .info-label-t {
        font-size: 0.7rem;
        font-weight: 800;
        color: #999;
        text-transform: uppercase;
    }

    .info-value-t {
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
        .navbar, .mobile-top-header, .bottom-nav, footer, #footer, .tracking-card, .info-card, .footer, .btn-print-ticket, .back-btn-wrapper {
            display: none !important;
        }
        .detail-page { padding: 0; background: white; }
        .digital-ticket-wrapper { max-width: 100%; margin: 0; }
        .ticket-card-premium { box-shadow: none; border: 1px solid #ccc; }
    }
</style>

<div class="detail-page">
    <div class="detail-container">
        <div class="back-btn-wrapper">
            <a href="<?= BASEURL; ?>/profile/pesanan" class="back-btn-circle">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>

        <?php Flasher::flash(); ?>

        <!-- Tracking Stepper -->
        <div class="tracking-card">
            <div class="tracking-header">
                <?php 
                $status = $data['pesanan']['status_pesanan'];
                $tipe = $data['pesanan']['tipe_pesanan'];
                $created_at = strtotime($data['pesanan']['created_at']);
                
                // Logika Estimasi
                $durasi = ($tipe == 'delivery') ? 45 : 20;
                $waktu_estimasi = $created_at + ($durasi * 60);
                $jam_estimasi = date('H:i', $waktu_estimasi);
                
                $title = "Pesanan Anda Sedang Kami Proses";
                $subtitle = "Kami akan segera menyiapkan pesanan terbaik untuk Anda.";
                
                if($status == 'diproses') {
                    $title = "Pesanan Anda Sedang Dimasak";
                    $subtitle = "Koki kami sedang mengolah bahan segar menjadi hidangan lezat.";
                } elseif($status == 'siap_diambil' || $status == 'siap_diantar' || $status == 'dikirim') {
                    $title = ($tipe == 'dine-in') ? "Pesanan Sudah Siap!" : "Pesanan Dalam Perjalanan";
                    $subtitle = ($tipe == 'dine-in') ? "Silakan ambil pesanan Anda di meja atau kasir." : "Driver kami sedang menuju lokasi Anda.";
                } elseif($status == 'selesai') {
                    $title = "Pesanan Telah Selesai";
                    $subtitle = "Terima kasih telah memesan. Selamat menikmati hidangan kami!";
                }
                ?>
                <h4><?= $title; ?></h4>
                <p><?= $subtitle; ?></p>

                <?php if($status != 'selesai' && $status != 'dibatalkan'): ?>
                <div class="mt-4 mb-5">
                    <div class="d-flex align-items-center bg-white p-3 px-3 px-md-4 rounded-4 rounded-pill-md border shadow-sm mx-auto justify-content-between" style="max-width: 100%; width: 100%;">
                        <div class="d-flex align-items-center gap-2 gap-md-3">
                            <div class="bg-danger bg-opacity-10 text-danger rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; flex-shrink: 0;">
                                <i class="fas fa-clock fs-5"></i>
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
            </div>

            <div class="stepper-container">
                <?php
                $steps = [
                    ['label' => 'Dibuat', 'icon' => 'fa-receipt'],
                    ['label' => 'Diproses', 'icon' => 'fa-fire'],
                    ['label' => ($tipe == 'dine-in' ? 'Disiapkan' : 'Dikirim'), 'icon' => ($tipe == 'dine-in' ? 'fa-box-open' : 'fa-motorcycle')],
                    ['label' => 'Selesai', 'icon' => 'fa-check-double']
                ];

                $currentIndex = 0; // pending
                if($status == 'diproses') $currentIndex = 1;
                if($status == 'siap_diambil' || $status == 'siap_diantar' || $status == 'dikirim') $currentIndex = 2;
                if($status == 'selesai') $currentIndex = 3;

                $progressWidth = ($currentIndex / (count($steps) - 1)) * 100;
                ?>
                
                <div class="step-progress" style="width: calc(<?= $progressWidth; ?>% - 100px); left: 50px;"></div>

                <?php foreach($steps as $idx => $s): ?>
                    <?php 
                    $class = "";
                    if($idx < $currentIndex) $class = "completed";
                    if($idx == $currentIndex) $class = "active";
                    if($status == 'selesai') $class = "completed";
                    if($status == 'selesai' && $idx == 3) $class = "active";
                    ?>
                    <div class="step-item <?= $class; ?>">
                        <div class="step-icon">
                            <i class="fas <?= $s['icon']; ?>"></i>
                        </div>
                        <span class="step-label"><?= $s['label']; ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Digital Ticket Section (Full Width Stack) -->
        <div class="digital-ticket-wrapper mb-5 w-100 mx-auto" style="max-width: 550px;">
            <div class="ticket-card-premium shadow-sm">
                <div class="ticket-top">
                    <div class="ticket-title">TIKET PESANAN DKRIUK</div>
                </div>
                <div class="ticket-body-new">
                    <div class="qr-box-premium">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=<?= $data['pesanan']['kode_pesanan']; ?>" 
                            class="qr-img-premium" alt="Order QR">
                    </div>
                    <div class="ticket-code-big" style="font-size: 2.2rem;"><?= $data['pesanan']['kode_pesanan']; ?></div>
                    <div class="ticket-customer-name"><?= $data['pesanan']['nama_pelanggan'] ?: 'Pelanggan Setia'; ?></div>
                    
                    <div class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-4 py-2 fw-800">
                        <i class="fas fa-info-circle me-1"></i> Tunjukkan Tiket Ini ke Kasir
                    </div>
                </div>
                <div class="ticket-footer-dashed">
                    <div class="ticket-info-pill">
                        <span class="info-label-t">Tipe Pesanan</span>
                        <span class="info-value-t"><?= strtoupper($data['pesanan']['tipe_pesanan']); ?></span>
                    </div>
                    <div class="ticket-info-pill text-end">
                        <span class="info-label-t"><?= $data['pesanan']['tipe_pesanan'] == 'dine-in' ? 'No. Meja' : 'Status Bayar'; ?></span>
                        <span class="info-value-t">
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
            <div class="text-center">
                <button class="btn-print-ticket mt-4" onclick="window.print()">
                    <i class="fas fa-print me-2"></i> Cetak / Simpan Tiket
                </button>
            </div>
        </div>

        <div class="row g-4 justify-content-center">
            <!-- Order Details -->
            <div class="col-lg-12">
                <div class="info-card">
                    <div class="card-section-title">
                        <i class="fas fa-receipt text-danger"></i> Rincian Pesanan #<?= $data['pesanan']['kode_pesanan']; ?>
                    </div>

                    <div class="items-container">
                        <?php foreach($data['detail'] as $item): ?>
                        <div class="item-row">
                            <img src="<?= BASEURL; ?>/assets/img/produk/<?= $item['foto']; ?>" class="item-img" onerror="this.src='https://placehold.co/200x200?text=Menu+DKriuk'">
                            <div class="item-details">
                                <h6><?= $item['nama']; ?></h6>
                                <p class="small text-muted mb-0">Rp <?= number_format($item['harga_satuan'], 0, ',', '.'); ?></p>
                            </div>
                            <div class="item-price">
                                <span class="qty"><?= $item['qty']; ?>x</span>
                                <span class="total">Rp <?= number_format($item['subtotal'], 0, ',', '.'); ?></span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="mt-4">
                        <div class="d-flex justify-content-between mb-2 text-muted">
                            <span>Subtotal</span>
                            <span>Rp <?= number_format($data['pesanan']['total_harga'] - $data['pesanan']['ongkir'], 0, ',', '.'); ?></span>
                        </div>
                        <?php if($data['pesanan']['ongkir'] > 0): ?>
                        <div class="d-flex justify-content-between mb-2 text-muted">
                            <span>Ongkos Kirim</span>
                            <span>Rp <?= number_format($data['pesanan']['ongkir'], 0, ',', '.'); ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="summary-total">
                            <span>Total Pembayaran</span>
                            <span>Rp <?= number_format($data['pesanan']['total_harga'], 0, ',', '.'); ?></span>
                        </div>
                    </div>

                    <!-- --- DYNAMIC PAYMENT INSTRUCTIONS --- -->
                    <?php if($data['pesanan']['status_bayar'] !== 'lunas'): ?>
                    <div class="payment-instruction-card mt-5">
                        <div class="instr-title">
                            <i class="fas fa-hand-holding-usd"></i> Panduan Pembayaran
                        </div>
                        
                        <div class="instr-body">
                            <div class="mb-4">
                                <p class="text-muted small mb-3">Silakan selesaikan pembayaran Anda melalui metode berikut:</p>
                                
                                <?php if($data['pesanan']['metode_bayar'] == 'transfer'): ?>
                                    <div class="bank-card p-3 rounded-4 border bg-light">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <span class="badge bg-danger px-3">Bank Transfer</span>
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/5/5c/Bank_Central_Asia.svg" alt="BCA" height="20">
                                        </div>
                                        <div class="bank-details">
                                            <div class="mb-2">
                                                <label class="text-muted small d-block">Nomor Rekening</label>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span class="fw-900 fs-5 text-dark"><?= $data['pengaturan']['bank_acc_number'] ?? '1234567890'; ?></span>
                                                    <button class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="copyText('<?= $data['pengaturan']['bank_acc_number'] ?? '1234567890'; ?>')">Salin</button>
                                                </div>
                                            </div>
                                            <div>
                                                <label class="text-muted small d-block">Atas Nama</label>
                                                <span class="fw-bold text-dark"><?= $data['pengaturan']['bank_acc_name'] ?? 'SI FRIED CHICKEN'; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                <?php elseif($data['pesanan']['metode_bayar'] == 'cash'): ?>
                                    <div class="p-3 bg-white rounded-4 border">
                                        <h6 class="fw-bold mb-2">Pembayaran Tunai (Cash)</h6>
                                        <p class="small text-muted mb-0">Silakan siapkan uang pas sebesar <strong>Rp <?= number_format($data['pesanan']['total_harga'], 0, ',', '.'); ?></strong>.</p>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Upload Section -->
                            <div class="mt-4 pt-3 border-top">
                                <?php if(!$data['pembayaran']): ?>
                                    <h6 class="fw-bold mb-3"><i class="fas fa-upload me-2 text-danger"></i> Unggah Bukti Pembayaran</h6>
                                    <form action="<?= BASEURL; ?>/profile/bayar" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="pesanan_id" value="<?= $data['pesanan']['id']; ?>">
                                        <div class="upload-zone mb-3" onclick="document.getElementById('bukti_foto').click()">
                                            <input type="file" name="bukti_foto" id="bukti_foto" class="d-none" accept="image/*" required>
                                            <i class="fas fa-cloud-upload-alt fs-2 text-muted mb-2"></i>
                                            <p class="small text-muted mb-0">Klik untuk upload bukti bayar</p>
                                        </div>
                                        <button type="submit" class="btn btn-danger w-100 py-2 rounded-pill fw-bold">Kirim Bukti</button>
                                    </form>
                                <?php else: ?>
                                    <div class="alert alert-success rounded-4 text-center py-3">
                                        <i class="fas fa-check-circle fs-3 mb-2"></i>
                                        <p class="mb-0 fw-bold">Bukti pembayaran telah diunggah</p>
                                        <small>Status: <?= ucfirst($data['pembayaran']['status']); ?></small>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-2">
            <!-- Information & Status (Professional Grid) -->
            <div class="col-lg-12">
                <div class="info-card border-0 shadow-sm p-4" style="background: #fff; border-radius: 25px;">
                    <div class="card-section-title mb-4">
                        <i class="fas fa-info-circle text-danger"></i> Informasi Pesanan & Status
                    </div>

                    <div class="row g-4">
                        <!-- Item 1: Status Bayar -->
                        <div class="col-md-4 col-sm-6">
                            <div class="info-grid-item d-flex align-items-center">
                                <div class="info-icon me-3 bg-light rounded-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="fas fa-credit-card text-muted"></i>
                                </div>
                                <div class="info-text">
                                    <label class="text-muted small d-block mb-1" style="font-size: 11px; font-weight: 700;">STATUS BAYAR</label>
                                    <span class="badge bg-<?= $data['pesanan']['status_bayar'] == 'lunas' ? 'success' : 'warning'; ?> bg-opacity-10 text-<?= $data['pesanan']['status_bayar'] == 'lunas' ? 'success' : 'warning'; ?> text-uppercase px-3 py-1 rounded-pill fw-bold" style="font-size: 12px;">
                                        <?= strtoupper(str_replace('_', ' ', $data['pesanan']['status_bayar'])); ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Item 2: Waktu -->
                        <div class="col-md-4 col-sm-6">
                            <div class="info-grid-item d-flex align-items-center">
                                <div class="info-icon me-3 bg-light rounded-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="fas fa-calendar-alt text-muted"></i>
                                </div>
                                <div class="info-text">
                                    <label class="text-muted small d-block mb-1" style="font-size: 11px; font-weight: 700;">WAKTU PESAN</label>
                                    <span class="fw-bold text-dark d-block" style="font-size: 13px;"><?= date('d M Y, H:i', strtotime($data['pesanan']['created_at'])); ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Item 3: Metode -->
                        <div class="col-md-4 col-sm-6">
                            <div class="info-grid-item d-flex align-items-center">
                                <div class="info-icon me-3 bg-light rounded-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="fas fa-wallet text-muted"></i>
                                </div>
                                <div class="info-text">
                                    <label class="text-muted small d-block mb-1" style="font-size: 11px; font-weight: 700;">METODE BAYAR</label>
                                    <span class="fw-bold text-dark text-uppercase" style="font-size: 13px;"><?= $data['pesanan']['metode_bayar']; ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Item 4: Tipe -->
                        <div class="col-md-4 col-sm-6">
                            <div class="info-grid-item d-flex align-items-center">
                                <div class="info-icon me-3 bg-light rounded-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="fas fa-utensils text-muted"></i>
                                </div>
                                <div class="info-text">
                                    <label class="text-muted small d-block mb-1" style="font-size: 11px; font-weight: 700;">TIPE LAYANAN</label>
                                    <span class="badge bg-danger bg-opacity-10 text-danger text-uppercase px-3 py-1 rounded-pill fw-bold" style="font-size: 11px;">
                                        <?= strtoupper($data['pesanan']['tipe_pesanan']); ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Item 5: Lokasi/Meja -->
                        <div class="col-md-4 col-sm-6">
                            <div class="info-grid-item d-flex align-items-center">
                                <div class="info-icon me-3 bg-light rounded-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="fas fa-map-marker-alt text-muted"></i>
                                </div>
                                <div class="info-text">
                                    <label class="text-muted small d-block mb-1" style="font-size: 11px; font-weight: 700;"><?= $data['pesanan']['tipe_pesanan'] == 'dine-in' ? 'NOMOR MEJA' : 'LOKASI'; ?></label>
                                    <span class="fw-bold text-dark d-block" style="font-size: 13px;">
                                        <?= $data['pesanan']['alamat_pengantaran'] ?: ($data['pesanan']['tipe_pesanan'] == 'dine-in' ? 'MEJA #'.$data['pesanan']['nomor_meja'] : 'Ambil di Toko'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Item 6: Catatan -->
                        <?php if($data['pesanan']['catatan']): ?>
                        <div class="col-md-4 col-sm-6">
                            <div class="info-grid-item d-flex align-items-center">
                                <div class="info-icon me-3 bg-light rounded-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="fas fa-sticky-note text-muted"></i>
                                </div>
                                <div class="info-text">
                                    <label class="text-muted small d-block mb-1" style="font-size: 11px; font-weight: 700;">CATATAN</label>
                                    <span class="fw-normal italic text-muted" style="font-size: 12px;">"<?= $data['pesanan']['catatan']; ?>"</span>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function previewImage(input) {
        const preview = document.getElementById('imagePreview');
        const placeholder = document.getElementById('uploadPlaceholder');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                placeholder.style.display = 'none';
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
