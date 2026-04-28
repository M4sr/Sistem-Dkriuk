
    <!-- Header Area -->
    <div class="row align-items-center mb-4 g-3">
        <div class="col-md-8">
            <h4 class="fw-bold mb-1">Pengaturan Toko</h4>
            <p class="text-muted small mb-0">Kelola identitas dan operasional SI Fried Chicken</p>
        </div>
        <div class="col-md-4 text-md-end">
            <button type="submit" form="formPengaturan" class="btn btn-danger rounded-3 px-4 fw-bold shadow-sm w-100 w-md-auto">
                <i class="fas fa-save me-2"></i> Simpan
            </button>
        </div>
    </div>

    <!-- Tabs Navigation -->
    <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
        <div class="card-body p-0">
            <ul class="nav nav-pills nav-fill bg-light p-2 flex-nowrap stat-slider" id="settingsTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active fw-bold py-3 rounded-3" id="profil-tab" data-bs-toggle="tab" data-bs-target="#profil" type="button" role="tab" title="Profil Toko">
                        <i class="fas fa-store me-0 me-md-2"></i> <span class="d-none d-md-inline">Profil Toko</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold py-3 rounded-3" id="bisnis-tab" data-bs-toggle="tab" data-bs-target="#bisnis" type="button" role="tab" title="Operasional & Biaya">
                        <i class="fas fa-briefcase me-0 me-md-2"></i> <span class="d-none d-md-inline">Operasional & Biaya</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold py-3 rounded-3" id="pembayaran-tab" data-bs-toggle="tab" data-bs-target="#pembayaran" type="button" role="tab" title="Metode Pembayaran">
                        <i class="fas fa-credit-card me-0 me-md-2"></i> <span class="d-none d-md-inline">Metode Pembayaran</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold py-3 rounded-3" id="tampilan-tab" data-bs-toggle="tab" data-bs-target="#tampilan" type="button" role="tab" title="Tampilan">
                        <i class="fas fa-paint-brush me-0 me-md-2"></i> <span class="d-none d-md-inline">Tampilan</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold py-3 rounded-3" id="keamanan-tab" data-bs-toggle="tab" data-bs-target="#keamanan" type="button" role="tab" title="Keamanan Akun">
                        <i class="fas fa-shield-alt me-0 me-md-2"></i> <span class="d-none d-md-inline">Keamanan Akun</span>
                    </button>
                </li>
            </ul>
        </div>
    </div>

    <!-- Tab Content -->
    <form action="<?= BASEURL; ?>/admin/proses_update_pengaturan" method="post" id="formPengaturan" enctype="multipart/form-data">
        <div class="tab-content" id="settingsTabContent">
            
            <!-- Tab Profil -->
            <div class="tab-pane fade show active" id="profil" role="tabpanel">
                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body p-4">
                                <h6 class="fw-bold mb-4 border-bottom pb-2 text-danger"><i class="fas fa-info-circle me-2"></i> Informasi Dasar</h6>
                                <div class="mb-4">
                                    <label class="form-label small fw-bold">Nama Toko</label>
                                    <input type="text" name="nama_toko" class="form-control rounded-3 py-2" value="<?= $data['pengaturan']['nama_toko']; ?>">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label small fw-bold">Alamat Lengkap</label>
                                    <textarea name="alamat_toko" class="form-control rounded-3" rows="3"><?= $data['pengaturan']['alamat_toko']; ?></textarea>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Nomor Telepon/WA</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0 rounded-start-3"><i class="fab fa-whatsapp text-success"></i></span>
                                            <input type="text" name="no_telp" class="form-control rounded-end-3 py-2 border-start-0" value="<?= $data['pengaturan']['no_telp']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Link Google Maps</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0 rounded-start-3"><i class="fas fa-map-marker-alt text-danger"></i></span>
                                            <input type="text" name="maps_link" class="form-control rounded-end-3 py-2 border-start-0" value="<?= $data['pengaturan']['maps_link']; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-body p-4 text-center">
                                <h6 class="fw-bold mb-4 text-start border-bottom pb-2"><i class="fas fa-image me-2"></i> Logo Toko</h6>
                                <div class="bg-light rounded-4 p-4 mb-3 mx-auto shadow-inner" style="width: 150px; height: 150px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                    <?php 
                                    $logo = !empty($data['pengaturan']['logo']) ? BASEURL . '/assets/img/logo/' . $data['pengaturan']['logo'] : ''; 
                                    ?>
                                    <img id="logoPreview" src="<?= $logo; ?>" class="img-fluid rounded-3" alt="Logo" onerror="this.src='https://ui-avatars.com/api/?name=<?= urlencode($data['pengaturan']['nama_toko']); ?>&background=A30D11&color=fff&size=128'">
                                </div>
                                <input type="file" name="logo_toko" id="inputLogo" class="d-none" accept="image/*">
                                <button type="button" class="btn btn-outline-danger btn-sm rounded-pill px-4 fw-bold shadow-sm" onclick="document.getElementById('inputLogo').click()">
                                    <i class="fas fa-camera me-2"></i> Ganti Logo
                                </button>
                                <p class="text-muted mt-3 small" style="font-size: 10px;">Format: PNG, JPG (Maks. 2MB). Rekomendasi 512x512 px.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab Bisnis -->
            <div class="tab-pane fade" id="bisnis" role="tabpanel">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body p-4">
                                <h6 class="fw-bold mb-4 border-bottom pb-2 text-warning"><i class="fas fa-clock me-2"></i> Jam Operasional</h6>
                                <div class="row g-3 mb-4">
                                    <div class="col-6">
                                        <label class="form-label small fw-bold">Buka Pukul</label>
                                        <input type="time" name="jam_buka" class="form-control rounded-3 py-2" value="<?= $data['pengaturan']['jam_buka']; ?>">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label small fw-bold">Tutup Pukul</label>
                                        <input type="time" name="jam_tutup" class="form-control rounded-3 py-2" value="<?= $data['pengaturan']['jam_tutup']; ?>">
                                    </div>
                                </div>
                                <div>
                                    <label class="form-label small fw-bold">Status Toko</label>
                                    <select name="status_toko" class="form-select rounded-3 py-2">
                                        <option value="buka" <?= ($data['pengaturan']['status_toko'] == 'buka') ? 'selected' : ''; ?>>Buka (Menerima Pesanan)</option>
                                        <option value="tutup" <?= ($data['pengaturan']['status_toko'] == 'tutup') ? 'selected' : ''; ?>>Tutup (Hanya Katalog)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body p-4">
                                <h6 class="fw-bold mb-4 border-bottom pb-2 text-success"><i class="fas fa-coins me-2"></i> Biaya & Pajak</h6>
                                <div class="mb-4">
                                    <label class="form-label small fw-bold">Biaya Ongkir (per KM)</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 rounded-start-3 fw-bold">Rp</span>
                                        <input type="number" name="ongkir_per_km" class="form-control rounded-end-3 py-2 border-start-0" value="<?= $data['pengaturan']['ongkir_per_km']; ?>">
                                    </div>
                                </div>
                                <div class="mb-0">
                                    <label class="form-label small fw-bold">Pajak Restoran (PB1)</label>
                                    <div class="input-group">
                                        <input type="number" name="pajak_persen" class="form-control rounded-start-3 py-2 border-end-0" value="<?= $data['pengaturan']['pajak_persen']; ?>">
                                        <span class="input-group-text bg-light border-start-0 rounded-end-3 fw-bold">%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab Pembayaran -->
            <div class="tab-pane fade" id="pembayaran" role="tabpanel">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="fw-bold mb-0 text-danger"><i class="fas fa-credit-card me-2"></i> Kelola Metode Pembayaran</h6>
                    <button type="button" class="btn btn-outline-danger btn-sm rounded-pill px-4 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahMetode">
                        <i class="fas fa-plus-circle me-2"></i> Tambah Metode Baru
                    </button>
                </div>

                <div class="row g-3">
                    <?php foreach($data['metode_pembayaran'] as $m): ?>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card border-0 shadow-sm rounded-4 position-relative overflow-hidden transition-all hover-up h-100">
                            <div class="card-body p-4 d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div class="icon-box-premium <?= $m['tipe'] == 'cash' ? 'box-green' : ($m['tipe'] == 'qris' ? 'box-red' : ($m['tipe'] == 'ewallet' ? 'box-purple' : 'box-orange')); ?>" style="width: 50px; height: 50px;">
                                        <i class="fas <?= $m['tipe'] == 'cash' ? 'fa-money-bill-wave' : ($m['tipe'] == 'qris' ? 'fa-qrcode' : ($m['tipe'] == 'ewallet' ? 'fa-wallet' : 'fa-university')); ?>"></i>
                                    </div>
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="dropdown">
                                            <button class="btn btn-link text-muted p-0 border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <div class="icon-box-premium bg-light shadow-none" style="width: 32px; height: 32px; border-radius: 10px;">
                                                    <i class="fas fa-ellipsis-v small"></i>
                                                </div>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 p-2">
                                                <li>
                                                    <a class="dropdown-item rounded-3 py-2 btn-edit-metode" href="javascript:void(0)"
                                                       data-id="<?= $m['id']; ?>" 
                                                       data-nama="<?= $m['nama_metode']; ?>" 
                                                       data-tipe="<?= $m['tipe']; ?>" 
                                                       data-norek="<?= $m['nomor_rekening']; ?>" 
                                                       data-an="<?= $m['atas_nama']; ?>" 
                                                       data-instruksi="<?= $m['instruksi']; ?>" 
                                                       data-active="<?= $m['is_active']; ?>">
                                                        <i class="fas fa-edit me-2 text-primary"></i> Edit Detail
                                                    </a>
                                                </li>
                                                <li><hr class="dropdown-divider opacity-50"></li>
                                                <li>
                                                    <a class="dropdown-item rounded-3 py-2 text-danger" href="javascript:void(0)" onclick="confirmHapus('<?= BASEURL; ?>/admin/hapus_metode_pembayaran/<?= $m['id']; ?>', 'Hapus Metode?', 'Metode pembayaran ini akan dihapus secara permanen.')">
                                                        <i class="fas fa-trash-alt me-2"></i> Hapus Metode
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="form-check form-switch p-0 m-0">
                                            <div class="form-check-input ms-0 toggle-metode" data-id="<?= $m['id']; ?>" role="switch" style="width: 2.5em; height: 1.25em; cursor: pointer; display: block; background-color: <?= $m['is_active'] ? '#A30D11' : '#e9ecef'; ?>; border-color: <?= $m['is_active'] ? '#A30D11' : '#dee2e6'; ?>; position: relative;">
                                                <div class="toggle-dot" style="width: 1em; height: 1em; background: #fff; border-radius: 50%; transition: all 0.3s ease; position: absolute; top: 0.1em; left: 0.1em; transform: translateX(<?= $m['is_active'] ? '1.25em' : '0'; ?>);"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <h6 class="fw-bold mb-1"><?= $m['nama_metode']; ?></h6>
                                <p class="text-muted small mb-3" style="font-size: 11px;"><?= $m['instruksi']; ?></p>
                                
                                <?php if($m['tipe'] != 'cash'): ?>
                                <div class="bg-light rounded-3 p-3 mb-3 border border-dashed">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="text-muted small" style="font-size: 10px;">Nomor / ID</span>
                                        <span class="fw-bold small"><?= $m['nomor_rekening']; ?></span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted small" style="font-size: 10px;">Atas Nama</span>
                                        <span class="fw-bold small text-truncate ms-2" style="max-width: 120px;"><?= $m['atas_nama']; ?></span>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <?php if($m['logo_qr']): ?>
                                <div class="text-center mb-3">
                                    <img src="<?= BASEURL; ?>/assets/img/pembayaran/<?= $m['logo_qr']; ?>" class="img-fluid rounded border p-1 bg-white" style="max-height: 80px;">
                                </div>
                                <?php endif; ?>

                                <div class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top">
                                    <span class="badge bg-<?= $m['is_active'] ? 'success' : 'secondary'; ?> bg-opacity-10 text-<?= $m['is_active'] ? 'success' : 'secondary'; ?> rounded-pill px-3 py-1 border-0" style="font-size: 10px;">
                                        <?= $m['is_active'] ? 'Aktif' : 'Nonaktif'; ?>
                                    </span>
                                    <span class="text-muted" style="font-size: 10px;">ID: #<?= $m['id']; ?></span>
                                </div>
                            </div>
                            <div class="card-glow-container">
                                <div class="card-glow <?= $m['tipe'] == 'cash' ? 'green-glow' : ($m['tipe'] == 'qris' ? 'red-glow' : ($m['tipe'] == 'ewallet' ? 'purple-glow' : 'orange-glow')); ?>" style="display: <?= $m['is_active'] ? 'block' : 'none'; ?>;"></div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>

                    <!-- Add New Card Dotted -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card border border-dashed shadow-none rounded-4 d-flex align-items-center justify-content-center bg-light bg-opacity-25 h-100" style="min-height: 150px; cursor: pointer; border-width: 2px !important;" data-bs-toggle="modal" data-bs-target="#modalTambahMetode">
                            <div class="text-center text-muted p-4">
                                <div class="icon-box-premium bg-white shadow-sm mx-auto mb-2" style="width: 50px; height: 50px;">
                                    <i class="fas fa-plus text-danger fs-4"></i>
                                </div>
                                <h6 class="fw-bold mb-1">Tambah Metode</h6>
                                <p class="small mb-0" style="font-size: 11px;">Klik untuk cara bayar baru</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <style>
                .hover-up:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important; }
                .border-dashed { border: 2px dashed #e5e7eb !important; }
                .box-purple { background: rgba(155, 81, 224, 0.1); color: #9B51E0; }
                .purple-glow { background: #9B51E0; }
                .fw-800 { font-weight: 800; }
                .form-control-premium {
                    border: 1.5px solid #e9ecef;
                    border-radius: 12px;
                    padding: 12px 16px;
                    font-size: 14px;
                    font-weight: 600;
                    transition: all 0.3s ease;
                }
                .form-control-premium:focus {
                    border-color: #A30D11;
                    box-shadow: 0 0 0 4px rgba(163, 13, 17, 0.1);
                    background: #fff;
                }
                .white-glow { background: #fff; }
                .rounded-5 { border-radius: 2rem !important; }
                .z-1 { z-index: 1; }
                .card-glow-container { position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; }
                .transition-all { transition: all 0.3s ease !important; }
            </style>


<!-- Modals (Moved outside main form to avoid nested forms issue) -->

<!-- Modals (Relocated to bottom of file) -->


<script>
    document.getElementById('selectTipe').addEventListener('change', function() {
        const extra = document.getElementById('extraFields');
        if (this.value === 'qris' || this.value === 'transfer' || this.value === 'ewallet') {
            extra.style.display = 'block';
        } else {
            extra.style.display = 'none';
        }
    });

    document.getElementById('editTipe').addEventListener('change', function() {
        const extra = document.getElementById('editExtraFields');
        if (this.value === 'qris' || this.value === 'transfer' || this.value === 'ewallet') {
            extra.style.display = 'block';
        } else {
            extra.style.display = 'none';
        }
    });

    // JS Handler for Edit Modal
    document.querySelectorAll('.btn-edit-metode').forEach(btn => {
        btn.addEventListener('click', function() {
            const data = this.dataset;
            document.getElementById('editId').value = data.id;
            document.getElementById('editNama').value = data.nama;
            document.getElementById('editTipe').value = data.tipe;
            document.getElementById('editNorek').value = data.norek;
            document.getElementById('editAn').value = data.an;
            document.getElementById('editInstruksi').value = data.instruksi;
            document.getElementById('editActive').value = data.active;

            // Toggle extra fields visibility
            const extra = document.getElementById('editExtraFields');
            extra.style.display = (data.tipe === 'qris' || data.tipe === 'transfer' || data.tipe === 'ewallet') ? 'block' : 'none';

            const modal = new bootstrap.Modal(document.getElementById('modalEditMetode'));
            modal.show();
        });
    });

    // AJAX Toggle Metode Status
    document.querySelectorAll('.toggle-metode').forEach(toggle => {
        toggle.addEventListener('click', function() {
            const id = this.dataset.id;
            const self = this;
            const dot = this.querySelector('.toggle-dot');
            const card = this.closest('.card');
            const glow = card.querySelector('.card-glow');

            fetch('<?= BASEURL; ?>/admin/toggle_metode_ajax/' + id)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        if (data.is_active == 1) {
                            self.style.backgroundColor = '#A30D11';
                            self.style.borderColor = '#A30D11';
                            dot.style.transform = 'translateX(1.25em)';
                            glow.style.display = 'block';
                        } else {
                            self.style.backgroundColor = '#e9ecef';
                            self.style.borderColor = '#dee2e6';
                            dot.style.transform = 'translateX(0)';
                            glow.style.display = 'none';
                        }
                    }
                });
        });
    });

    // AJAX Toggle Banner Status
    document.querySelectorAll('.toggle-banner').forEach(toggle => {
        toggle.addEventListener('click', function() {
            const id = this.dataset.id;
            const self = this;
            const dot = this.querySelector('.toggle-dot');
            const badge = this.closest('.card').querySelector('.badge');

            fetch('<?= BASEURL; ?>/admin/toggle_banner_ajax/' + id)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        if (data.is_active == 1) {
                            self.style.backgroundColor = '#A30D11';
                            self.style.borderColor = '#A30D11';
                            dot.style.transform = 'translateX(1.25em)';
                            badge.className = 'badge bg-success rounded-pill shadow-sm';
                            badge.textContent = 'Aktif';
                        } else {
                            self.style.backgroundColor = '#e9ecef';
                            self.style.borderColor = '#dee2e6';
                            dot.style.transform = 'translateX(0)';
                            badge.className = 'badge bg-secondary rounded-pill shadow-sm';
                            badge.textContent = 'Nonaktif';
                        }
                    }
                });
        });
    });

    // Tab Persistence Logic
    document.addEventListener('DOMContentLoaded', function() {
        const hash = window.location.hash;
        const savedTab = localStorage.getItem('activeTab');
        
        if (hash) {
            const targetTab = document.querySelector(`button[data-bs-target="${hash}"]`);
            if (targetTab) {
                const tab = new bootstrap.Tab(targetTab);
                tab.show();
            }
        } else if (savedTab) {
            const targetTab = document.querySelector(`button[data-bs-target="${savedTab}"]`);
            if (targetTab) {
                const tab = new bootstrap.Tab(targetTab);
                tab.show();
            }
        }

        // Save tab on change
        const tabButtons = document.querySelectorAll('button[data-bs-toggle="tab"]');
        tabButtons.forEach(btn => {
            btn.addEventListener('shown.bs.tab', function(e) {
                const target = e.target.getAttribute('data-bs-target');
                localStorage.setItem('activeTab', target);
                // Optional: Update URL without refresh
                history.replaceState(null, null, target);
            });
        });
    });
</script>

            <!-- Tab Tampilan -->
            <div class="tab-pane fade" id="tampilan" role="tabpanel">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="fw-bold mb-0 text-danger"><i class="fas fa-images me-2"></i> Kelola Slider Hero (Banner)</h6>
                    <button type="button" class="btn btn-danger rounded-pill px-4 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahBanner">
                        <i class="fas fa-plus-circle me-2"></i> Tambah Banner Baru
                    </button>
                </div>

                <div class="row g-4">
                    <?php if(empty($data['banners'])): ?>
                        <div class="col-12">
                            <div class="alert alert-light border-0 rounded-4 p-5 text-center shadow-sm">
                                <i class="fas fa-image fs-1 opacity-25 mb-3 d-block"></i>
                                <h6 class="fw-bold text-muted">Belum ada banner promosi</h6>
                                <p class="small text-muted mb-0">Klik tombol "Tambah Banner Baru" untuk mempercantik halaman depan toko bos.</p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php foreach($data['banners'] as $b): ?>
                    <div class="col-lg-6 col-xl-4 mb-4">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden position-relative hover-up h-100">
                            <div style="height: 180px; overflow: hidden; position: relative;">
                                <img src="<?= BASEURL; ?>/assets/img/banner/<?= $b['gambar']; ?>" class="w-100 h-100 object-fit-cover" alt="Banner">
                                <div class="position-absolute top-0 end-0 p-2">
                                    <span class="badge bg-<?= $b['is_active'] ? 'success' : 'secondary'; ?> rounded-pill shadow-sm">
                                        <?= $b['is_active'] ? 'Aktif' : 'Nonaktif'; ?>
                                    </span>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="fw-bold mb-0 text-truncate pe-3"><?= !empty($b['judul']) ? $b['judul'] : 'Tanpa Judul'; ?></h6>
                                    <div class="dropdown">
                                        <button class="btn btn-link text-muted p-0 border-0" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 p-2">
                                            <li>
                                                <a class="dropdown-item rounded-3 py-2 text-danger" href="javascript:void(0)" onclick="confirmHapus('<?= BASEURL; ?>/admin/hapus_banner/<?= $b['id']; ?>', 'Hapus Banner?', 'Gambar banner ini akan dihapus dari sistem.')">
                                                    <i class="fas fa-trash-alt me-2"></i> Hapus Banner
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <p class="text-muted small mb-2 text-truncate"><?= !empty($b['subjudul']) ? $b['subjudul'] : 'Tidak ada subjudul'; ?></p>
                                <p class="text-secondary mb-4" style="font-size: 11px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; line-height: 1.4;">
                                    <?= !empty($b['deskripsi']) ? $b['deskripsi'] : '<i class="opacity-50">Belum ada deskripsi...</i>'; ?>
                                </p>
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="form-check form-switch p-0 m-0">
                                        <div class="form-check-input ms-0 toggle-banner" data-id="<?= $b['id']; ?>" role="switch" style="width: 2.5em; height: 1.25em; cursor: pointer; display: block; background-color: <?= $b['is_active'] ? '#A30D11' : '#e9ecef'; ?>; border-color: <?= $b['is_active'] ? '#A30D11' : '#dee2e6'; ?>; position: relative;">
                                            <div class="toggle-dot" style="width: 1em; height: 1em; background: #fff; border-radius: 50%; transition: all 0.3s ease; position: absolute; top: 0.1em; left: 0.1em; transform: translateX(<?= $b['is_active'] ? '1.25em' : '0'; ?>);"></div>
                                        </div>
                                    </div>
                                    <span class="text-muted" style="font-size: 10px;">ID: #<?= $b['id']; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Tab Keamanan -->
            <div class="tab-pane fade" id="keamanan" role="tabpanel">
                <div class="card border-0 shadow-sm rounded-4" style="max-width: 600px;">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-4 border-bottom pb-2 text-primary"><i class="fas fa-lock me-2"></i> Ganti Password Akun</h6>
                        <div class="mb-4">
                            <label class="form-label small fw-bold">Password Lama</label>
                            <input type="password" name="old_password" class="form-control rounded-3 py-2" placeholder="Masukkan password saat ini">
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold">Password Baru</label>
                            <input type="password" name="new_password" class="form-control rounded-3 py-2" placeholder="Min. 8 karakter">
                        </div>
                        <div class="mb-0">
                            <label class="form-label small fw-bold">Konfirmasi Password Baru</label>
                            <input type="password" name="confirm_password" class="form-control rounded-3 py-2" placeholder="Ulangi password baru">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>

<style>
    @media (max-width: 767px) {
        .stat-slider {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none; /* Firefox */
        }
        .stat-slider::-webkit-scrollbar {
            display: none; /* Chrome, Safari, Opera */
        }
    }
</style>

<!-- Modals (Moved outside main form to avoid nested forms issue) -->
<div class="modal fade" id="modalTambahMetode" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-5 overflow-hidden">
            <div class="modal-header bg-danger p-4 border-0 position-relative">
                <div class="z-1">
                    <h5 class="fw-bold mb-0 text-white"><i class="fas fa-plus-circle me-2"></i> Tambah Metode Baru</h5>
                    <p class="text-white opacity-75 small mb-0">Lengkapi detail untuk menambah jalur pembayaran</p>
                </div>
                <button type="button" class="btn-close btn-close-white z-1" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="card-glow white-glow opacity-25" style="top: -20px; right: -20px;"></div>
            </div>
            <form action="<?= BASEURL; ?>/admin/tambah_metode_pembayaran" method="post" enctype="multipart/form-data">
                <div class="modal-body p-4 bg-white">
                    <div class="mb-3">
                        <label class="form-label small fw-800 text-dark"><i class="fas fa-tag me-1 text-danger"></i> NAMA METODE</label>
                        <input type="text" name="nama_metode" class="form-control form-control-premium" required placeholder="Contoh: ShopeePay / Bank BCA">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-800 text-dark"><i class="fas fa-layer-group me-1 text-danger"></i> TIPE PEMBAYARAN</label>
                        <select name="tipe" class="form-select form-control-premium" required id="selectTipe">
                            <option value="cash">Tunai / Cash</option>
                            <option value="qris">QRIS (Otomatis)</option>
                            <option value="transfer">Transfer Bank</option>
                            <option value="ewallet">E-Wallet (OVO/Dana/dll)</option>
                        </select>
                    </div>
                    <div id="extraFields" style="display: none;" class="p-3 bg-light rounded-4 mb-3 border border-dashed">
                        <div class="mb-3">
                            <label class="form-label small fw-800 text-dark"><i class="fas fa-id-card me-1 text-danger"></i> NOMOR REKENING / ID / NO HP</label>
                            <input type="text" name="nomor_rekening" class="form-control form-control-premium" placeholder="Masukkan nomor atau ID akun">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-800 text-dark"><i class="fas fa-user-circle me-1 text-danger"></i> ATAS NAMA</label>
                            <input type="text" name="atas_nama" class="form-control form-control-premium" placeholder="Nama pemilik rekening">
                        </div>
                        <div class="mb-0">
                            <label class="form-label small fw-800 text-dark"><i class="fas fa-qrcode me-1 text-danger"></i> UPLOAD QRIS (OPSIONAL)</label>
                            <input type="file" name="logo_qr" class="form-control form-control-premium bg-white" accept="image/*">
                        </div>
                    </div>
                    <div class="mb-0">
                        <label class="form-label small fw-800 text-dark"><i class="fas fa-info-circle me-1 text-danger"></i> INSTRUKSI PEMBAYARAN</label>
                        <textarea name="instruksi" class="form-control form-control-premium" rows="3" placeholder="Tulis petunjuk untuk pelanggan..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0 bg-white">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger rounded-pill px-4 fw-bold shadow-sm">Simpan Metode <i class="fas fa-check-circle ms-1"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Tambah Banner -->
<div class="modal fade" id="modalTambahBanner" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-5 overflow-hidden">
            <div class="modal-header bg-danger p-4 border-0">
                <h5 class="fw-bold mb-0 text-white"><i class="fas fa-plus-circle me-2"></i> Tambah Banner Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= BASEURL; ?>/admin/tambah_banner" method="post" enctype="multipart/form-data">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-800 text-dark">JUDUL BANNER (OPSIONAL)</label>
                        <input type="text" name="judul" class="form-control form-control-premium" placeholder="Contoh: Promo Spesial Ramadhan">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-800 text-dark">SUBJUDUL BANNER (OPSIONAL)</label>
                        <input type="text" name="subjudul" class="form-control form-control-premium" placeholder="Contoh: Diskon 50% untuk semua menu">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-800 text-dark">DESKRIPSI BANNER (OPSIONAL)</label>
                        <textarea name="deskripsi" class="form-control form-control-premium" rows="3" placeholder="Contoh: Nikmati berbagai pilihan menu favorit dengan harga terjangkau."></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-800 text-dark">URUTAN TAMPIL</label>
                        <input type="number" name="urutan" class="form-control form-control-premium" value="0">
                    </div>
                    <div class="mb-0">
                        <label class="form-label small fw-800 text-dark">GAMBAR BANNER</label>
                        <input type="file" name="gambar_banner" class="form-control form-control-premium bg-white" accept="image/*" required>
                        <p class="text-muted small mt-2 mb-0" style="font-size: 10px;">Gunakan orientasi landscape (rekomendasi: 1200x600 px)</p>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger rounded-pill px-4 fw-bold">Unggah Banner</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Metode -->
<div class="modal fade" id="modalEditMetode" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-5 overflow-hidden">
            <div class="modal-header bg-danger p-4 border-0 position-relative">
                <div class="z-1">
                    <h5 class="fw-bold mb-0 text-white"><i class="fas fa-edit me-2"></i> Edit Konfigurasi</h5>
                    <p class="text-white opacity-75 small mb-0">Ubah detail pembayaran agar tetap akurat</p>
                </div>
                <button type="button" class="btn-close btn-close-white z-1" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="card-glow white-glow opacity-25" style="top: -20px; right: -20px;"></div>
            </div>
            <form action="<?= BASEURL; ?>/admin/edit_metode_pembayaran" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" id="editId">
                <input type="hidden" name="is_active" id="editActive">
                <div class="modal-body p-4 bg-white">
                    <div class="mb-3">
                        <label class="form-label small fw-800 text-dark"><i class="fas fa-tag me-1 text-danger"></i> NAMA METODE</label>
                        <input type="text" name="nama_metode" id="editNama" class="form-control form-control-premium" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-800 text-dark"><i class="fas fa-layer-group me-1 text-danger"></i> TIPE PEMBAYARAN</label>
                        <select name="tipe" id="editTipe" class="form-select form-control-premium" required>
                            <option value="cash">Tunai / Cash</option>
                            <option value="qris">QRIS (Otomatis)</option>
                            <option value="transfer">Transfer Bank</option>
                            <option value="ewallet">E-Wallet (OVO/Dana/dll)</option>
                        </select>
                    </div>
                    <div id="editExtraFields" class="p-3 bg-light rounded-4 mb-3 border border-dashed">
                        <div class="mb-3">
                            <label class="form-label small fw-800 text-dark"><i class="fas fa-id-card me-1 text-danger"></i> NOMOR REKENING / ID / NO HP</label>
                            <input type="text" name="nomor_rekening" id="editNorek" class="form-control form-control-premium">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-800 text-dark"><i class="fas fa-user-circle me-1 text-danger"></i> ATAS NAMA</label>
                            <input type="text" name="atas_nama" id="editAn" class="form-control form-control-premium">
                        </div>
                        <div class="mb-0">
                            <label class="form-label small fw-800 text-dark"><i class="fas fa-qrcode me-1 text-danger"></i> UPDATE LOGO QRIS (OPSIONAL)</label>
                            <input type="file" name="logo_qr" class="form-control form-control-premium bg-white" accept="image/*">
                        </div>
                    </div>
                    <div class="mb-0">
                        <label class="form-label small fw-800 text-dark"><i class="fas fa-info-circle me-1 text-danger"></i> INSTRUKSI PEMBAYARAN</label>
                        <textarea name="instruksi" id="editInstruksi" class="form-control form-control-premium" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0 bg-white">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger rounded-pill px-4 fw-bold shadow-sm">Simpan Perubahan <i class="fas fa-save ms-1"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>



<style>
    .nav-pills .nav-link {
        color: #6c757d;
        background: transparent;
        transition: 0.3s;
    }
    .nav-pills .nav-link.active {
        color: #fff;
        background: #A30D11;
        box-shadow: 0 4px 15px rgba(163, 13, 17, 0.2);
    }
    .nav-pills .nav-link:hover:not(.active) {
        background: rgba(0,0,0,0.05);
        color: #333;
    }
    .form-control:focus, .form-select:focus {
        border-color: #A30D11;
        box-shadow: 0 0 0 0.25rem rgba(163, 13, 17, 0.1);
    }
    .shadow-inner {
        box-shadow: inset 0 2px 10px rgba(0,0,0,0.05);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Banner Toggle Logic
    document.querySelectorAll('.toggle-banner').forEach(toggle => {
        toggle.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const dot = this.querySelector('.toggle-dot');
            const card = this.closest('.card');
            const badge = card.querySelector('.badge');
            
            fetch(`<?= BASEURL; ?>/admin/toggle_banner_ajax/${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        if (data.is_active == 1) {
                            this.style.backgroundColor = '#A30D11';
                            this.style.borderColor = '#A30D11';
                            dot.style.transform = 'translateX(1.25em)';
                            badge.className = 'badge bg-success rounded-pill shadow-sm';
                            badge.textContent = 'Aktif';
                        } else {
                            this.style.backgroundColor = '#e9ecef';
                            this.style.borderColor = '#dee2e6';
                            dot.style.transform = 'translateX(0)';
                            badge.className = 'badge bg-secondary rounded-pill shadow-sm';
                            badge.textContent = 'Nonaktif';
                        }
                    }
                });
        });
    });

    // Metode Pembayaran Toggle Logic
    document.querySelectorAll('.toggle-metode').forEach(toggle => {
        toggle.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const dot = this.querySelector('.toggle-dot');
            const card = this.closest('.card');
            const badge = card.querySelector('.badge');
            const glow = card.querySelector('.card-glow');
            
            fetch(`<?= BASEURL; ?>/admin/toggle_metode_ajax/${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        if (data.is_active == 1) {
                            this.style.backgroundColor = '#A30D11';
                            this.style.borderColor = '#A30D11';
                            dot.style.transform = 'translateX(1.25em)';
                            badge.className = 'badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1 border-0';
                            badge.textContent = 'Aktif';
                            if(glow) glow.style.display = 'block';
                        } else {
                            this.style.backgroundColor = '#e9ecef';
                            this.style.borderColor = '#dee2e6';
                            dot.style.transform = 'translateX(0)';
                            badge.className = 'badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3 py-1 border-0';
                            badge.textContent = 'Nonaktif';
                            if(glow) glow.style.display = 'none';
                        }
                    }
                });
        });
    });

    // Edit Metode Logic
    document.querySelectorAll('.btn-edit-metode').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const nama = this.getAttribute('data-nama');
            const tipe = this.getAttribute('data-tipe');
            const norek = this.getAttribute('data-norek');
            const an = this.getAttribute('data-an');
            const instruksi = this.getAttribute('data-instruksi');
            const active = this.getAttribute('data-active');

            document.getElementById('editId').value = id;
            document.getElementById('editNama').value = nama;
            document.getElementById('editTipe').value = tipe;
            document.getElementById('editNorek').value = norek;
            document.getElementById('editAn').value = an;
            document.getElementById('editInstruksi').value = instruksi;
            document.getElementById('editActive').value = active;

            const extra = document.getElementById('editExtraFields');
            if (tipe === 'qris' || tipe === 'transfer' || tipe === 'ewallet') {
                extra.style.display = 'block';
            } else {
                extra.style.display = 'none';
            }

            const modal = new bootstrap.Modal(document.getElementById('modalEditMetode'));
            modal.show();
        });
    });

    // Edit Tipe Switch Logic
    document.getElementById('editTipe').addEventListener('change', function() {
        const extra = document.getElementById('editExtraFields');
        if (this.value === 'qris' || this.value === 'transfer' || this.value === 'ewallet') {
            extra.style.display = 'block';
        } else {
            extra.style.display = 'none';
        }
    });

    // Select Tipe Logic (Tambah)
    document.getElementById('selectTipe').addEventListener('change', function() {
        const extra = document.getElementById('extraFields');
        if (this.value === 'qris' || this.value === 'transfer' || this.value === 'ewallet') {
            extra.style.display = 'block';
        } else {
            extra.style.display = 'none';
        }
    });

    // Logo Preview Logic
    document.getElementById('inputLogo').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('logoPreview').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });

    // Banner Preview Logic
    const inputBanner = document.getElementById('inputBanner');
    if (inputBanner) {
        inputBanner.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('bannerPreview');
                    if (preview) preview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    }
});
    function confirmHapus(url, title, text) {
        Swal.fire({
            title: title,
            text: text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#A30D11',
            cancelButtonColor: '#6e7881',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            borderRadius: '20px'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
</script>
