
    <!-- Header -->
    <div class="row align-items-center mb-4 g-3">
        <div class="col-md-8">
            <h4 class="fw-bold mb-1">Laporan Penjualan</h4>
            <p class="text-muted small mb-0">Pantau performa bisnis Anda secara mendalam</p>
        </div>
        <div class="col-md-4 text-md-end">
            <div class="d-flex gap-2 justify-content-md-end">
                <?php 
                    $params = $_GET;
                    unset($params['url']);
                    $queryString = http_build_query($params);
                ?>
                <a href="<?= BASEURL; ?>/admin/cetak_laporan?<?= $queryString; ?>" target="_blank" class="btn btn-outline-dark rounded-3 px-3 fw-bold shadow-sm flex-fill">
                    <i class="fas fa-print me-1 d-none d-sm-inline"></i> Cetak PDF
                </a>
                <button class="btn btn-success rounded-3 px-3 fw-bold shadow-sm flex-fill" onclick="exportData()">
                    <i class="fas fa-file-excel me-1 d-none d-sm-inline"></i> Ekspor
                </button>
            </div>
        </div>
    </div>

    <!-- Filter Bar -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <form action="<?= BASEURL; ?>/admin/laporan" method="get" id="filterForm">
                <div class="row g-3 align-items-end">
                    <div class="col-12 col-md-4">
                        <label class="form-label small fw-bold text-muted">Rentang Tanggal</label>
                        <div class="input-group bg-light rounded-3 px-3 border">
                            <span class="input-group-text bg-transparent border-0 text-muted"><i class="far fa-calendar-alt"></i></span>
                            <input type="text" name="range_date" id="range_date" class="form-control bg-transparent border-0 ps-0" placeholder="Pilih Tanggal" value="<?= isset($_GET['range_date']) ? $_GET['range_date'] : date('Y-m-01') . ' to ' . date('Y-m-t'); ?>" style="font-size: 13px; height: 40px;">
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <label class="form-label small fw-bold text-muted">Status Pesanan</label>
                        <select name="status" class="form-select bg-light border rounded-3 w-100" style="height: 44px; font-size: 13px;" onchange="this.form.submit()">
                            <option value="">Semua Status</option>
                            <option value="pending" <?= (isset($_GET['status']) && $_GET['status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                            <option value="diproses" <?= (isset($_GET['status']) && $_GET['status'] == 'diproses') ? 'selected' : ''; ?>>Diproses</option>
                            <option value="selesai" <?= (isset($_GET['status']) && $_GET['status'] == 'selesai') ? 'selected' : ''; ?>>Selesai</option>
                            <option value="dibatalkan" <?= (isset($_GET['status']) && $_GET['status'] == 'dibatalkan') ? 'selected' : ''; ?>>Dibatalkan</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-3">
                        <label class="form-label small fw-bold text-muted">Metode</label>
                        <select name="bayar" class="form-select bg-light border rounded-3 w-100" style="height: 44px; font-size: 13px;" onchange="this.form.submit()">
                            <option value="">Semua Metode</option>
                            <?php foreach($data['metode_pembayaran'] as $mp): ?>
                            <option value="<?= $mp['nama_metode']; ?>" <?= (isset($_GET['bayar']) && $_GET['bayar'] == $mp['nama_metode']) ? 'selected' : ''; ?>>
                                <?= $mp['nama_metode']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12 col-md-2">
                        <button type="submit" class="btn btn-danger w-100 rounded-3 fw-bold shadow-sm" style="height: 44px;">
                            <i class="fas fa-search me-2"></i> Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row g-3 mb-4 flex-nowrap flex-md-wrap stat-slider pb-2">
        <div class="col-10 col-sm-6 col-md-4">
            <div class="card border-0 shadow-sm rounded-4 bg-danger" style="background: linear-gradient(135deg, #A30D11 0%, #D82D33 100%);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="text-white text-opacity-75 small fw-bold">Total Pendapatan</div>
                        <i class="fas fa-wallet text-white text-opacity-25 fs-3"></i>
                    </div>
                    <h3 class="text-white fw-bold mb-1">Rp <?= number_format($data['stats']['revenue'], 0, ',', '.'); ?></h3>
                    <p class="text-white text-opacity-50 small mb-0">Berdasarkan pesanan lunas</p>
                </div>
            </div>
        </div>
        <div class="col-10 col-sm-6 col-md-4">
            <div class="card border-0 shadow-sm rounded-4 bg-white d-flex align-items-center justify-content-center" style="height: 130px;">
                <div class="card-body p-3 text-center w-100">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle mx-auto mb-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-shopping-cart fs-5"></i>
                    </div>
                    <h4 class="fw-bold mb-0"><?= $data['stats']['orders']; ?></h4>
                    <p class="text-muted small mb-0" style="font-size: 11px;">Total Pesanan</p>
                </div>
            </div>
        </div>
        <div class="col-10 col-sm-6 col-md-4">
            <div class="card border-0 shadow-sm rounded-4 bg-white d-flex align-items-center justify-content-center" style="height: 130px;">
                <div class="card-body p-3 text-center w-100">
                    <div class="bg-success bg-opacity-10 text-success rounded-circle mx-auto mb-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-chart-line fs-5"></i>
                    </div>
                    <?php $avg = $data['stats']['orders'] > 0 ? $data['stats']['revenue'] / $data['stats']['orders'] : 0; ?>
                    <h4 class="fw-bold mb-0">Rp <?= number_format($avg, 0, ',', '.'); ?></h4>
                    <p class="text-muted small mb-0" style="font-size: 11px;">Rata-rata Nilai Pesanan</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-white border-0 p-4">
            <h6 class="fw-bold mb-0 text-dark">Rincian Transaksi</h6>
        </div>
        <div class="table-responsive">
            <table class="table mb-0 align-middle">
                <thead style="background-color: #F9FAFB;">
                    <tr>
                        <th class="ps-4 py-3 text-muted small border-0">Kode Pesanan</th>
                        <th class="py-3 text-muted small border-0">Pelanggan</th>
                        <th class="py-3 text-muted small border-0">Waktu</th>
                        <th class="py-3 text-muted small border-0 text-center">Tipe</th>
                        <th class="py-3 text-muted small border-0">Metode</th>
                        <th class="py-3 text-muted small border-0 text-end">Total</th>
                        <th class="py-3 text-muted small border-0 text-center pe-4">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($data['laporan'])): ?>
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                            <div class="d-flex justify-content-center mb-3">
                                <lottie-player src="https://lottie.host/43175727-af87-4ec3-8983-a1e333bd6c6e/jOkbHstFj3.json" background="transparent" speed="1" style="width: 200px; height: 200px;" loop autoplay></lottie-player>
                            </div>
                            <h6 class="fw-bold text-dark">Data Masih Kosong Nih...</h6>
                            <p class="text-muted small">Coba pilih rentang tanggal atau status lain untuk melihat laporan.</p>
                        </td>
                    </tr>
                    <?php else: ?>
                        <?php foreach($data['laporan'] as $row): 
                            $st_color = 'secondary';
                            if($row['status_pesanan'] == 'selesai') $st_color = 'success';
                            elseif($row['status_pesanan'] == 'diproses') $st_color = 'primary';
                            elseif($row['status_pesanan'] == 'pending') $st_color = 'warning';
                            elseif($row['status_pesanan'] == 'dibatalkan') $st_color = 'danger';
                        ?>
                        <tr class="border-bottom border-light">
                            <td class="ps-4 py-3 fw-bold text-dark">#<?= $row['kode_pesanan']; ?></td>
                            <td class="py-3">
                                <div class="fw-bold"><?= $row['nama_pelanggan'] ?: 'Meja '.$row['nomor_meja']; ?></div>
                                <div class="text-muted small" style="font-size: 11px;"><?= $row['no_telp'] ?: '-'; ?></div>
                            </td>
                            <td class="py-3 small text-muted">
                                <?= date('d M Y', strtotime($row['created_at'])); ?><br>
                                <?= date('H:i', strtotime($row['created_at'])); ?> WIB
                            </td>
                            <td class="py-3 text-center">
                                <span class="badge bg-light text-dark rounded-pill px-3 py-1 fw-bold" style="font-size: 10px;"><?= ucfirst($row['tipe_pesanan'] ?? 'Dine-in'); ?></span>
                            </td>
                            <td class="py-3">
                                <div class="fw-bold small text-dark"><?= strtoupper($row['metode_bayar']); ?></div>
                                <div class="text-muted" style="font-size: 9px;"><?= strtoupper(str_replace('_', ' ', $row['status_bayar'])); ?></div>
                            </td>
                            <td class="py-3 text-end fw-bold text-danger">Rp <?= number_format($row['total_harga'], 0, ',', '.'); ?></td>
                            <td class="py-3 text-center pe-4">
                                <span class="badge bg-<?= $st_color; ?> bg-opacity-10 text-<?= $st_color; ?> rounded-pill px-3 py-2 fw-bold" style="font-size: 10px;"><?= ucfirst($row['status_pesanan']); ?></span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
<style>
    @media (max-width: 767px) {
        .stat-slider {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none; /* Firefox */
            scroll-snap-type: x mandatory;
        }
        .stat-slider::-webkit-scrollbar {
            display: none; /* Chrome, Safari, Opera */
        }
        .stat-slider > div {
            scroll-snap-align: start;
        }
    }
</style>
