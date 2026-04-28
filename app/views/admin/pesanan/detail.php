<div class="container-fluid px-4 py-3">
    <!-- Header Area -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <a href="<?= BASEURL; ?>/admin/pesanan" class="btn btn-white shadow-sm rounded-circle me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-arrow-left text-muted"></i>
            </a>
            <div>
                <h4 class="fw-bold mb-0">Detail Pesanan #<?= $data['pesanan']['kode_pesanan']; ?></h4>
                <p class="text-muted small mb-0"><?= date('d F Y, H:i', strtotime($data['pesanan']['created_at'])); ?></p>
            </div>
        </div>
        <div class="d-flex gap-2">
            <button onclick="window.print()" class="btn btn-outline-dark shadow-sm px-4 fw-bold rounded-3">
                <i class="fas fa-print me-2"></i> Cetak Struk
            </button>
            <?php if($data['pesanan']['status_pesanan'] != 'selesai' && $data['pesanan']['status_pesanan'] != 'dibatalkan'): ?>
            <form id="formBatalDetail" action="<?= BASEURL; ?>/admin/update_status_pesanan" method="post">
                <input type="hidden" name="id" value="<?= $data['pesanan']['id']; ?>">
                <input type="hidden" name="status" value="dibatalkan">
                <button type="button" class="btn btn-light text-danger shadow-sm px-4 fw-bold rounded-3" onclick="confirmBatalDetail()">Batalkan</button>
            </form>

            <script>
                function confirmBatalDetail() {
                    Swal.fire({
                        title: 'Batalkan Pesanan?',
                        text: "Aksi ini akan membatalkan pesanan secara permanen.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#A30D11',
                        cancelButtonColor: '#6e7881',
                        confirmButtonText: 'Ya, Batalkan!',
                        cancelButtonText: 'Kembali',
                        borderRadius: '20px'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('formBatalDetail').submit();
                        }
                    });
                }

                function confirmVerifikasi(status) {
                    const isTerima = status === 'terima';
                    Swal.fire({
                        title: isTerima ? 'Validasi Pembayaran?' : 'Tolak Pembayaran?',
                        text: isTerima ? "Pastikan bukti transfer sudah sesuai dengan total tagihan." : "Berikan alasan penolakan (opsional) jika bukti tidak valid.",
                        icon: isTerima ? 'success' : 'warning',
                        showCancelButton: true,
                        confirmButtonColor: isTerima ? '#27AE60' : '#A30D11',
                        cancelButtonColor: '#6e7881',
                        confirmButtonText: isTerima ? 'Ya, Valid!' : 'Ya, Tolak',
                        cancelButtonText: 'Kembali',
                        borderRadius: '20px'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            if(isTerima) {
                                document.getElementById('formTerimaBayar').submit();
                            } else {
                                document.getElementById('formTolakBayar').submit();
                            }
                        }
                    });
                }
            </script>
            <?php endif; ?>
        </div>
    </div>

    <div class="row g-4">
        <!-- Left: Order Items & Summary -->
        <div class="col-lg-8">
            <!-- Items Card -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-4 border-bottom pb-2"><i class="fas fa-list me-2 text-danger"></i> Item Pesanan</h6>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0">Produk</th>
                                    <th class="border-0 text-center">Harga</th>
                                    <th class="border-0 text-center">Qty</th>
                                    <th class="border-0 text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($data['items'] as $item): ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="<?= BASEURL; ?>/assets/img/produk/<?= $item['foto'] ?: 'default.png'; ?>" class="rounded-3 me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                            <div>
                                                <h6 class="fw-bold mb-0 small"><?= $item['nama']; ?></h6>
                                                <small class="text-muted" style="font-size: 10px;">Item ID: #<?= $item['produk_id']; ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center small">Rp <?= number_format($item['harga_satuan'], 0, ',', '.'); ?></td>
                                    <td class="text-center fw-bold"><?= $item['qty']; ?></td>
                                    <td class="text-end fw-bold text-dark">Rp <?= number_format($item['subtotal'], 0, ',', '.'); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot class="border-top-0">
                                <tr>
                                    <td colspan="3" class="text-end fw-bold pt-4">Subtotal :</td>
                                    <td class="text-end fw-bold pt-4">Rp <?= number_format($data['pesanan']['total_harga'] - $data['pesanan']['ongkir'], 0, ',', '.'); ?></td>
                                </tr>
                                <?php if($data['pesanan']['ongkir'] > 0): ?>
                                <tr>
                                    <td colspan="3" class="text-end text-muted small">Biaya Pengiriman :</td>
                                    <td class="text-end text-muted small">Rp <?= number_format($data['pesanan']['ongkir'], 0, ',', '.'); ?></td>
                                </tr>
                                <?php endif; ?>
                                <tr>
                                    <td colspan="3" class="text-end fs-5 fw-800 text-danger">Total Pembayaran :</td>
                                    <td class="text-end fs-5 fw-800 text-danger">Rp <?= number_format($data['pesanan']['total_harga'], 0, ',', '.'); ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Notes Card -->
            <?php if(!empty($data['pesanan']['catatan'])): ?>
            <div class="card border-0 shadow-sm rounded-4 bg-light bg-opacity-50 border border-dashed p-4">
                <h6 class="fw-bold mb-2"><i class="fas fa-sticky-note me-2 text-warning"></i> Catatan Pelanggan:</h6>
                <p class="mb-0 text-muted small italic">"<?= $data['pesanan']['catatan']; ?>"</p>
            </div>
            <?php endif; ?>
        </div>

        <!-- Right: Status & Customer Info -->
        <div class="col-lg-4">
            <!-- Customer Card -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-4 border-bottom pb-2 text-primary"><i class="fas fa-user me-2"></i> Informasi Pelanggan</h6>
                    <div class="mb-3">
                        <label class="small text-muted mb-1 d-block">Nama Lengkap</label>
                        <h6 class="fw-bold"><?= $data['pesanan']['nama_pelanggan'] ?: 'Pelanggan Umum'; ?></h6>
                    </div>
                    <div class="mb-3">
                        <label class="small text-muted mb-1 d-block">Nomor Telepon</label>
                        <h6 class="fw-bold"><i class="fab fa-whatsapp text-success me-1"></i> <?= $data['pesanan']['no_telp'] ?: '-'; ?></h6>
                    </div>
                    <div class="mb-3">
                        <label class="small text-muted mb-1 d-block">Tipe Pesanan</label>
                        <span class="badge bg-danger rounded-pill px-3 py-2 text-capitalize"><?= $data['pesanan']['tipe_pesanan']; ?></span>
                    </div>
                    <?php if($data['pesanan']['tipe_pesanan'] == 'dine-in'): ?>
                    <div class="mb-0">
                        <label class="small text-muted mb-1 d-block">Nomor Meja</label>
                        <h6 class="fw-bold text-danger fs-4 mb-0">MEJA #<?= $data['pesanan']['nomor_meja'] ?: '-'; ?></h6>
                    </div>
                    <?php else: ?>
                    <div class="mb-0">
                        <label class="small text-muted mb-1 d-block">Alamat Pengantaran</label>
                        <p class="small mb-0 text-dark"><?= $data['pesanan']['alamat_pengantaran'] ?: 'Ambil di Toko'; ?></p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Payment Status Card -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-4 border-bottom pb-2 text-success"><i class="fas fa-wallet me-2"></i> Status Pembayaran</h6>
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <span class="text-muted small">Metode Bayar</span>
                        <span class="badge bg-light text-dark border px-3 py-2 rounded-pill text-uppercase" style="font-size: 10px;"><?= $data['pesanan']['metode_bayar']; ?></span>
                    </div>
                    
                    <div class="text-center p-3 rounded-4 bg-<?= $data['pesanan']['status_bayar'] == 'lunas' ? 'success' : 'warning'; ?> bg-opacity-10 mb-4">
                        <h5 class="fw-bold text-<?= $data['pesanan']['status_bayar'] == 'lunas' ? 'success' : 'warning'; ?> mb-1">
                            <?= strtoupper(str_replace('_', ' ', $data['pesanan']['status_bayar'])); ?>
                        </h5>
                        <p class="small text-muted mb-0">Status Keuangan</p>
                    </div>

                    <?php if($data['pesanan']['status_bayar'] == 'menunggu_verifikasi' && !empty($data['pembayaran'])): ?>
                        <div class="border rounded-3 p-3 mb-4 text-center">
                            <p class="small fw-bold mb-2">Bukti Pembayaran:</p>
                            <a href="<?= BASEURL; ?>/assets/img/bukti_pembayaran/<?= $data['pembayaran']['bukti_foto']; ?>" target="_blank">
                                <img src="<?= BASEURL; ?>/assets/img/bukti_pembayaran/<?= $data['pembayaran']['bukti_foto']; ?>" class="img-fluid rounded-3 border" style="max-height: 150px;">
                            </a>
                            <div class="d-grid gap-2 mt-3">
                                <form action="<?= BASEURL; ?>/admin/verifikasi_pembayaran" method="post" id="formTerimaBayar">
                                    <input type="hidden" name="id" value="<?= $data['pembayaran']['id']; ?>">
                                    <input type="hidden" name="status" value="diterima">
                                    <button type="button" class="btn btn-success btn-sm fw-bold rounded-3 w-100 mb-2" onclick="confirmVerifikasi('terima')">
                                        <i class="fas fa-check-circle me-1"></i> Terima & Validasi
                                    </button>
                                </form>
                                <form action="<?= BASEURL; ?>/admin/verifikasi_pembayaran" method="post" id="formTolakBayar">
                                    <input type="hidden" name="id" value="<?= $data['pembayaran']['id']; ?>">
                                    <input type="hidden" name="status" value="ditolak">
                                    <button type="button" class="btn btn-outline-danger btn-sm fw-bold rounded-3 w-100" onclick="confirmVerifikasi('tolak')">
                                        <i class="fas fa-times-circle me-1"></i> Tolak Bukti
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="d-grid gap-2">
                        <?php if($data['pesanan']['status_pesanan'] == 'pending'): ?>
                        <form action="<?= BASEURL; ?>/admin/update_status_pesanan" method="post">
                            <input type="hidden" name="id" value="<?= $data['pesanan']['id']; ?>">
                            <input type="hidden" name="status" value="diproses">
                            <button type="submit" class="btn btn-danger w-100 py-3 fw-bold rounded-4 shadow">
                                <i class="fas fa-fire me-2"></i> MULAI PROSES MASAK
                            </button>
                        </form>
                        <?php elseif($data['pesanan']['status_pesanan'] == 'diproses'): ?>
                        <form action="<?= BASEURL; ?>/admin/update_status_pesanan" method="post">
                            <input type="hidden" name="id" value="<?= $data['pesanan']['id']; ?>">
                            <input type="hidden" name="status" value="selesai">
                            <button type="submit" class="btn btn-success w-100 py-3 fw-bold rounded-4 shadow">
                                <i class="fas fa-check-double me-2"></i> PESANAN SELESAI
                            </button>
                        </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .fw-800 { font-weight: 800; }
    .border-dashed { border: 2px dashed #e5e7eb !important; }
    @media print {
        #sidebar-wrapper, .navbar, .btn, .breadcrumb, .card-footer { display: none !important; }
        .container-fluid { padding: 0 !important; margin: 0 !important; }
        .card { border: none !important; box-shadow: none !important; }
        .col-lg-4 { display: none; }
        .col-lg-8 { width: 100% !important; }
    }
</style>
