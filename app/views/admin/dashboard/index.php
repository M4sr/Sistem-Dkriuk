
<!-- Stat Cards Premium -->
<div class="row g-3 mb-4 flex-nowrap flex-md-wrap stat-slider pb-2">
    <div class="col-10 col-sm-6 col-md-3">
        <div class="stat-card-premium">
            <div class="d-flex flex-column h-100 justify-content-between">
                <div class="d-flex align-items-center mb-3">
                    <div class="icon-box-premium box-red">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div class="ms-2">
                        <div class="stat-label-new text-danger">Total</div>
                        <div class="stat-sublabel text-muted">Pesanan</div>
                    </div>
                </div>
                <div class="d-flex align-items-end justify-content-between">
                    <div class="stat-value-new text-dark"><?= number_format($data['stats']['orders'], 0, ',', '.'); ?></div>
                    <div class="stat-badge badge-red">+<?= $data['stats']['orders'] > 0 ? '100' : '0'; ?>%</div>
                </div>
            </div>
            <div class="card-glow red-glow"></div>
        </div>
    </div>
    <div class="col-10 col-sm-6 col-md-3">
        <div class="stat-card-premium">
            <div class="d-flex flex-column h-100 justify-content-between">
                <div class="d-flex align-items-center mb-3">
                    <div class="icon-box-premium box-green">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div class="ms-2">
                        <div class="stat-label-new text-green">Total</div>
                        <div class="stat-sublabel text-muted">Pendapatan</div>
                    </div>
                </div>
                <div class="d-flex align-items-end justify-content-between">
                    <div class="stat-value-new text-dark" style="font-size: 1.2rem;">Rp <?= number_format($data['stats']['revenue'] / 1000, 0, ',', '.'); ?>K</div>
                    <div class="stat-badge badge-green">+<?= $data['stats']['revenue'] > 0 ? '100' : '0'; ?>%</div>
                </div>
            </div>
            <div class="card-glow green-glow"></div>
        </div>
    </div>
    <div class="col-10 col-sm-6 col-md-3">
        <div class="stat-card-premium">
            <div class="d-flex flex-column h-100 justify-content-between">
                <div class="d-flex align-items-center mb-3">
                    <div class="icon-box-premium box-orange">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <div class="ms-2">
                        <div class="stat-label-new text-orange">Pesanan</div>
                        <div class="stat-sublabel text-muted">Diproses</div>
                    </div>
                </div>
                <div class="d-flex align-items-end justify-content-between">
                    <div class="stat-value-new text-dark"><?= $data['stats']['diproses']; ?></div>
                    <div class="stat-badge badge-orange">Aktif</div>
                </div>
            </div>
            <div class="card-glow orange-glow"></div>
        </div>
    </div>
    <div class="col-10 col-sm-6 col-md-3">
        <div class="stat-card-premium">
            <div class="d-flex flex-column h-100 justify-content-between">
                <div class="d-flex align-items-center mb-3">
                    <div class="icon-box-premium box-purple">
                        <i class="fas fa-shopping-basket"></i>
                    </div>
                    <div class="ms-2">
                        <div class="stat-label-new text-purple">Menu</div>
                        <div class="stat-sublabel text-muted">Terjual</div>
                    </div>
                </div>
                <div class="d-flex align-items-end justify-content-between">
                    <div class="stat-value-new text-dark"><?= number_format($data['stats']['menu_sold'], 0, ',', '.'); ?></div>
                    <div class="stat-badge badge-purple">Porsi</div>
                </div>
            </div>
            <div class="card-glow purple-glow"></div>
        </div>
    </div>
</div>

<!-- Main Charts & Orders -->
<div class="row g-4 mb-4">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="fw-bold m-0">Grafik Pendapatan (7 Hari Terakhir)</h6>
                    <div class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3">Live Data</div>
                </div>
                <div class="chart-container" style="position: relative; height: 320px; width: 100%;">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="fw-bold m-0">Pesanan Terbaru</h6>
                    <a href="<?= BASEURL; ?>/admin/pesanan" class="btn btn-sm btn-light text-danger fw-bold rounded-pill px-3">Lihat Semua</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle border-0" style="font-size: 12px;">
                        <thead class="text-muted small">
                            <tr>
                                <th class="border-0">Kode</th>
                                <th class="border-0">Pelanggan</th>
                                <th class="border-0 text-end">Total</th>
                                <th class="border-0 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data['recent_orders'] as $order) : 
                                $status_badge = [
                                    'pending' => 'bg-warning',
                                    'diproses' => 'bg-info',
                                    'selesai' => 'bg-success',
                                    'dibatalkan' => 'bg-danger'
                                ];
                                $badge = $status_badge[$order['status_pesanan']] ?? 'bg-secondary';
                            ?>
                            <tr class="border-bottom border-light">
                                <td class="py-3 fw-bold text-dark">#<?= $order['kode_pesanan']; ?></td>
                                <td class="py-3">
                                    <div class="fw-bold"><?= $order['nama_pelanggan'] ?: 'Meja '.$order['nomor_meja']; ?></div>
                                    <div class="text-muted" style="font-size: 10px;"><?= date('H:i', strtotime($order['created_at'])); ?> WIB</div>
                                </td>
                                <td class="py-3 text-end fw-bold text-danger">Rp <?= number_format($order['total_harga'], 0, ',', '.'); ?></td>
                                <td class="py-3 text-center">
                                    <span class="badge <?= $badge; ?> bg-opacity-10 text-<?= str_replace('bg-', '', $badge); ?> rounded-pill px-2" style="font-size: 9px;">
                                        <?= ucfirst($order['status_pesanan']); ?>
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Extra Analytics Row -->
<div class="row g-4 mb-4">
    <!-- Menu Terlaris -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="fw-bold m-0">Menu Terlaris</h6>
                    <a href="<?= BASEURL; ?>/admin/menu" class="text-danger small fw-bold text-decoration-none">Lihat Semua</a>
                </div>
                <div class="best-selling-list">
                    <?php foreach($data['best_selling'] as $i => $item) : ?>
                    <div class="d-flex align-items-center mb-3">
                        <div class="me-3 text-muted fw-bold" style="width: 20px;"><?= $i+1; ?></div>
                        <?php 
                        $foto_path = 'assets/img/produk/' . ($item['foto'] ?? '');
                        if (!empty($item['foto']) && file_exists($foto_path)) {
                            $foto = BASEURL . '/assets/img/produk/' . $item['foto'];
                        } else {
                            $foto = 'https://placehold.co/100x100?text=' . urlencode($item['nama']);
                        }
                        ?>
                        <img src="<?= $foto; ?>" class="rounded-3 me-3" style="width: 45px; height: 45px; object-fit: cover;">
                        <div class="flex-grow-1">
                            <h6 class="mb-0 small fw-bold text-dark"><?= $item['nama']; ?></h6>
                            <small class="text-muted"><?= number_format($item['total_terjual'], 0, ',', '.'); ?> Porsi</small>
                        </div>
                        <div class="text-end fw-bold text-dark small">Rp <?= number_format($item['harga'], 0, ',', '.'); ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Pesanan (Pie Chart) -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 h-100 text-center">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-4 text-start">Status Pesanan</h6>
                <div class="chart-container mx-auto" style="position: relative; height: 220px; width: 100%;">
                    <canvas id="statusPieChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Pendapatan per Kategori -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="fw-bold m-0">Pendapatan per Kategori</h6>
                    <a href="<?= BASEURL; ?>/admin/kategori" class="text-danger small fw-bold text-decoration-none">Lihat Semua</a>
                </div>
                <div class="category-revenue-list">
                    <?php 
                    $total_cat = array_sum(array_column($data['category_revenue'], 'total'));
                    foreach($data['category_revenue'] as $cat) : 
                        $percent = ($total_cat > 0) ? round(($cat['total'] / $total_cat) * 100) : 0;
                    ?>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="small fw-bold text-dark"><?= $cat['kategori']; ?></span>
                            <span class="small fw-bold text-success"><?= $percent; ?>%</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="progress flex-grow-1 rounded-pill" style="height: 6px;">
                                <div class="progress-bar bg-success rounded-pill" style="width: <?= $percent; ?>%"></div>
                            </div>
                            <span class="ms-3 small text-muted fw-bold" style="min-width: 90px; text-align: right;">Rp <?= number_format($cat['total'], 0, ',', '.'); ?></span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Prepare data for Line Chart (Revenue)
$labels = [];
$chartData = [];
$last7Days = [];
for ($i = 6; $i >= 0; $i--) {
    $date = date('Y-m-d', strtotime("-$i days"));
    $last7Days[$date] = 0;
}
foreach ($data['revenue_chart'] as $row) {
    if (isset($last7Days[$row['tanggal']])) {
        $last7Days[$row['tanggal']] = (float)$row['total'];
    }
}
foreach ($last7Days as $date => $total) {
    $labels[] = date('d M', strtotime($date));
    $chartData[] = $total;
}

// Prepare data for Pie Chart (Status)
$pieLabels = [];
$pieData = [];
$statusColors = [
    'pending' => '#F2994A',
    'diproses' => '#2F80ED',
    'selesai' => '#27AE60',
    'dibatalkan' => '#A30D11'
];
$actualColors = [];
foreach ($data['status_stats'] as $stat) {
    $pieLabels[] = ucfirst($stat['status_pesanan']);
    $pieData[] = $stat['jumlah'];
    $actualColors[] = $statusColors[$stat['status_pesanan']] ?? '#999';
}
?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Line Chart (Revenue)
        const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
        new Chart(ctxRevenue, {
            type: 'line',
            data: {
                labels: <?= json_encode($labels); ?>,
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: <?= json_encode($chartData); ?>,
                    borderColor: '#A30D11',
                    backgroundColor: 'rgba(163, 13, 17, 0.1)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    pointBackgroundColor: '#A30D11',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { 
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1f2937',
                        padding: 12,
                        cornerRadius: 10,
                        callbacks: {
                            label: function(context) {
                                return ' Rp ' + context.parsed.y.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                if (value >= 1000000) return (value / 1000000) + 'M';
                                if (value >= 1000) return (value / 1000) + 'K';
                                return 'Rp ' + value;
                            }
                        },
                        grid: { drawBorder: false, color: 'rgba(0,0,0,0.05)' }
                    },
                    x: { grid: { display: false } }
                }
            }
        });

        // Pie Chart (Status)
        const ctxStatus = document.getElementById('statusPieChart').getContext('2d');
        new Chart(ctxStatus, {
            type: 'doughnut',
            data: {
                labels: <?= json_encode($pieLabels); ?>,
                datasets: [{
                    data: <?= json_encode($pieData); ?>,
                    backgroundColor: <?= json_encode($actualColors); ?>,
                    borderWidth: 0,
                    hoverOffset: 15
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: { size: 11, weight: 'bold' }
                        }
                    }
                }
            }
        });
    });
</script>

<style>
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
    .box-purple { background: rgba(155, 81, 224, 0.1); color: #9B51E0; }
    
    .stat-label-new { font-weight: 800; font-size: 12px; line-height: 1; z-index: 2; position: relative; }
    .stat-sublabel { font-size: 10px; font-weight: 600; z-index: 2; position: relative; }
    .stat-value-new { font-size: 1.5rem; font-weight: 800; line-height: 1; z-index: 2; position: relative; }
    .stat-badge { font-size: 10px; padding: 4px 8px; border-radius: 6px; font-weight: 700; z-index: 2; position: relative; }
    .badge-red { background: rgba(163, 13, 17, 0.1); color: #A30D11; }
    .badge-green { background: rgba(39, 174, 96, 0.1); color: #27AE60; }
    .badge-orange { background: rgba(242, 153, 74, 0.1); color: #F2994A; }
    .badge-purple { background: rgba(155, 81, 224, 0.1); color: #9B51E0; }
    
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
    .purple-glow { background: #9B51E0; }

    .border-dashed { border: 2px dashed #e5e7eb !important; }

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
