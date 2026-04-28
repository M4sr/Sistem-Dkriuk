<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul']; ?> - <?= date('Ymd_His'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            background-color: #fff;
            color: #000;
        }
        .container-print {
            padding: 30px;
            max-width: 800px;
            margin: auto;
        }
        .kop-surat {
            border-bottom: 3px solid #000;
            margin-bottom: 20px;
            padding-bottom: 15px;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .kop-logo {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            width: 100px;
            height: 100px;
            object-fit: contain;
        }
        .kop-text {
            flex-grow: 1;
            text-align: center;
        }
        .kop-text h2 {
            margin: 0;
            font-weight: 900;
            text-transform: uppercase;
        }
        .kop-text p {
            margin: 0;
            font-size: 14px;
        }
        .report-title {
            text-align: center;
            margin-bottom: 30px;
        }
        .report-title h4 {
            text-decoration: underline;
            text-transform: uppercase;
            font-weight: bold;
        }
        .summary-box {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            gap: 20px;
        }
        .summary-item {
            flex: 1;
            border: 1px solid #000;
            padding: 15px;
            text-align: center;
        }
        .summary-item h5 {
            margin: 0;
            font-size: 12px;
            text-transform: uppercase;
            color: #555;
        }
        .summary-item p {
            margin: 5px 0 0;
            font-size: 20px;
            font-weight: bold;
        }
        .table-laporan {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        .table-laporan th, .table-laporan td {
            border: 1px solid #000;
            padding: 8px;
        }
        .table-laporan th {
            background-color: #f2f2f2 !important;
            text-align: center;
            font-weight: bold;
        }
        .tanda-tangan {
            margin-top: 50px;
            float: right;
            text-align: center;
            width: 250px;
        }
        .tanda-tangan p {
            margin-bottom: 80px;
        }
        @page {
            size: auto;
            margin: 0mm; /* Sembunyikan Header & Footer bawaan browser (URL, Judul, dll) */
        }
        @media print {
            .btn-print-group {
                display: none;
            }
            body {
                padding: 15mm; /* Tambahkan padding manual karena margin @page nol */
                margin: 0;
            }
            .container-print {
                padding: 0;
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="btn-print-group p-3 bg-light border-bottom sticky-top text-center">
        <button class="btn btn-primary px-4 fw-bold rounded-pill shadow-sm me-2" onclick="downloadPDF()">
            <i class="fas fa-file-pdf me-2"></i> Download PDF
        </button>
        <button class="btn btn-outline-danger px-4 fw-bold rounded-pill shadow-sm me-2" onclick="window.print()">
            <i class="fas fa-print me-2"></i> Print Biasa
        </button>
        <button class="btn btn-outline-secondary px-4 fw-bold rounded-pill shadow-sm" onclick="window.close()">
            <i class="fas fa-times me-2"></i> Tutup
        </button>
    </div>

    <div class="container-print">
        <!-- Kop Surat -->
        <div class="kop-surat">
            <?php 
                $site_logo = !empty($data['pengaturan']['logo']) ? BASEURL . '/assets/img/logo/' . $data['pengaturan']['logo'] : '';
            ?>
            <div class="kop-text">
                <h2 style="font-size: 28px; letter-spacing: 1px;">DKRIUK FRIED CHICKEN</h2>
                <p style="font-size: 16px;">Jl. Jend. Sudirman No. 123, Jakarta</p>
                <p style="font-size: 14px;">Telp: 08123456789 | Email: -</p>
            </div>
        </div>

        <!-- Judul Laporan -->
        <div class="report-title">
            <h4>LAPORAN PENJUALAN</h4>
            <p class="mb-0">Periode: <?= $data['filters']['range_date']; ?></p>
            <p class="small text-muted">Filter Status: <?= !empty($data['filters']['status']) ? ucfirst($data['filters']['status']) : 'Semua'; ?> | Metode: <?= !empty($data['filters']['bayar']) ? $data['filters']['bayar'] : 'Semua'; ?></p>
        </div>

        <!-- Summary -->
        <div class="summary-box">
            <div class="summary-item">
                <h5>Total Pendapatan</h5>
                <p>Rp <?= number_format($data['stats']['revenue'], 0, ',', '.'); ?></p>
            </div>
            <div class="summary-item">
                <h5>Total Pesanan</h5>
                <p><?= $data['stats']['orders']; ?> Transaksi</p>
            </div>
            <div class="summary-item">
                <h5>Rata-rata Penjualan</h5>
                <?php $avg = $data['stats']['orders'] > 0 ? $data['stats']['revenue'] / $data['stats']['orders'] : 0; ?>
                <p>Rp <?= number_format($avg, 0, ',', '.'); ?></p>
            </div>
        </div>

        <!-- Tabel Detail -->
        <table class="table-laporan">
            <thead>
                <tr>
                    <th width="30">No</th>
                    <th width="100">Kode</th>
                    <th>Pelanggan</th>
                    <th width="110">Waktu</th>
                    <th width="80">Tipe</th>
                    <th width="100">Metode</th>
                    <th width="120">Total</th>
                    <th width="85">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($data['laporan'])): ?>
                <tr>
                    <td colspan="8" class="text-center py-4">Data tidak ditemukan untuk periode ini.</td>
                </tr>
                <?php else: ?>
                    <?php $no = 1; foreach($data['laporan'] as $row): ?>
                    <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td class="text-center fw-bold"><?= $row['kode_pesanan']; ?></td>
                        <td><?= $row['nama_pelanggan'] ?: 'Meja '.$row['nomor_meja']; ?></td>
                        <td class="text-center"><?= date('d/m/Y H:i', strtotime($row['created_at'])); ?></td>
                        <td class="text-center"><?= ucfirst($row['tipe_pesanan']); ?></td>
                        <td class="text-center"><?= strtoupper($row['metode_bayar']); ?></td>
                        <td class="text-end fw-bold">Rp <?= number_format($row['total_harga'], 0, ',', '.'); ?></td>
                        <td class="text-center small"><?= ucfirst($row['status_pesanan']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="6" class="text-end">TOTAL KESELURUHAN</th>
                    <th class="text-end">Rp <?= number_format($data['stats']['revenue'], 0, ',', '.'); ?></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>

        <!-- Tanda Tangan -->
        <div class="tanda-tangan">
            <p><?= $data['pengaturan']['kabupaten_toko'] ?? 'Indramayu'; ?>, <?= date('d F Y'); ?></p>
            <br>
            <h6 class="fw-bold" style="text-decoration: underline; margin-top: 40px;"><?= $_SESSION['user_nama'] ?? 'Administrator'; ?></h6>
            <small>Dicetak oleh Sistem - DKriuk</small>
        </div>
    </div>

    <script>
        function downloadPDF() {
            const element = document.querySelector('.container-print');
            const opt = {
                margin:       [10, 10, 10, 10],
                filename:     'Laporan_Penjualan_<?= date('Ymd'); ?>.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2, useCORS: true, letterRendering: true },
                jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
            };

            // Tambahkan loading state
            const btn = document.querySelector('.btn-primary');
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Generating...';
            btn.disabled = true;

            html2pdf().set(opt).from(element).save().then(() => {
                btn.innerHTML = originalText;
                btn.disabled = false;
            });
        }

        window.onload = function() {
            // setTimeout(() => { downloadPDF(); }, 1000);
        }
    </script>
</body>
</html>
