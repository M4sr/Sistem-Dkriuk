<?php
// Helper functions for Sorting and Pagination
$queryParams = $_GET;
unset($queryParams['url']);

$buildSortUrl = function($field) use ($queryParams) {
    $params = $queryParams;
    $params['sort'] = $field;
    $params['order'] = (isset($queryParams['sort']) && $queryParams['sort'] == $field && (!isset($queryParams['order']) || $queryParams['order'] == 'desc')) ? 'asc' : 'desc';
    return BASEURL . '/admin/pesanan?' . http_build_query($params);
};

$renderSortIcon = function($field) use ($queryParams) {
    if(isset($queryParams['sort']) && $queryParams['sort'] == $field) {
        echo (isset($queryParams['order']) && $queryParams['order'] == 'asc') ? '<i class="fas fa-sort-up ms-1"></i>' : '<i class="fas fa-sort-down ms-1"></i>';
    } else {
        echo '<i class="fas fa-sort ms-1 opacity-25"></i>';
    }
};
?>
    <!-- Stat Cards Premium -->
    <div class="row g-3 mb-4 flex-nowrap flex-md-wrap stat-slider pb-2">
        <div class="col-10 col-sm-6 col-md-3">
            <div class="stat-card-premium">
                <div class="d-flex flex-column h-100 justify-content-between">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-box-premium box-red">
                            <i class="fas fa-shopping-basket"></i>
                        </div>
                        <div class="ms-2">
                            <div class="stat-label-new text-danger">Total</div>
                            <div class="stat-sublabel text-muted">Pesanan</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between">
                        <div class="stat-value-new text-dark"><?= $data['stats']['total']; ?></div>
                        <div class="stat-badge badge-red">Semua</div>
                    </div>
                </div>
                <div class="card-glow red-glow"></div>
            </div>
        </div>
        <div class="col-10 col-sm-6 col-md-3">
            <div class="stat-card-premium">
                <div class="d-flex flex-column h-100 justify-content-between">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-box-premium box-orange">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="ms-2">
                            <div class="stat-label-new text-orange">Pesanan</div>
                            <div class="stat-sublabel text-muted">Pending</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between">
                        <div class="stat-value-new text-dark"><?= $data['stats']['pending']; ?></div>
                        <div class="stat-badge badge-orange">Menunggu</div>
                    </div>
                </div>
                <div class="card-glow orange-glow"></div>
            </div>
        </div>
        <div class="col-10 col-sm-6 col-md-3">
            <div class="stat-card-premium">
                <div class="d-flex flex-column h-100 justify-content-between">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-box-premium box-blue">
                            <i class="fas fa-fire"></i>
                        </div>
                        <div class="ms-2">
                            <div class="stat-label-new text-info">Pesanan</div>
                            <div class="stat-sublabel text-muted">Diproses</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between">
                        <div class="stat-value-new text-dark"><?= $data['stats']['proses']; ?></div>
                        <div class="stat-badge badge-blue">Aktif</div>
                    </div>
                </div>
                <div class="card-glow blue-glow"></div>
            </div>
        </div>
        <div class="col-10 col-sm-6 col-md-3">
            <div class="stat-card-premium">
                <div class="d-flex flex-column h-100 justify-content-between">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-box-premium box-green">
                            <i class="fas fa-check-double"></i>
                        </div>
                        <div class="ms-2">
                            <div class="stat-label-new text-green">Pesanan</div>
                            <div class="stat-sublabel text-muted">Selesai</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between">
                        <div class="stat-value-new text-dark"><?= $data['stats']['selesai']; ?></div>
                        <div class="stat-badge badge-green">Berhasil</div>
                    </div>
                </div>
                <div class="card-glow green-glow"></div>
            </div>
        </div>
    </div>

    <!-- Filter & Table -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-0 p-4">
            <form action="<?= BASEURL; ?>/admin/pesanan" method="get">
                <div class="row g-3">
                    <div class="col-12 col-md-4">
                        <div class="input-group shadow-sm rounded-3 overflow-hidden border">
                            <span class="input-group-text bg-white border-0"><i class="fas fa-search text-muted"></i></span>
                            <input type="text" name="search" class="form-control border-0" placeholder="Cari Kode atau Nama..." value="<?= isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="row g-2 justify-content-md-end">
                            <div class="col-6 col-md-auto">
                                <select name="status" class="form-select border shadow-sm rounded-3 w-100">
                                    <option value="">Semua Status</option>
                                    <option value="pending" <?= (isset($_GET['status']) && $_GET['status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                                    <option value="diproses" <?= (isset($_GET['status']) && $_GET['status'] == 'diproses') ? 'selected' : ''; ?>>Diproses</option>
                                    <option value="selesai" <?= (isset($_GET['status']) && $_GET['status'] == 'selesai') ? 'selected' : ''; ?>>Selesai</option>
                                    <option value="dibatalkan" <?= (isset($_GET['status']) && $_GET['status'] == 'dibatalkan') ? 'selected' : ''; ?>>Dibatalkan</option>
                                </select>
                            </div>
                            <div class="col-6 col-md-auto">
                                <select name="tipe" class="form-select border shadow-sm rounded-3 w-100">
                                    <option value="">Semua Tipe</option>
                                    <option value="dine-in" <?= (isset($_GET['tipe']) && $_GET['tipe'] == 'dine-in') ? 'selected' : ''; ?>>Dine-in</option>
                                    <option value="takeaway" <?= (isset($_GET['tipe']) && $_GET['tipe'] == 'takeaway') ? 'selected' : ''; ?>>Takeaway</option>
                                    <option value="delivery" <?= (isset($_GET['tipe']) && $_GET['tipe'] == 'delivery') ? 'selected' : ''; ?>>Delivery</option>
                                </select>
                            </div>
                            <div class="col-8 col-md-auto">
                                <button type="submit" class="btn btn-danger rounded-3 fw-bold w-100 px-md-4">
                                    <i class="fas fa-filter me-1"></i> Filter
                                </button>
                            </div>
                            <div class="col-4 col-md-auto">
                                <a href="<?= BASEURL; ?>/admin/pesanan" class="btn btn-light rounded-3 border w-100 text-center">
                                    <i class="fas fa-redo"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive" style="min-height: 300px;">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 border-0">
                                <a href="<?= $buildSortUrl('kode_pesanan'); ?>" class="text-decoration-none text-muted">
                                    Invoice / Pelanggan <?php $renderSortIcon('kode_pesanan'); ?>
                                </a>
                            </th>
                            <th class="border-0">Tipe / Meja</th>
                            <th class="border-0 text-center">
                                <a href="<?= $buildSortUrl('status_pesanan'); ?>" class="text-decoration-none text-muted">
                                    Status Pesanan <?php $renderSortIcon('status_pesanan'); ?>
                                </a>
                            </th>
                            <th class="border-0 text-center">Status Bayar</th>
                            <th class="border-0 text-end pe-4">
                                <a href="<?= $buildSortUrl('total_harga'); ?>" class="text-decoration-none text-muted">
                                    Total <?php $renderSortIcon('total_harga'); ?>
                                </a>
                            </th>
                            <th class="border-0 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($data['pesanan'])): ?>
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                                <div class="d-flex justify-content-center">
                                    <lottie-player src="https://lottie.host/c3d05648-dae5-4e75-bf44-c87a03500452/0EAETuef9f.json" background="transparent" speed="1" style="width: 250px; height: 250px;" loop autoplay></lottie-player>
                                </div>
                                <h5 class="fw-bold text-dark mt-2">Dapur Lagi Tenang...</h5>
                                <p class="text-muted small">Belum ada pesanan yang sesuai kriteria filter saat ini.</p>
                            </td>
                        </tr>
                        <?php endif; ?>

                        <?php foreach($data['pesanan'] as $p) : 
                            $status_color = [
                                'pending' => 'warning',
                                'diproses' => 'info',
                                'selesai' => 'success',
                                'dibatalkan' => 'danger'
                            ];
                            $bayar_color = [
                                'belum' => 'secondary',
                                'menunggu_verifikasi' => 'warning',
                                'lunas' => 'success',
                                'gagal' => 'danger'
                            ];
                        ?>
                        <tr>
                            <td class="ps-4 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-light rounded-3 p-2 me-3 text-danger fw-bold small border" style="min-width: 80px; text-align: center;">
                                        #<?= $p['kode_pesanan']; ?>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-0 text-dark"><?= $p['nama_pelanggan'] ?: 'Pelanggan Umum'; ?></h6>
                                        <small class="text-muted" style="font-size: 11px;"><?= date('d M Y, H:i', strtotime($p['created_at'])); ?></small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="text-capitalize badge bg-light text-dark border-0 rounded-pill px-2 mb-1" style="width: fit-content; font-size: 10px;">
                                        <i class="fas fa-store me-1"></i> <?= $p['tipe_pesanan']; ?>
                                    </span>
                                    <?php if($p['tipe_pesanan'] == 'dine-in'): ?>
                                        <small class="fw-bold text-danger">Meja: <?= $p['nomor_meja'] ?: '-'; ?></small>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-<?= $status_color[$p['status_pesanan']]; ?> bg-opacity-10 text-<?= $status_color[$p['status_pesanan']]; ?> rounded-pill px-3 py-2 border-0" style="font-size: 11px;">
                                    <i class="fas fa-circle me-1 small"></i> <?= strtoupper($p['status_pesanan']); ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-<?= $bayar_color[$p['status_bayar']]; ?> bg-opacity-10 text-<?= $bayar_color[$p['status_bayar']]; ?> rounded-pill px-3 py-2 border-0" style="font-size: 11px;">
                                    <i class="fas <?= $p['status_bayar'] == 'lunas' ? 'fa-check' : 'fa-times'; ?> me-1 small"></i> 
                                    <?= strtoupper(str_replace('_', ' ', $p['status_bayar'])); ?>
                                </span>
                            </td>
                            <td class="text-end pe-4 fw-bold text-danger">
                                Rp <?= number_format($p['total_harga'], 0, ',', '.'); ?>
                            </td>
                            <td class="text-center">
                                <div class="d-flex gap-2 justify-content-center align-items-center">
                                    <?php if($p['status_pesanan'] == 'pending'): ?>
                                    <form action="<?= BASEURL; ?>/admin/update_status_pesanan" method="post" class="m-0">
                                        <input type="hidden" name="id" value="<?= $p['id']; ?>">
                                        <input type="hidden" name="status" value="diproses">
                                        <button type="submit" class="btn btn-sm btn-success rounded-3 shadow-sm px-3 fw-bold" style="font-size: 10px;" title="Proses Masak">
                                            <i class="fas fa-fire me-1"></i> MASAK
                                        </button>
                                    </form>
                                    <?php elseif($p['status_pesanan'] == 'diproses'): ?>
                                    <form action="<?= BASEURL; ?>/admin/update_status_pesanan" method="post" class="m-0">
                                        <input type="hidden" name="id" value="<?= $p['id']; ?>">
                                        <input type="hidden" name="status" value="selesai">
                                        <button type="submit" class="btn btn-sm btn-info text-white rounded-3 shadow-sm px-3 fw-bold" style="font-size: 10px;" title="Selesaikan">
                                            <i class="fas fa-check-double me-1"></i> SELESAI
                                        </button>
                                    </form>
                                    <?php endif; ?>

                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm shadow-sm border-0 rounded-3" type="button" data-bs-toggle="dropdown" style="width: 35px; height: 35px;">
                                            <i class="fas fa-ellipsis-v text-muted"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 p-2">
                                            <li>
                                                <a class="dropdown-item rounded-3 py-2" href="<?= BASEURL; ?>/admin/detail_pesanan/<?= $p['id']; ?>">
                                                    <i class="fas fa-eye me-2 text-primary"></i> Lihat Detail
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider opacity-50"></li>
                                            <li>
                                                <a class="dropdown-item rounded-3 py-2 text-danger" href="javascript:void(0)" onclick="confirmBatal(<?= $p['id']; ?>)">
                                                    <i class="fas fa-times-circle me-2"></i> Batalkan Pesanan
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-0 p-4 border-top">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                <p class="text-muted small mb-0">
                    Menampilkan <strong><?= count($data['pesanan']); ?></strong> dari <strong><?= $data['pagination']['total_records']; ?></strong> pesanan terbaru.
                </p>
                
                <?php if($data['pagination']['total_pages'] > 1): ?>
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-sm mb-0 gap-2">
                        <?php 
                            $curr = $data['pagination']['current_page'];
                            $total = $data['pagination']['total_pages'];
                            
                            $buildUrl = function($page) use ($queryParams) {
                                $params = $queryParams;
                                $params['page'] = $page;
                                return BASEURL . '/admin/pesanan?' . http_build_query($params);
                            };
                        ?>

                        <!-- Previous -->
                        <li class="page-item <?= ($curr <= 1) ? 'disabled' : ''; ?>">
                            <a class="page-link border-0 rounded-3 shadow-sm transition-all <?= ($curr <= 1) ? 'bg-light' : 'bg-white text-dark'; ?>" href="<?= ($curr <= 1) ? '#' : $buildUrl($curr - 1); ?>">
                                <i class="fas fa-chevron-left small"></i>
                            </a>
                        </li>

                        <!-- Numbers -->
                        <?php 
                        $start = max(1, $curr - 2);
                        $end = min($total, $curr + 2);
                        
                        if($start > 1): ?>
                            <li class="page-item"><a class="page-link border-0 rounded-3 shadow-sm bg-white text-dark mx-1" href="<?= $buildUrl(1); ?>">1</a></li>
                            <?php if($start > 2): ?><li class="page-item disabled"><span class="page-link border-0 bg-transparent text-muted">...</span></li><?php endif; ?>
                        <?php endif; ?>

                        <?php for($i = $start; $i <= $end; $i++): ?>
                        <li class="page-item <?= ($curr == $i) ? 'active' : ''; ?>">
                            <a class="page-link border-0 rounded-3 shadow-sm mx-1 transition-all <?= ($curr == $i) ? 'bg-danger text-white' : 'bg-white text-dark'; ?>" href="<?= $buildUrl($i); ?>"><?= $i; ?></a>
                        </li>
                        <?php endfor; ?>

                        <?php if($end < $total): ?>
                            <?php if($end < $total - 1): ?><li class="page-item disabled"><span class="page-link border-0 bg-transparent text-muted">...</span></li><?php endif; ?>
                            <li class="page-item"><a class="page-link border-0 rounded-3 shadow-sm bg-white text-dark mx-1" href="<?= $buildUrl($total); ?>"><?= $total; ?></a></li>
                        <?php endif; ?>

                        <!-- Next -->
                        <li class="page-item <?= ($curr >= $total) ? 'disabled' : ''; ?>">
                            <a class="page-link border-0 rounded-3 shadow-sm transition-all <?= ($curr >= $total) ? 'bg-light' : 'bg-white text-dark'; ?>" href="<?= ($curr >= $total) ? '#' : $buildUrl($curr + 1); ?>">
                                <i class="fas fa-chevron-right small"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
                <?php endif; ?>
            </div>
        </div>
    </div>
<style>
    .btn-white {
        background: #fff;
        color: #333;
    }
    .btn-white:hover {
        background: #f8f9fa;
    }
    .table thead th {
        font-weight: 700;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 0.5px;
        color: #6c757d;
    }
    .transition-all {
        transition: all 0.3s ease;
    }

    /* Premium Stat Cards CSS */
    .stat-card-premium {
        background: #fff;
        border-radius: 20px;
        padding: 20px;
        position: relative;
        overflow: hidden;
        height: 140px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        transition: transform 0.3s ease;
    }
    .stat-card-premium:hover {
        transform: translateY(-5px);
    }
    .icon-box-premium {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        z-index: 2;
        position: relative;
    }
    .box-red { background: rgba(163, 13, 17, 0.1); color: #A30D11; }
    .box-green { background: rgba(39, 174, 96, 0.1); color: #27AE60; }
    .box-orange { background: rgba(242, 153, 74, 0.1); color: #F2994A; }
    .box-blue { background: rgba(0, 123, 255, 0.1); color: #007bff; }
    
    .stat-label-new { font-weight: 800; font-size: 12px; line-height: 1; z-index: 2; position: relative; }
    .stat-sublabel { font-size: 10px; font-weight: 600; z-index: 2; position: relative; }
    .stat-value-new { font-size: 1.5rem; font-weight: 800; line-height: 1; z-index: 2; position: relative; }
    .stat-badge { font-size: 10px; padding: 4px 8px; border-radius: 6px; font-weight: 700; z-index: 2; position: relative; }
    .badge-red { background: rgba(163, 13, 17, 0.1); color: #A30D11; }
    .badge-green { background: rgba(39, 174, 96, 0.1); color: #27AE60; }
    .badge-orange { background: rgba(242, 153, 74, 0.1); color: #F2994A; }
    .badge-blue { background: rgba(0, 123, 255, 0.1); color: #007bff; }
    
    .card-glow {
        position: absolute;
        top: -50px;
        right: -50px;
        width: 150px;
        height: 150px;
        border-radius: 50%;
        filter: blur(40px);
        opacity: 0.1;
        z-index: 0;
    }
    .red-glow { background: #A30D11; }
    .green-glow { background: #27AE60; }
    .orange-glow { background: #F2994A; }
    .blue-glow { background: #007bff; }

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
    function confirmBatal(id) {
        Swal.fire({
            title: 'Batalkan Pesanan?',
            text: "Pesanan yang dibatalkan tidak dapat dikembalikan statusnya.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#A30D11',
            cancelButtonColor: '#6e7881',
            confirmButtonText: 'Ya, Batalkan!',
            cancelButtonText: 'Kembali',
            borderRadius: '20px'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '<?= BASEURL; ?>/admin/update_status_pesanan';
                
                const idInput = document.createElement('input');
                idInput.type = 'hidden';
                idInput.name = 'id';
                idInput.value = id;
                
                const statusInput = document.createElement('input');
                statusInput.type = 'hidden';
                statusInput.name = 'status';
                statusInput.value = 'dibatalkan';
                
                form.appendChild(idInput);
                form.appendChild(statusInput);
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>
