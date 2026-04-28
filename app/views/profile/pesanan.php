<style>
    .history-page {
        padding: 140px 0 80px;
        background-color: #FDF8F4;
        min-height: 100vh;
    }

    @media (max-width: 991px) {
        .history-page {
            padding: 100px 0 80px;
        }
    }

    .page-header {
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
    }

    /* Tabs Styling */
    .history-tabs {
        border-bottom: 1px solid #eee;
        margin-bottom: 30px;
        display: flex;
        gap: 30px;
    }

    .tab-item {
        padding: 15px 5px;
        color: #666;
        font-weight: 700;
        cursor: pointer;
        position: relative;
        text-decoration: none;
    }

    .tab-item.active {
        color: var(--primary-red);
    }

    .tab-item.active::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        right: 0;
        height: 3px;
        background: var(--primary-red);
        border-radius: 3px 3px 0 0;
    }

    /* Filter Bar */
    .filter-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .date-filter {
        background: white;
        border: 1px solid #eee;
        padding: 10px 20px;
        border-radius: 12px;
        font-weight: 600;
        color: #444;
        display: flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.02);
    }

    /* Order Card Design */
    .order-card {
        background: white;
        border-radius: 20px;
        padding: 25px;
        margin-bottom: 20px;
        border: 1px solid #eee;
        transition: 0.3s;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    }

    .order-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    .card-img-wrapper {
        width: 140px;
        height: 140px;
        border-radius: 15px;
        overflow: hidden;
        flex-shrink: 0;
    }

    .card-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .card-content-main {
        flex: 1;
        padding: 0 25px;
        border-right: 1px solid #f5f5f5;
    }

    .order-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 15px;
    }

    .order-kode {
        font-weight: 900;
        font-size: 1.2rem;
        color: #1a1a1a;
        margin: 0;
    }

    .status-pill {
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: capitalize;
    }

    .pill-selesai { background: #E8F5E9; color: #2E7D32; }
    .pill-diproses { background: #FFF3E0; color: #EF6C00; }
    .pill-pending { background: #E3F2FD; color: #1565C0; }
    .pill-dibatalkan { background: #FFEBEE; color: #C62828; }

    .meta-info {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .meta-info li {
        font-size: 0.85rem;
        color: #777;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .meta-info i {
        width: 16px;
        color: #999;
    }

    /* Menu Summary Column */
    .card-content-menu {
        width: 250px;
        padding: 0 25px;
        border-right: 1px solid #f5f5f5;
    }

    .menu-summary-title {
        font-size: 0.8rem;
        font-weight: 800;
        color: #444;
        margin-bottom: 12px;
    }

    .menu-item-simple {
        display: flex;
        justify-content: space-between;
        font-size: 0.85rem;
        margin-bottom: 8px;
        color: #666;
    }

    .total-section {
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px dashed #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .total-label {
        font-size: 0.8rem;
        font-weight: 800;
    }

    .total-price {
        font-weight: 900;
        color: var(--primary-red);
        font-size: 1.1rem;
    }

    /* Status Action Column */
    .card-content-action {
        width: 180px;
        padding: 0 15px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .status-indicator {
        margin-bottom: 5px;
    }

    .status-icon-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        margin: 0 auto 8px;
        align-self: center;
    }

    .icon-selesai { background: #E8F5E9; color: #2E7D32; border: 1px solid #2E7D32; }
    .icon-diproses { background: #FFF3E0; color: #EF6C00; border: 1px solid #EF6C00; }
    .icon-pending { background: #E3F2FD; color: #1565C0; border: 1px solid #1565C0; }
    .icon-dibatalkan { background: #FFEBEE; color: #C62828; border: 1px solid #C62828; }

    .status-text-bold {
        font-weight: 800;
        font-size: 0.85rem;
        color: #333;
        display: block;
    }

    .status-time-small {
        font-size: 0.7rem;
        color: #999;
    }

    .btn-lihat-detail {
        background: white;
        border: 1px solid var(--primary-red);
        color: var(--primary-red);
        font-weight: 800;
        padding: 8px 15px;
        border-radius: 10px;
        font-size: 0.8rem;
        margin-top: 10px;
        transition: 0.3s;
        text-decoration: none;
    }

    .btn-lihat-detail:hover {
        background: var(--primary-red);
        color: white;
    }

    /* Help Section */
    .help-section {
        background: #FEF2F2;
        border-radius: 20px;
        padding: 25px;
        margin-top: 50px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .help-content {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .help-icon {
        width: 50px;
        height: 50px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: var(--primary-red);
    }

    @media (max-width: 768px) {
        .history-tabs {
            gap: 15px;
            overflow-x: auto;
            padding-bottom: 5px;
            -webkit-overflow-scrolling: touch;
        }
        
        .tab-item {
            white-space: nowrap;
            font-size: 0.9rem;
        }

        .order-card {
            flex-direction: column;
            padding: 20px;
        }

        .card-img-wrapper {
            width: 100%;
            height: 160px;
            margin-bottom: 20px;
        }

        .card-content-main {
            padding: 0;
            border-right: none;
            margin-bottom: 20px;
        }

        .card-content-menu {
            width: 100%;
            padding: 0;
            border-right: none;
            margin-bottom: 20px;
        }

        .card-content-action {
            width: 100%;
            padding: 0;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #f5f5f5;
            padding-top: 20px;
        }

        .status-indicator {
            display: flex;
            align-items: center;
            gap: 12px;
            text-align: left;
            margin-bottom: 0;
        }

        .status-icon-circle {
            margin: 0;
            width: 35px;
            height: 35px;
            font-size: 1rem;
        }

        .btn-lihat-detail {
            margin-top: 0;
            flex: 0 0 auto;
        }

        .help-section {
            flex-direction: column;
            text-align: center;
            gap: 25px;
        }

        .help-content {
            flex-direction: column;
        }
    }

    .btn-wa-help {
        background: var(--primary-red);
        color: white;
        padding: 12px 25px;
        border-radius: 12px;
        font-weight: 800;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: 0.3s;
    }

    .btn-wa-help:hover {
        background: var(--dark-red);
        transform: scale(1.05);
    }

    /* Search Box styling */
    .search-input-wrapper {
        max-width: 500px;
        margin-bottom: 40px;
    }

    @media (max-width: 992px) {
        .order-card { flex-direction: column; }
        .card-content-main, .card-content-menu, .card-content-action {
            width: 100%;
            padding: 20px 0;
            border-right: none;
            border-bottom: 1px solid #f5f5f5;
        }
    }
</style>

<div class="history-page">
    <div class="container">
        <!-- Header -->
        <div class="page-header d-flex align-items-center gap-3">
            <a href="<?= BASEURL; ?>" class="back-btn-circle">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h3 class="fw-900 mb-0">Riwayat Pesanan</h3>
                <p class="text-muted small mb-0">Lihat semua pesanan yang pernah Anda buat</p>
            </div>
        </div>

        <!-- Search Box (If not searched yet or want to re-search) -->
        <div class="search-input-wrapper mt-4">
            <form action="<?= BASEURL; ?>/profile/pesanan" method="POST">
                <div class="input-group">
                    <input type="text" name="keyword" class="form-control rounded-start-4 border-end-0 px-4" style="height: 55px;" placeholder="Kode Pesanan atau No. WA..." value="<?= $data['keyword']; ?>">
                    <button type="submit" class="btn btn-danger rounded-end-4 px-4 fw-bold">Lacak Pesanan</button>
                </div>
            </form>
        </div>

        <?php if(!empty($data['pesanan'])): ?>
            <div class="history-tabs mb-2">
                <a href="javascript:void(0)" class="tab-item active" data-filter="all">Semua</a>
                <a href="javascript:void(0)" class="tab-item" data-filter="pending">Menunggu</a>
                <a href="javascript:void(0)" class="tab-item" data-filter="diproses">Diproses</a>
                <a href="javascript:void(0)" class="tab-item" data-filter="selesai">Selesai</a>
                <a href="javascript:void(0)" class="tab-item" data-filter="dibatalkan">Dibatalkan</a>
            </div>

            <!-- Tipe Pesanan Filter -->
            <div class="d-flex flex-wrap gap-2 mb-4">
                <a href="javascript:void(0)" class="tab-tipe badge bg-danger text-white rounded-pill px-3 py-2 text-decoration-none" data-tipe="all">Semua Tipe</a>
                <a href="javascript:void(0)" class="tab-tipe badge bg-white text-dark border rounded-pill px-3 py-2 text-decoration-none" data-tipe="dine-in">Dine-In</a>
                <a href="javascript:void(0)" class="tab-tipe badge bg-white text-dark border rounded-pill px-3 py-2 text-decoration-none" data-tipe="takeaway">Take-Away</a>
                <a href="javascript:void(0)" class="tab-tipe badge bg-white text-dark border rounded-pill px-3 py-2 text-decoration-none" data-tipe="delivery">Delivery</a>
            </div>

            <!-- Orders Container -->
            <div class="orders-container">
                <?php foreach($data['pesanan'] as $p): ?>
                <div class="order-card d-flex" data-status="<?= $p['status_pesanan']; ?>" data-tipe="<?= $p['tipe_pesanan']; ?>">
                    <!-- Left: Img -->
                    <div class="card-img-wrapper">
                        <img src="<?= BASEURL; ?>/img/<?= $p['foto_produk']; ?>" onerror="this.src='https://images.unsplash.com/photo-1562967914-608f82629710?w=400'">
                    </div>

                    <!-- Main Info -->
                    <div class="card-content-main">
                        <div class="order-header">
                            <h4 class="order-kode">#<?= $p['kode_pesanan']; ?></h4>
                            <span class="status-pill pill-<?= $p['status_pesanan']; ?>"><?= $p['status_pesanan']; ?></span>
                        </div>
                        <ul class="meta-info">
                            <li><i class="far fa-calendar-alt"></i> <?= date('d F Y, H:i', strtotime($p['created_at'])); ?> WIB</li>
                            <li><i class="fas fa-utensils"></i> <span class="text-capitalize"><?= $p['tipe_pesanan']; ?></span></li>
                            <li><i class="fas fa-map-marker-alt"></i> <?= $p['alamat_pengantaran'] ?: ($p['tipe_pesanan'] == 'dine-in' ? 'Meja #'.$p['nomor_meja'] : 'Take Away'); ?></li>
                        </ul>
                    </div>

                    <!-- Menu Summary -->
                    <div class="card-content-menu">
                        <div class="menu-summary-title">Menu (<?= $p['total_item']; ?>)</div>
                        <div class="menu-list-preview">
                            <!-- In real app, we might want to fetch first 2 items name -->
                            <div class="menu-item-simple">
                                <span>Item Utama</span>
                                <span>-</span>
                            </div>
                        </div>
                        <div class="total-section">
                            <div class="total-label">Total Pembayaran</div>
                            <div class="total-price">Rp <?= number_format($p['total_harga'], 0, ',', '.'); ?></div>
                        </div>
                    </div>

                    <!-- Action & Big Status -->
                    <div class="card-content-action">
                        <div class="status-indicator">
                            <?php 
                                $icon = 'check';
                                $class = 'selesai';
                                if($p['status_pesanan'] == 'pending') { $icon = 'clock'; $class = 'pending'; }
                                if($p['status_pesanan'] == 'diproses') { $icon = 'fire'; $class = 'diproses'; }
                                if($p['status_pesanan'] == 'dibatalkan') { $icon = 'times'; $class = 'dibatalkan'; }
                            ?>
                            <div class="status-icon-circle icon-<?= $class; ?>">
                                <i class="fas fa-<?= $icon; ?>"></i>
                            </div>
                            <span class="status-text-bold">Pesanan <?= ucfirst($p['status_pesanan']); ?></span>
                            <span class="status-time-small"><?= date('H:i', strtotime($p['created_at'])); ?> WIB</span>
                        </div>
                        <a href="<?= BASEURL; ?>/profile/detail/<?= $p['id']; ?>" class="btn-lihat-detail">Lihat Detail</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Pagination (Placeholder) -->
            <div class="d-flex justify-content-center mt-5">
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-sm">
                        <li class="page-item"><a class="page-link rounded-circle mx-1 border-0" href="#"><i class="fas fa-chevron-left"></i></a></li>
                        <li class="page-item active"><a class="page-link rounded-circle mx-1 border-0 bg-danger" href="#">1</a></li>
                        <li class="page-item"><a class="page-link rounded-circle mx-1 border-0" href="#">2</a></li>
                        <li class="page-item"><a class="page-link rounded-circle mx-1 border-0" href="#">3</a></li>
                        <li class="page-item"><a class="page-link rounded-circle mx-1 border-0" href="#"><i class="fas fa-chevron-right"></i></a></li>
                    </ul>
                </nav>
            </div>

        <script>
    document.addEventListener('DOMContentLoaded', function() {
        const statusTabs = document.querySelectorAll('.tab-item');
        const tipeTabs = document.querySelectorAll('.tab-tipe');
        
        let currentStatusFilter = 'all';
        let currentTipeFilter = 'all';

        function filterCards() {
            const cards = document.querySelectorAll('.order-card');
            
            cards.forEach(card => {
                const status = (card.getAttribute('data-status') || '').toLowerCase().trim();
                const tipe = (card.getAttribute('data-tipe') || '').toLowerCase().trim();
                
                const matchStatus = currentStatusFilter === 'all' || status === currentStatusFilter;
                const matchTipe = currentTipeFilter === 'all' || tipe === currentTipeFilter;

                if (matchStatus && matchTipe) {
                    card.classList.remove('d-none');
                } else {
                    card.classList.add('d-none');
                }
            });
        }

        statusTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                currentStatusFilter = (this.getAttribute('data-filter') || 'all').toLowerCase().trim();
                
                statusTabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                
                filterCards();
            });
        });

        tipeTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                currentTipeFilter = (this.getAttribute('data-tipe') || 'all').toLowerCase().trim();
                
                tipeTabs.forEach(t => {
                    t.classList.remove('bg-danger', 'text-white');
                    t.classList.add('bg-white', 'text-dark', 'border');
                });
                
                this.classList.remove('bg-white', 'text-dark', 'border');
                this.classList.add('bg-danger', 'text-white');
                
                filterCards();
            });
        });
    });
</script>
        <?php else: ?>
            <div class="text-center py-5 mt-4 bg-white rounded-5 border border-dashed">
                <img src="https://illustrations.popsy.co/amber/shaking-hands.svg" alt="Wait" style="width: 200px;">
                <h4 class="fw-800 mt-4">Belum Ada Riwayat</h4>
                <p class="text-muted">Silakan masukkan Nomor WA atau Kode Pesanan Anda di atas untuk melihat riwayat belanja.</p>
            </div>
        <?php endif; ?>

        <!-- Help Section -->
        <div class="help-section">
            <div class="help-content">
                <div class="help-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <div>
                    <h5 class="fw-900 mb-1">Butuh bantuan?</h5>
                    <p class="text-muted small mb-0">Jika ada kendala dengan pesanan Anda,<br>silakan hubungi kami.</p>
                </div>
            </div>
            <a href="https://wa.me/<?= $data['pengaturan']['no_telp'] ?? '081234567890'; ?>" class="btn-wa-help" target="_blank">
                <i class="fab fa-whatsapp"></i> Hubungi Kami via WhatsApp
            </a>
        </div>
    </div>
</div>
