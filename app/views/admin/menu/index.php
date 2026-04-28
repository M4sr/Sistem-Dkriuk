
<!-- Stat Cards Row Premium -->
<div class="row g-3 mb-5 px-1 flex-nowrap flex-md-wrap stat-slider pb-2">
    <!-- Total Menu -->
    <div class="col-10 col-sm-6 col-md-3">
        <div class="stat-card-premium card-all h-100">
            <div class="d-flex flex-column h-100 justify-content-between">
                <div class="d-flex align-items-center mb-3">
                    <div class="icon-box-premium box-red" style="background: rgba(163, 13, 17, 0.1); color: #A30D11;">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <div class="ms-2">
                        <div class="stat-label-new text-danger">Total Menu</div>
                        <div class="stat-sublabel text-muted"><?= $data['stats']['total']; ?> Menu</div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <div class="stat-value-new text-dark"><?= $data['stats']['total']; ?></div>
                    <div class="text-muted small">Semua menu</div>
                </div>
            </div>
            <div class="card-glow red-glow"></div>
        </div>
    </div>
    <!-- Menu Aktif -->
    <div class="col-10 col-sm-6 col-md-3">
        <div class="stat-card-premium h-100">
            <div class="d-flex flex-column h-100 justify-content-between">
                <div class="d-flex align-items-center mb-3">
                    <div class="icon-box-premium" style="background: rgba(39, 174, 96, 0.1); color: #27AE60;">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="ms-2">
                        <div class="stat-label-new text-success">Menu Aktif</div>
                        <div class="stat-sublabel text-muted"><?= $data['stats']['aktif']; ?> Menu</div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <div class="stat-value-new text-dark"><?= $data['stats']['aktif']; ?></div>
                    <div class="text-muted small">Tersedia</div>
                </div>
            </div>
            <div class="card-glow green-glow"></div>
        </div>
    </div>
    <!-- Menu Nonaktif -->
    <div class="col-10 col-sm-6 col-md-3">
        <div class="stat-card-premium h-100">
            <div class="d-flex flex-column h-100 justify-content-between">
                <div class="d-flex align-items-center mb-3">
                    <div class="icon-box-premium" style="background: rgba(242, 153, 74, 0.1); color: #F2994A;">
                        <i class="fas fa-eye-slash"></i>
                    </div>
                    <div class="ms-2">
                        <div class="stat-label-new text-orange">Nonaktif</div>
                        <div class="stat-sublabel text-muted"><?= $data['stats']['nonaktif']; ?> Menu</div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <div class="stat-value-new text-dark"><?= $data['stats']['nonaktif']; ?></div>
                    <div class="text-muted small">Disembunyikan</div>
                </div>
            </div>
            <div class="card-glow orange-glow"></div>
        </div>
    </div>
    <!-- Kategori -->
    <div class="col-10 col-sm-6 col-md-3">
        <div class="stat-card-premium h-100">
            <div class="d-flex flex-column h-100 justify-content-between">
                <div class="d-flex align-items-center mb-3">
                    <div class="icon-box-premium" style="background: rgba(155, 81, 224, 0.1); color: #9B51E0;">
                        <i class="fas fa-tags"></i>
                    </div>
                    <div class="ms-2">
                        <div class="stat-label-new text-purple">Kategori</div>
                        <div class="stat-sublabel text-muted"><?= $data['stats']['total_kategori']; ?> Kategori</div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <div class="stat-value-new text-dark"><?= $data['stats']['total_kategori']; ?></div>
                    <div class="text-muted small">Kelompok menu</div>
                </div>
            </div>
            <div class="card-glow purple-glow"></div>
        </div>
    </div>
</div>

<!-- Filters & Actions -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
    <div class="card-body p-3">
        <form action="<?= BASEURL; ?>/admin/menu" method="GET" id="filterFormMenu">
            <div class="row g-2 align-items-center">
                <div class="col-12 col-md-4">
                    <div class="input-group bg-light border-0 rounded-3 px-2">
                        <span class="input-group-text bg-transparent border-0 text-muted"><i class="fas fa-search"></i></span>
                        <input type="text" name="search" class="form-control bg-transparent border-0 small" placeholder="Cari menu berdasarkan nama..." value="<?= isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                    </div>
                </div>
                <div class="col-6 col-md-2">
                    <select name="kategori" class="form-select border-0 bg-light small w-100" onchange="this.form.submit()">
                        <option value="">Semua Kategori</option>
                        <?php foreach($data['kategori'] as $k) : ?>
                            <option value="<?= $k['id']; ?>" <?= (isset($_GET['kategori']) && $_GET['kategori'] == $k['id']) ? 'selected' : ''; ?>><?= $k['nama']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-6 col-md-2">
                    <select name="status" class="form-select border-0 bg-light small w-100" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        <option value="aktif" <?= (isset($_GET['status']) && $_GET['status'] == 'aktif') ? 'selected' : ''; ?>>Aktif</option>
                        <option value="nonaktif" <?= (isset($_GET['status']) && $_GET['status'] == 'nonaktif') ? 'selected' : ''; ?>>Nonaktif</option>
                    </select>
                </div>
                <div class="col-12 col-md-2 ms-auto">
                    <select name="sort" class="form-select border-0 bg-light small w-100" onchange="this.form.submit()">
                        <option value="terbaru" <?= (isset($_GET['sort']) && $_GET['sort'] == 'terbaru') ? 'selected' : ''; ?>>Urutkan: Terbaru</option>
                        <option value="terlama" <?= (isset($_GET['sort']) && $_GET['sort'] == 'terlama') ? 'selected' : ''; ?>>Urutkan: Terlama</option>
                        <option value="harga_tinggi" <?= (isset($_GET['sort']) && $_GET['sort'] == 'harga_tinggi') ? 'selected' : ''; ?>>Harga: Tertinggi</option>
                        <option value="harga_rendah" <?= (isset($_GET['sort']) && $_GET['sort'] == 'harga_rendah') ? 'selected' : ''; ?>>Harga: Terendah</option>
                    </select>
                </div>
                <div class="col-12 col-md-auto mt-2 mt-md-0">
                    <a href="<?= BASEURL; ?>/admin/tambah_menu" class="btn btn-danger px-4 rounded-3 shadow-sm fw-bold w-100">
                        <i class="fas fa-plus me-2"></i> Tambah Menu
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Table Menu -->
<div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
    <div class="table-responsive">
        <table class="table mb-0 align-middle">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4 py-3 text-muted small border-0" style="width: 40%;">Menu</th>
                    <th class="py-3 text-muted small border-0">Kategori</th>
                    <th class="py-3 text-muted small border-0">Harga</th>
                    <th class="py-3 text-muted small border-0 text-center">Status</th>
                    <th class="py-3 text-muted small border-0">Stok</th>
                    <th class="py-3 text-muted small border-0 text-center pe-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($data['produk'])) : ?>
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <img src="https://illustrations.popsy.co/amber/no-results.svg" alt="Empty" style="width: 150px; opacity: 0.5;">
                            <p class="text-muted mt-3 small">Wah, menu yang Anda cari tidak ada nih.</p>
                            <a href="<?= BASEURL; ?>/admin/menu" class="btn btn-sm btn-outline-danger px-4 rounded-pill">Lihat Semua Menu</a>
                        </td>
                    </tr>
                <?php else : ?>
                    <?php foreach($data['produk'] as $p) : 
                        $status_class = ($p['status'] == 'aktif') ? 'bg-success text-success' : 'bg-secondary text-secondary';
                        
                        // Cek apakah file foto benar-benar ada di folder public/assets/img/produk/
                        $foto_path = 'assets/img/produk/' . $p['foto'];
                        if (!empty($p['foto']) && file_exists($foto_path)) {
                            $foto = BASEURL . '/assets/img/produk/' . $p['foto'];
                        } else {
                            // Jika tidak ada, pakai placeholder premium
                            $foto = 'https://placehold.co/400x400?text=' . urlencode($p['nama']);
                        }
                    ?>
                    <tr class="border-bottom border-light">
                        <td class="ps-4 py-3">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <img src="<?= $foto; ?>" alt="<?= $p['nama']; ?>" class="rounded-3 shadow-sm" style="width: 60px; height: 60px; object-fit: cover;">
                                </div>
                                <div class="ms-3">
                                    <div class="fw-bold text-dark mb-0"><?= $p['nama']; ?></div>
                                    <div class="text-muted text-truncate" style="font-size: 11px; max-width: 250px;"><?= $p['deskripsi']; ?></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-10 px-3 py-2 rounded-pill" style="font-size: 10px;">
                                <?= $p['nama_kategori']; ?>
                            </span>
                        </td>
                        <td class="fw-bold text-dark">Rp <?= number_format($p['harga'], 0, ',', '.'); ?></td>
                        <td class="text-center">
                            <span class="badge <?= $status_class; ?> bg-opacity-10 px-3 py-2 rounded-pill fw-bold" style="font-size: 10px;">
                                <?= ucfirst($p['status']); ?>
                            </span>
                        </td>
                        <td>
                            <div class="small fw-semibold"><?= $p['stok']; ?> <span class="text-muted fw-normal"><?= $p['satuan']; ?></span></div>
                        </td>
                        <td class="text-center pe-4">
                            <div class="dropdown">
                                <button class="btn btn-light btn-sm shadow-sm border-0 rounded-3" type="button" data-bs-toggle="dropdown" style="width: 35px; height: 35px;">
                                    <i class="fas fa-ellipsis-v text-muted"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 p-2">
                                    <li>
                                        <a class="dropdown-item rounded-3 py-2" href="<?= BASEURL; ?>/admin/edit_menu/<?= $p['id']; ?>">
                                            <i class="fas fa-edit me-2 text-primary"></i> Edit Menu
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider opacity-50"></li>
                                    <li>
                                        <a class="dropdown-item rounded-3 py-2 text-danger" href="javascript:void(0)" onclick="konfirmasiHapus('<?= BASEURL; ?>/admin/hapus_menu/<?= $p['id']; ?>')">
                                            <i class="fas fa-trash-alt me-2"></i> Hapus Menu
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Pagination Global -->
<?= Pagination::create(count($data['produk']), 10, 1, BASEURL . '/admin/menu'); ?>

<style>
    .purple-glow { background: radial-gradient(circle at top right, rgba(155, 81, 224, 0.1), transparent); }

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
    function konfirmasiHapus(url) {
        Swal.fire({
            title: 'Hapus Menu?',
            text: "Menu yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#A30D11',
            cancelButtonColor: '#6e7881',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        })
    }

    // Handle Messages
    const urlParams = new URLSearchParams(window.location.search);
    const msg = urlParams.get('msg');

    if (msg) {
        let title = '', text = '', icon = '';
        
        if (msg === 'success') {
            title = 'Berhasil!';
            text = 'Data menu telah diperbarui.';
            icon = 'success';
        } else if (msg === 'has_orders') {
            title = 'Gagal Menghapus!';
            text = 'Produk ini sudah pernah dipesan oleh pelanggan. Tidak bisa dihapus karena akan merusak data laporan. Silakan nonaktifkan saja statusnya ya bos!';
            icon = 'error';
        } else if (msg === 'error') {
            title = 'Gagal!';
            text = 'Terjadi kesalahan sistem.';
            icon = 'error';
        }

        if (title) {
            Swal.fire({
                title: title,
                text: text,
                icon: icon,
                confirmButtonColor: '#A30D11'
            }).then(() => {
                // Bersihkan URL setelah alert ditutup agar tidak muncul lagi pas refresh
                window.history.replaceState({}, document.title, window.location.pathname);
            });
        }
    }
</script>
