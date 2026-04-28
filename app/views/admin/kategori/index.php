
    <!-- Stat Cards -->
    <div class="row g-3 mb-4 flex-nowrap flex-md-wrap stat-slider pb-2">
        <div class="col-10 col-sm-6 col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 p-3">
                <div class="d-flex align-items-center">
                    <div class="bg-danger bg-opacity-10 text-danger rounded-4 p-3 me-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-shapes fs-3"></i>
                    </div>
                    <div>
                        <p class="text-muted small mb-1">Total Kategori</p>
                        <h4 class="fw-bold mb-0"><?= $data['stats']['total']; ?></h4>
                        <p class="text-muted" style="font-size: 11px;">Semua kategori</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-10 col-sm-6 col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 p-3">
                <div class="d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 text-success rounded-4 p-3 me-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-check-double fs-3"></i>
                    </div>
                    <div>
                        <p class="text-muted small mb-1">Kategori Aktif</p>
                        <h4 class="fw-bold mb-0"><?= $data['stats']['aktif']; ?></h4>
                        <p class="text-muted" style="font-size: 11px;">Ditampilkan</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-10 col-sm-6 col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 p-3">
                <div class="d-flex align-items-center">
                    <div class="bg-warning bg-opacity-10 text-warning rounded-4 p-3 me-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-eye-slash fs-3"></i>
                    </div>
                    <div>
                        <p class="text-muted small mb-1">Kategori Nonaktif</p>
                        <h4 class="fw-bold mb-0"><?= $data['stats']['nonaktif']; ?></h4>
                        <p class="text-muted" style="font-size: 11px;">Tidak ditampilkan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Search Bar -->
    <form action="<?= BASEURL; ?>/admin/kategori" method="get">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-3">
                <div class="row g-3">
                    <div class="col-12 col-md-4">
                        <div class="input-group bg-light rounded-3 px-3">
                            <span class="input-group-text bg-transparent border-0 text-muted"><i class="fas fa-search"></i></span>
                            <input type="text" name="search" class="form-control bg-transparent border-0 ps-0" placeholder="Cari kategori..." value="<?= isset($_GET['search']) ? $_GET['search'] : ''; ?>" style="font-size: 13px;">
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="row g-2 justify-content-md-end">
                            <div class="col-6 col-md-auto">
                                <div class="dropdown w-100">
                                    <button class="btn btn-white shadow-sm border-0 dropdown-toggle px-3 w-100 text-truncate" type="button" data-bs-toggle="dropdown" style="border-radius: 10px; height: 40px; font-size: 13px;">
                                        Urutkan
                                    </button>
                                    <ul class="dropdown-menu border-0 shadow-sm w-100">
                                        <li><a class="dropdown-item" href="#">Terbaru</a></li>
                                        <li><a class="dropdown-item" href="#">Terlama</a></li>
                                        <li><a class="dropdown-item" href="#">Nama A-Z</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-6 col-md-auto">
                                <button type="button" class="btn btn-white shadow-sm border-0 px-3 w-100 text-truncate" style="border-radius: 10px; height: 40px; font-size: 13px;">
                                    <i class="fas fa-filter me-1 text-muted"></i> Filter
                                </button>
                            </div>
                            <div class="col-12 col-md-auto mt-2 mt-md-0">
                                <a href="<?= BASEURL; ?>/admin/tambah_kategori" class="btn btn-danger rounded-3 px-4 fw-bold shadow-sm w-100 d-flex align-items-center justify-content-center" style="height: 40px; font-size: 13px;">
                                    <i class="fas fa-plus me-2"></i> Tambah Kategori
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Table -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table mb-0 align-middle">
                <thead style="background-color: #F9FAFB;">
                    <tr>
                        <th class="ps-4 py-3 text-muted small border-0" style="width: 80px;">No.</th>
                        <th class="py-3 text-muted small border-0">Nama Kategori</th>
                        <th class="py-3 text-muted small border-0 text-center">Jumlah Menu</th>
                        <th class="py-3 text-muted small border-0 text-center">Status</th>
                        <th class="py-3 text-muted small border-0 text-center">Urutan</th>
                        <th class="py-3 text-muted small border-0 text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    $colors = ['danger', 'warning', 'primary', 'info', 'success', 'secondary'];
                    foreach($data['kategori'] as $k) : 
                        $status_class = ($k['status'] == 'aktif') ? 'bg-success text-success' : 'bg-secondary text-secondary';
                        $color = $colors[$no % count($colors)];
                    ?>
                    <tr class="border-bottom border-light">
                        <td class="ps-4 py-4 text-muted small"><?= $no++; ?></td>
                        <td class="py-4">
                            <div class="d-flex align-items-center">
                                <div class="bg-<?= $color; ?> bg-opacity-10 text-<?= $color; ?> rounded-3 p-2 me-3" style="width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-<?= !empty($k['ikon']) ? $k['ikon'] : 'tag'; ?> fs-5"></i>
                                </div>
                                <div>
                                    <div class="fw-bold text-dark mb-0"><?= $k['nama']; ?></div>
                                    <div class="text-muted small" style="font-size: 11px;"><?= $k['deskripsi'] ?: 'Kelola menu '.$k['nama']; ?></div>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 text-center fw-bold text-dark"><?= $k['jumlah_produk']; ?></td>
                        <td class="py-4 text-center">
                            <span class="badge rounded-pill px-3 py-1 <?= $status_class; ?> bg-opacity-10" style="font-size: 11px;">
                                <?= ucfirst($k['status']); ?>
                            </span>
                        </td>
                        <td class="py-4 text-center fw-bold text-muted"><?= $k['urutan']; ?></td>
                        <td class="py-4 text-end pe-4">
                            <div class="dropdown">
                                <button class="btn btn-light btn-sm shadow-sm border-0 rounded-3" type="button" data-bs-toggle="dropdown" style="width: 35px; height: 35px;">
                                    <i class="fas fa-ellipsis-v text-muted"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 p-2" style="min-width: 180px;">
                                    <li>
                                        <a class="dropdown-item rounded-3 py-2" href="<?= BASEURL; ?>/admin/edit_kategori/<?= $k['id']; ?>">
                                            <i class="fas fa-edit me-2 text-primary"></i> Edit Kategori
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider opacity-50"></li>
                                    <li>
                                        <a class="dropdown-item rounded-3 py-2 text-danger" href="javascript:void(0)" onclick="konfirmasiHapus('<?= BASEURL; ?>/admin/hapus_kategori/<?= $k['id']; ?>')">
                                            <i class="fas fa-trash-alt me-2"></i> Hapus Kategori
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <div class="card-footer bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center px-2">
                <span class="text-muted small">Menampilkan 1 - <?= count($data['kategori']); ?> dari <?= $data['stats']['total']; ?> kategori</span>
                <nav>
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item disabled"><a class="page-link border-0 bg-light rounded-circle me-1" href="#"><i class="fas fa-chevron-left"></i></a></li>
                        <li class="page-item active"><a class="page-link border-0 rounded-circle me-1" href="#" style="background: #A30D11; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">1</a></li>
                        <li class="page-item"><a class="page-link border-0 bg-light rounded-circle text-dark" href="#"><i class="fas fa-chevron-right"></i></a></li>
                    </ul>
                </nav>
                <div class="d-flex align-items-center gap-2">
                    <span class="text-muted small">10 per halaman</span>
                    <select class="form-select form-select-sm border-light" style="width: 60px;">
                        <option>10</option>
                        <option>20</option>
                        <option>50</option>
                    </select>
                </div>
            </div>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function konfirmasiHapus(url) {
        Swal.fire({
            title: 'Hapus Kategori?',
            text: "Kategori yang dihapus tidak bisa dikembalikan!",
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
            text = 'Data kategori telah diperbarui.';
            icon = 'success';
        } else if (msg === 'has_products') {
            title = 'Gagal Menghapus!';
            text = 'Kategori ini masih memiliki produk di dalamnya. Kosongkan atau pindahkan produk dulu ya bos!';
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
