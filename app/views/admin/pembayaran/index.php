
    <?php Flasher::flash(); ?>
    <!-- Header Area -->
    <div class="row align-items-center mb-4 g-3">
        <div class="col-md-8">
            <h4 class="fw-bold mb-1">Verifikasi Pembayaran</h4>
            <p class="text-muted small mb-0">Kelola dan validasi bukti transfer pelanggan</p>
        </div>
        <div class="col-md-4 text-md-end">
            <button class="btn btn-outline-danger rounded-3 fw-bold shadow-sm w-100 w-md-auto" onclick="location.reload()">
                <i class="fas fa-sync-alt me-2"></i> Refresh Data
            </button>
        </div>
    </div>

    <!-- Summary Stats -->
    <div class="row g-4 mb-4 flex-nowrap flex-md-wrap stat-slider pb-2">
        <?php 
        $pending = 0; $success = 0; $rejected = 0;
        foreach($data['pembayaran'] as $p) {
            if($p['status'] == 'pending') $pending++;
            elseif($p['status'] == 'diterima') $success++;
            elseif($p['status'] == 'ditolak') $rejected++;
        }
        ?>
        <div class="col-10 col-sm-6 col-md-4">
            <div class="stat-card-premium">
                <div class="card-body p-4 position-relative">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="icon-box-premium box-orange">
                            <i class="fas fa-clock"></i>
                        </div>
                        <span class="stat-badge badge-orange">MENUNGGU</span>
                    </div>
                    <div class="stat-value-new"><?= $pending; ?></div>
                    <div class="stat-label-new text-muted mt-1">Pembayaran Pending</div>
                    <div class="card-glow orange-glow" style="opacity: 0.1;"></div>
                </div>
            </div>
        </div>
        <div class="col-10 col-sm-6 col-md-4">
            <div class="stat-card-premium">
                <div class="card-body p-4 position-relative">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="icon-box-premium box-green">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <span class="stat-badge badge-green">DITERIMA</span>
                    </div>
                    <div class="stat-value-new"><?= $success; ?></div>
                    <div class="stat-label-new text-muted mt-1">Pembayaran Berhasil</div>
                    <div class="card-glow green-glow" style="opacity: 0.1;"></div>
                </div>
            </div>
        </div>
        <div class="col-10 col-sm-6 col-md-4">
            <div class="stat-card-premium">
                <div class="card-body p-4 position-relative">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="icon-box-premium box-red">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <span class="stat-badge badge-red">DITOLAK</span>
                    </div>
                    <div class="stat-value-new"><?= $rejected; ?></div>
                    <div class="stat-label-new text-muted mt-1">Pembayaran Ditolak</div>
                    <div class="card-glow red-glow" style="opacity: 0.1;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Card -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-white border-bottom p-4">
            <div class="row g-3 align-items-center">
                <div class="col-md-6">
                    <h6 class="fw-bold mb-0"><i class="fas fa-list me-2 text-danger"></i> Daftar Transaksi Terbaru</h6>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="btn-group rounded-pill overflow-hidden shadow-sm border p-1 bg-light">
                        <button class="btn btn-sm px-3 fw-bold btn-white shadow-sm filter-btn active" data-status="all">Semua</button>
                        <button class="btn btn-sm px-3 fw-bold filter-btn" data-status="pending">Pending</button>
                        <button class="btn btn-sm px-3 fw-bold filter-btn" data-status="diterima">Berhasil</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="tablePembayaran">
                    <thead class="bg-light bg-opacity-50">
                        <tr>
                            <th class="ps-4 py-3 border-0 small fw-bold text-muted">TANGGAL & WAKTU</th>
                            <th class="py-3 border-0 small fw-bold text-muted">PELANGGAN</th>
                            <th class="py-3 border-0 small fw-bold text-muted">NOMINAL</th>
                            <th class="py-3 border-0 small fw-bold text-muted">BUKTI</th>
                            <th class="py-3 border-0 small fw-bold text-muted text-center">STATUS</th>
                            <th class="pe-4 py-3 border-0 small fw-bold text-muted text-center">TINDAKAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($data['pembayaran'])): ?>
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="opacity-25 mb-3">
                                    <i class="fas fa-money-bill-wave fa-4x"></i>
                                </div>
                                <h6 class="fw-bold text-muted">Belum ada data pembayaran</h6>
                                <p class="small text-muted mb-0">Semua riwayat transaksi akan muncul di sini</p>
                            </td>
                        </tr>
                        <?php endif; ?>

                        <?php foreach($data['pembayaran'] as $p): ?>
                        <tr class="payment-row" data-status="<?= $p['status']; ?>">
                            <td class="ps-4">
                                <div class="fw-bold text-dark"><?= date('d M Y', strtotime($p['created_at'])); ?></div>
                                <div class="text-muted" style="font-size: 11px;"><i class="far fa-clock me-1"></i><?= date('H:i', strtotime($p['created_at'])); ?> WIB</div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-danger bg-opacity-10 text-danger rounded-circle me-3 d-flex align-items-center justify-content-center fw-bold" style="width: 32px; height: 32px; font-size: 12px;">
                                        <?= substr($p['nama_pelanggan'], 0, 1); ?>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark"><?= $p['nama_pelanggan']; ?></div>
                                        <div class="badge bg-light text-dark border-0 small" style="font-size: 10px;"><?= $p['kode_pesanan']; ?></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="fw-800 text-danger">Rp <?= number_format($p['total_harga'], 0, ',', '.'); ?></div>
                            </td>
                            <td>
                                <?php if(!empty($p['bukti_foto'])): ?>
                                    <button type="button" class="btn btn-sm btn-light border rounded-pill px-3 shadow-sm hover-up-sm" data-bs-toggle="modal" data-bs-target="#modalFoto<?= $p['id']; ?>">
                                        <i class="fas fa-eye me-1 text-primary"></i> <span class="small fw-bold">Cek Bukti</span>
                                    </button>
                                <?php elseif($p['metode_bayar'] == 'cash'): ?>
                                    <div class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-bold border border-primary border-opacity-25" style="font-size: 10px;">
                                        <i class="fas fa-money-bill-wave me-1"></i> Bayar di Kasir
                                    </div>
                                <?php else: ?>
                                    <div class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill fw-bold border border-warning border-opacity-25" style="font-size: 10px;">
                                        <i class="fas fa-hourglass-half me-1"></i> Menunggu Upload
                                    </div>
                                <?php endif; ?>
                                
                                <!-- Modal View Foto Premium -->
                                <div class="modal fade" id="modalFoto<?= $p['id']; ?>" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 rounded-5 overflow-hidden shadow-lg">
                                            <div class="modal-header bg-danger p-4 border-0 position-relative">
                                                <div class="z-1">
                                                    <h6 class="modal-title fw-bold text-white mb-0">Bukti Transfer #<?= $p['kode_pesanan']; ?></h6>
                                                    <p class="text-white opacity-75 mb-0 small"><?= $p['nama_pelanggan']; ?> - Rp <?= number_format($p['total_harga'], 0, ',', '.'); ?></p>
                                                </div>
                                                <button type="button" class="btn-close btn-close-white z-1" data-bs-dismiss="modal" aria-label="Close"></button>
                                                <div class="card-glow white-glow opacity-25" style="top: -20px; right: -20px;"></div>
                                            </div>
                                            <div class="modal-body text-center p-4 bg-light">
                                                <div class="bg-white p-2 rounded-4 shadow-sm inline-block">
                                                    <?php if(!empty($p['bukti_foto'])): ?>
                                                        <img src="<?= BASEURL; ?>/assets/img/bukti_pembayaran/<?= $p['bukti_foto']; ?>" class="img-fluid rounded-3" alt="Bukti Transfer" style="max-height: 500px;">
                                                    <?php else: ?>
                                                        <div class="py-5 px-4 text-center">
                                                            <i class="fas fa-image fa-4x text-muted opacity-25 mb-3"></i>
                                                            <h6 class="fw-bold text-muted">Belum Ada Bukti</h6>
                                                            <p class="small text-muted mb-0">Pelanggan belum mengunggah foto bukti transfer.</p>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="modal-footer border-0 p-4 pt-0 bg-light justify-content-center">
                                                <a href="<?= BASEURL; ?>/assets/img/bukti_pembayaran/<?= $p['bukti_foto']; ?>" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill px-4 fw-bold">
                                                    <i class="fas fa-external-link-alt me-1"></i> Buka Ukuran Penuh
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <?php 
                                $badge_class = 'box-orange text-orange';
                                $status_text = 'Menunggu';
                                if($p['status'] == 'diterima') {
                                    $badge_class = 'box-green text-green';
                                    $status_text = 'Diterima';
                                } elseif($p['status'] == 'ditolak') {
                                    $badge_class = 'box-red text-red';
                                    $status_text = 'Ditolak';
                                }
                                ?>
                                <div class="icon-box-premium <?= $badge_class; ?> mx-auto shadow-none" style="width: auto; height: auto; padding: 6px 16px; border-radius: 20px;">
                                    <span class="small fw-800" style="font-size: 10px;"><?= strtoupper($status_text); ?></span>
                                </div>
                            </td>
                            <td class="pe-4 text-center">
                                <?php if($p['status'] == 'pending'): ?>
                                <div class="d-flex gap-2 justify-content-center">
                                    <button type="button" class="btn btn-success btn-sm rounded-pill px-3 fw-bold shadow-sm hover-up-sm" onclick="confirmVerif(<?= $p['id']; ?>, 'diterima')">
                                        <i class="fas fa-check me-1"></i> Terima
                                    </button>
                                    <button type="button" class="btn btn-outline-danger btn-sm rounded-pill px-3 fw-bold hover-up-sm" onclick="confirmVerif(<?= $p['id']; ?>, 'ditolak')">
                                        <i class="fas fa-times me-1"></i> Tolak
                                    </button>
                                </div>
                                <?php else: ?>
                                <div class="text-muted small px-3 py-1 bg-light rounded-pill d-inline-block" style="font-size: 10px; font-style: italic;">
                                    <i class="fas fa-check-double me-1"></i> Sudah diproses
                                </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-top p-4">
            <div class="d-flex justify-content-between align-items-center">
                <p class="text-muted small mb-0">Menampilkan <span class="fw-bold"><?= count($data['pembayaran']); ?></span> riwayat pembayaran terbaru.</p>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-light border rounded-pill px-3 shadow-sm disabled">Sebelumnya</button>
                    <button class="btn btn-sm btn-light border rounded-pill px-3 shadow-sm disabled">Selanjutnya</button>
                </div>
            </div>
        </div>
    </div>

<!-- Form Hidden for Verification -->
<form id="formVerif" action="<?= BASEURL; ?>/admin/verifikasi_pembayaran" method="POST" style="display: none;">
    <input type="hidden" name="id" id="verifId">
    <input type="hidden" name="status" id="verifStatus">
</form>

<style>
    .fw-800 { font-weight: 800; }
    .hover-up-sm { transition: all 0.2s ease; }
    .hover-up-sm:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important; }
    
    .btn-white { background: #fff; color: #333; }
    .filter-btn { border: none; transition: 0.3s; color: #666; }
    .filter-btn.active { color: #A30D11; }
    
    .avatar-sm { border: 2px solid #fff; shadow: 0 2px 5px rgba(0,0,0,0.1); }
    
    .inline-block { display: inline-block; }
    
    /* Table Responsive Style */
    .table-hover tbody tr:hover {
        background-color: rgba(163, 13, 17, 0.02) !important;
    }

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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmVerif(id, status) {
        const title = status === 'diterima' ? 'Terima Pembayaran?' : 'Tolak Pembayaran?';
        const text = status === 'diterima' ? 'Pastikan nominal transfer sudah sesuai dengan total tagihan.' : 'Berikan alasan penolakan jika perlu.';
        const icon = status === 'diterima' ? 'question' : 'warning';
        const confirmColor = status === 'diterima' ? '#27AE60' : '#A30D11';

        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            showCancelButton: true,
            confirmButtonColor: confirmColor,
            cancelButtonColor: '#6e7881',
            confirmButtonText: 'Ya, Lanjutkan!',
            cancelButtonText: 'Batal',
            borderRadius: '20px'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('verifId').value = id;
                document.getElementById('verifStatus').value = status;
                document.getElementById('formVerif').submit();
            }
        });
    }

    // Filter Logic
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            // UI Toggle
            document.querySelectorAll('.filter-btn').forEach(b => {
                b.classList.remove('active', 'btn-white', 'shadow-sm');
            });
            this.classList.add('active', 'btn-white', 'shadow-sm');

            const status = this.dataset.status;
            document.querySelectorAll('.payment-row').forEach(row => {
                if(status === 'all' || row.dataset.status === status) {
                    row.style.display = 'table-row';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
</script>
