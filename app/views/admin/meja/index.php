

    <!-- Header Section -->
    <div class="row align-items-center mb-5">
        <div class="col-md-6">
            <div class="d-flex align-items-center mb-2">
                <div class="bg-danger bg-opacity-10 p-2 rounded-3 me-3">
                    <i class="fas fa-chair text-danger fs-4"></i>
                </div>
                <div>
                    <h3 class="fw-bold mb-0">Manajemen Meja</h3>
                    <p class="text-muted small mb-0">Kelola nomor meja dan personalisasi tampilan barcode</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 text-md-end mt-3 mt-md-0">
            <div class="row g-2 justify-content-md-end">
                <div class="col-12 col-md-auto">
                    <div class="btn-group shadow-sm rounded-pill overflow-hidden p-1 bg-white border d-flex w-100">
                        <button type="button" class="btn btn-light border-0 rounded-pill px-3 fw-bold text-danger hover-up flex-fill" data-bs-toggle="collapse" data-bs-target="#panelPersonalitasi">
                            <i class="fas fa-palette me-1"></i> Tema
                        </button>
                        <div class="vr my-2 opacity-10"></div>
                        <button type="button" id="btnCetakSemua" class="btn btn-light border-0 rounded-pill px-3 fw-bold text-dark hover-up flex-fill">
                            <i class="fas fa-print me-1"></i> Cetak
                        </button>
                    </div>
                </div>
                <div class="col-12 col-md-auto">
                    <button type="button" class="btn btn-danger rounded-pill px-4 py-2 fw-bold shadow hover-up border-0 w-100" data-bs-toggle="modal" data-bs-target="#modalTambahMeja">
                        <i class="fas fa-plus-circle me-2"></i> Tambah Meja Baru
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Personalization Panel (Collapsed by default) -->
    <div class="collapse mb-5" id="panelPersonalitasi">
        <div class="card border-0 shadow-sm rounded-5 overflow-hidden">
            <div class="card-body p-4 p-lg-5">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <h6 class="fw-bold mb-4 d-flex align-items-center"><i class="fas fa-palette text-danger me-2"></i> Tema & Warna Barcode</h6>
                        
                        <!-- Templates -->
                        <div class="mb-4">
                            <label class="form-label small fw-800 text-muted mb-3">PILIH TEMPLATE</label>
                            <div class="row g-2">
                                <?php 
                                $templates = [
                                    ['id' => 'modern', 'icon' => 'fa-th-large', 'name' => 'Modern'],
                                    ['id' => 'classic', 'icon' => 'fa-certificate', 'name' => 'Classic'],
                                    ['id' => 'vibrant', 'icon' => 'fa-fire', 'name' => 'Vibrant'],
                                    ['id' => 'premium', 'icon' => 'fa-crown', 'name' => 'Premium'],
                                    ['id' => 'luxury', 'icon' => 'fa-gem', 'name' => 'Luxury'],
                                    ['id' => 'minimalist', 'icon' => 'fa-minus', 'name' => 'Minimalist']
                                ];
                                foreach($templates as $t): ?>
                                <div class="col-4 col-sm-2">
                                    <div class="p-2 rounded-4 text-center border cursor-pointer template-opt <?= $t['id'] == 'modern' ? 'active' : ''; ?>" data-template="<?= $t['id']; ?>">
                                        <div class="bg-light rounded-3 mb-1 py-2"><i class="fas <?= $t['icon']; ?> small"></i></div>
                                        <div class="small fw-bold" style="font-size: 9px;"><?= $t['name']; ?></div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <!-- Shapes -->
                                <div class="mb-4">
                                    <label class="form-label small fw-800 text-muted mb-3">BENTUK QR</label>
                                    <div class="d-flex gap-2">
                                        <div class="flex-fill p-2 rounded-4 border text-center cursor-pointer shape-opt active" data-shape="square">
                                            <i class="fas fa-square mb-1"></i><br><span class="small fw-bold" style="font-size: 10px;">Kotak</span>
                                        </div>
                                        <div class="flex-fill p-2 rounded-4 border text-center cursor-pointer shape-opt" data-shape="rounded">
                                            <i class="fas fa-square-full mb-1" style="border-radius: 4px; border: 1px solid;"></i><br><span class="small fw-bold" style="font-size: 10px;">Rounded</span>
                                        </div>
                                        <div class="flex-fill p-2 rounded-4 border text-center cursor-pointer shape-opt" data-shape="circle">
                                            <i class="fas fa-circle mb-1"></i><br><span class="small fw-bold" style="font-size: 10px;">Bulat</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Colors -->
                                <div class="mb-0">
                                    <label class="form-label small fw-800 text-muted mb-3">WARNA TEMA</label>
                                    <div class="d-flex flex-wrap gap-2 align-items-center">
                                        <div class="color-opt active" style="background: #A30D11;" data-color="#A30D11"></div>
                                        <div class="color-opt" style="background: #2D3436;" data-color="#2D3436"></div>
                                        <div class="color-opt" style="background: #0984E3;" data-color="#0984E3"></div>
                                        <div class="color-opt" style="background: #00B894;" data-color="#00B894"></div>
                                        <div class="ms-2">
                                            <input type="color" id="customColor" class="form-control form-control-color border-0 p-0" style="width: 28px; height: 28px;" title="Pilih warna kustom">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <h6 class="fw-bold mb-4 d-flex align-items-center"><i class="fas fa-id-card text-danger me-2"></i> Identitas Barcode Meja</h6>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label small fw-800 text-muted mb-2">NAMA TOKO (DI BARCODE)</label>
                                <input type="text" id="customShopName" class="form-control rounded-3 py-2" value="<?= $data['pengaturan']['barcode_custom_name'] ?? $data['pengaturan']['nama_toko']; ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-800 text-muted mb-2">ALAMAT TOKO (DI BARCODE)</label>
                                <input type="text" id="customShopAddress" class="form-control rounded-3 py-2" value="<?= $data['pengaturan']['barcode_custom_address'] ?? $data['pengaturan']['alamat_toko']; ?>">
                            </div>
                        </div>
                        <div class="p-4 bg-danger bg-opacity-5 rounded-4 border border-dashed border-danger border-opacity-20 text-center">
                            <p class="text-muted small mb-0">Klik <strong>Simpan Konfigurasi</strong> untuk menetapkan tema ini sebagai default cetakan barcode semua meja.</p>
                            <button type="button" id="btnSaveTheme" class="btn btn-danger btn-sm rounded-pill px-4 fw-bold mt-3 shadow-sm">
                                <i class="fas fa-save me-1"></i> Simpan Konfigurasi Tema
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Summary -->
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden position-relative h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted small fw-bold mb-1">TOTAL MEJA</p>
                            <h2 class="fw-800 mb-0"><?= count($data['meja']); ?></h2>
                        </div>
                        <div class="bg-primary bg-opacity-10 p-3 rounded-4">
                            <i class="fas fa-chair text-primary fs-4"></i>
                        </div>
                    </div>
                </div>
                <div class="card-glow primary-glow opacity-10"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden position-relative h-100">
                <div class="card-body p-4 text-center d-flex flex-column justify-content-center">
                    <div class="mb-2">
                        <i class="fas fa-check-circle text-success fs-3 mb-2"></i>
                        <h6 class="fw-bold mb-0">Sistem Aktif</h6>
                    </div>
                    <p class="text-muted small mb-0">QR Code digenerate otomatis tiap ada meja baru</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tables Grid Section -->
    <div class="row g-4">
        <?php foreach($data['meja'] as $m): ?>
        <div class="col-6 col-sm-4 col-md-3 col-xl-2">
            <div class="card border-0 shadow-sm rounded-5 h-100 text-center overflow-hidden position-relative card-meja hover-up">
                <div class="position-absolute top-0 end-0 p-3">
                    <div class="status-indicator <?= $m['status'] == 'tersedia' ? 'bg-success' : 'bg-warning'; ?> shadow-sm"></div>
                </div>

                <div class="card-body p-4 pt-5">
                    <div class="meja-number-wrapper mb-3 mx-auto">
                        <div class="meja-number"><?= $m['nomor_meja']; ?></div>
                        <div class="meja-label">MEJA</div>
                    </div>
                    
                    <div class="d-grid gap-2 mb-2">
                        <button class="btn btn-danger btn-sm rounded-pill fw-bold py-2 btn-qr shadow-sm" 
                                data-nomor="<?= $m['nomor_meja']; ?>" 
                                data-token="<?= $m['qr_token']; ?>">
                            <i class="fas fa-qrcode me-2"></i> LIHAT QR
                        </button>
                    </div>

                    <div class="dropdown">
                        <button class="btn btn-link btn-sm text-muted text-decoration-none dropdown-toggle w-100 p-0" data-bs-toggle="dropdown">
                            Pengaturan
                        </button>
                        <ul class="dropdown-menu border-0 shadow-lg rounded-4 p-2">
                            <li><a class="dropdown-item rounded-3 py-2 text-danger small fw-bold" href="javascript:void(0)" onclick="konfirmasiHapusMeja('<?= BASEURL; ?>/admin/hapus_meja/<?= $m['id']; ?>')"><i class="fas fa-trash-alt me-2"></i> Hapus Meja</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-glow danger-glow opacity-5"></div>
            </div>
        </div>
        <?php endforeach; ?>

        <?php if(empty($data['meja'])): ?>
        <div class="col-12 text-center py-5">
            <div class="bg-light d-inline-block p-5 rounded-5 mb-4">
                <i class="fas fa-chair text-muted fs-1 opacity-25"></i>
            </div>
            <h5 class="fw-bold text-muted">Belum ada meja yang terdaftar</h5>
        </div>
        <?php endif; ?>
    </div>

<!-- Modal Tambah Meja -->
<div class="modal fade" id="modalTambahMeja" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-5 overflow-hidden">
            <div class="modal-header bg-danger p-4 border-0 position-relative">
                <div class="z-1 text-white">
                    <h5 class="fw-bold mb-0"><i class="fas fa-plus-circle me-2"></i> Tambah Meja Baru</h5>
                    <p class="opacity-75 small mb-0">Sistem akan generate QR Code unik otomatis</p>
                </div>
                <button type="button" class="btn-close btn-close-white z-1" data-bs-dismiss="modal"></button>
                <div class="card-glow white-glow opacity-25" style="top: -20px; right: -20px;"></div>
            </div>
            <form action="<?= BASEURL; ?>/admin/proses_tambah_meja" method="post">
                <div class="modal-body p-4 bg-white text-center">
                    <div class="mb-4">
                        <label class="form-label small fw-800 text-dark">NOMOR MEJA</label>
                        <input type="text" name="nomor_meja" class="form-control form-control-premium text-center fs-3 fw-bold py-3" placeholder="01" required autofocus>
                    </div>
                    <div class="p-3 bg-light rounded-4 border border-dashed text-center small text-muted">
                        Pelanggan akan diarahkan ke link pemesanan khusus meja ini.
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0 bg-white">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger rounded-pill px-4 fw-bold shadow">Simpan & Aktifkan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Container khusus untuk Cetak Semua (Hidden) -->
<div id="bulkPrintArea"></div>

<!-- Modal Cetak Semua (Bulk Preview) -->
<div class="modal fade" id="modalCetakSemua" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content border-0 rounded-5 overflow-hidden shadow-lg">
            <div class="modal-header bg-dark text-white border-0 px-4 py-3">
                <h5 class="modal-title fw-bold"><i class="fas fa-print me-2"></i> Preview Cetak Semua Barcode</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body bg-light p-5">
                <div class="text-center mb-5">
                    <h4 class="fw-bold mb-1">Konfirmasi Cetakan Massal</h4>
                    <p class="text-muted small">Berikut adalah tampilan seluruh barcode meja yang akan dicetak menggunakan tema aktif.</p>
                </div>
                
                <!-- Area di mana semua tiket akan di-render -->
                <div id="bulkTicketsPreview" class="d-flex flex-wrap justify-content-center gap-5">
                    <!-- Tiket akan di-generate di sini via JS -->
                </div>
            </div>
            <div class="modal-footer bg-white border-0 px-4 py-3 shadow-lg">
                <button type="button" class="btn btn-outline-secondary rounded-pill px-4 fw-bold" data-bs-dismiss="modal">Batal</button>
                <button type="button" id="btnKonfirmasiCetakSemua" class="btn btn-danger rounded-pill px-5 py-2 fw-bold shadow">
                    <i class="fas fa-print me-2"></i> KONFIRMASI CETAK SEMUA
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Preview & Personalization Integration -->
<div class="modal fade" id="modalQRPreview" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-5 overflow-hidden">
            <div class="row g-0">
                <div class="col-md-6 bg-light d-flex align-items-center justify-content-center p-5 border-end border-dashed position-relative">
                    <div id="printArea" class="ticket-preview">
                        <div id="previewCard" class="ticket modern" style="--theme-color: #A30D11;">
                            <div class="header-accent"></div>
                            <div class="p-4 pt-5">
                                <img src="<?= BASEURL; ?>/assets/img/logo/<?= $data['pengaturan']['logo']; ?>" class="preview-logo mb-3" onerror="this.style.display='none'">
                                <div><span class="scan-label mb-4">SILAKAN SCAN</span></div>
                                <div id="previewQRContainer" class="qr-container mb-4 square"></div>
                                <div class="table-info mb-3">
                                    <div class="table-label small fw-bold opacity-50 mb-1">NOMOR</div>
                                    <div id="previewTableNum" class="table-number display-4 fw-800" style="color: var(--theme-color);">01</div>
                                </div>
                                <div id="previewShopName" class="shop-name fw-800 mb-1"><?= $data['pengaturan']['barcode_custom_name'] ?? $data['pengaturan']['nama_toko']; ?></div>
                                <div id="previewShopAddr" class="shop-addr small opacity-75"><?= $data['pengaturan']['barcode_custom_address'] ?? $data['pengaturan']['alamat_toko']; ?></div>
                            </div>
                            <div class="footer-pattern"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 bg-white p-5 d-flex flex-column">
                    <button type="button" class="btn-close float-end" data-bs-dismiss="modal"></button>
                    <div class="mb-4 mt-2">
                        <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-1 mb-2 fw-bold">SIAP CETAK</span>
                        <h3 class="fw-bold mb-1 text-dark">Review Cetakan</h3>
                        <p class="text-muted small">Tampilan barcode Meja <span id="qrNomorMeja" class="fw-bold text-danger"></span> dengan tema yang dipilih.</p>
                    </div>

                    <div class="p-4 bg-light rounded-4 mb-auto border">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <span class="small fw-bold">Template: <span id="selectedTemplateLabel" class="text-capitalize">Modern</span></span>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <span class="small fw-bold">Warna: <span id="selectedColorLabel">#A30D11</span></span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <span class="small fw-bold">Bentuk: <span id="selectedShapeLabel" class="text-capitalize">Square</span></span>
                        </div>
                    </div>

                    <div class="d-grid gap-3 mt-4">
                        <button id="btnPrintQR" class="btn btn-danger rounded-4 py-3 fw-bold shadow hover-up">
                            <i class="fas fa-print fs-4 me-2"></i> CETAK BARCODE
                        </button>
                        <button id="btnDownloadQR" class="btn btn-outline-dark rounded-pill py-2 fw-bold shadow-sm">
                            <i class="fas fa-download me-2"></i> DOWNLOAD GAMBAR
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const qrModal = new bootstrap.Modal(document.getElementById('modalQRPreview'));
    const qrNomorMeja = document.getElementById('qrNomorMeja');
    const previewTableNum = document.getElementById('previewTableNum');
    const btnPrintQR = document.getElementById('btnPrintQR');
    const btnDownloadQR = document.getElementById('btnDownloadQR');
    
    // Initialize QRCode generator
    const qrcode = new QRCode(document.getElementById("previewQRContainer"), {
        width: 220,
        height: 220,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H
    });

    let currentThemeColor = '#A30D11';
    let currentTemplate = 'modern';
    let currentShape = 'square';

    // Template Selector Logic
    document.querySelectorAll('.template-opt').forEach(opt => {
        opt.addEventListener('click', function() {
            document.querySelectorAll('.template-opt').forEach(o => o.classList.remove('active'));
            this.classList.add('active');
            currentTemplate = this.getAttribute('data-template');
            
            const previewCard = document.getElementById('previewCard');
            previewCard.className = `ticket ${currentTemplate}`;
            document.getElementById('selectedTemplateLabel').textContent = currentTemplate;
        });
    });

    // Shape Selector Logic
    document.querySelectorAll('.shape-opt').forEach(opt => {
        opt.addEventListener('click', function() {
            document.querySelectorAll('.shape-opt').forEach(o => o.classList.remove('active'));
            this.classList.add('active');
            currentShape = this.getAttribute('data-shape');
            
            const container = document.getElementById('previewQRContainer');
            container.className = `qr-container mb-4 ${currentShape}`;
            document.getElementById('selectedShapeLabel').textContent = currentShape;
        });
    });

    // Color Selector Logic
    document.querySelectorAll('.color-opt').forEach(opt => {
        opt.addEventListener('click', function() {
            document.querySelectorAll('.color-opt').forEach(o => o.classList.remove('active'));
            this.classList.add('active');
            currentThemeColor = this.getAttribute('data-color');
            updateThemeColor(currentThemeColor);
        });
    });

    document.getElementById('customColor').addEventListener('input', function() {
        currentThemeColor = this.value;
        updateThemeColor(currentThemeColor);
    });

    function updateThemeColor(color) {
        document.getElementById('previewCard').style.setProperty('--theme-color', color);
        document.getElementById('selectedColorLabel').textContent = color;
    }

    // Identity Sync Logic
    document.getElementById('customShopName').addEventListener('input', function() {
        document.getElementById('previewShopName').textContent = this.value || "<?= $data['pengaturan']['nama_toko']; ?>";
    });
    document.getElementById('customShopAddress').addEventListener('input', function() {
        document.getElementById('previewShopAddr').textContent = this.value || "<?= $data['pengaturan']['alamat_toko']; ?>";
    });

    // Button QR Click Logic
    document.querySelectorAll('.btn-qr').forEach(btn => {
        btn.addEventListener('click', function() {
            const nomor = this.getAttribute('data-nomor');
            const token = this.getAttribute('data-token');
            
            if (!token) {
                Swal.fire({ icon: 'error', title: 'Token Error', text: 'Meja ini belum memiliki token QR.' });
                return;
            }

            const scanUrl = `<?= BASEURL; ?>/customer/scan/${token}`;
            
            qrNomorMeja.textContent = nomor;
            previewTableNum.textContent = nomor;
            
            // Generate QR Locally
            qrcode.clear();
            qrcode.makeCode(scanUrl);
            
            qrModal.show();
        });
    });

    // Download Action (SAMA PERSIS DENGAN BARCODE UMUM AGAR PERFECT)
    btnDownloadQR.addEventListener('click', function(e) {
        e.preventDefault();
        const container = document.getElementById('previewCard');
        const nomor = qrNomorMeja.textContent;
        
        html2canvas(container, {
            scale: 3,
            backgroundColor: null,
            useCORS: true
        }).then(canvas => {
            const link = document.createElement('a');
            link.download = `Barcode_Meja_${nomor}.png`;
            link.href = canvas.toDataURL('image/png');
            link.click();
        });
    });

    // Save Theme via AJAX
    document.getElementById('btnSaveTheme').addEventListener('click', function() {
        const btn = this;
        const name = document.getElementById('customShopName').value;
        const address = document.getElementById('customShopAddress').value;

        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Menyimpan...';

        fetch('<?= BASEURL; ?>/admin/save_barcode_settings_ajax', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `barcode_custom_name=${encodeURIComponent(name)}&barcode_custom_address=${encodeURIComponent(address)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                Swal.fire({ icon: 'success', title: 'Tersimpan!', text: 'Konfigurasi telah diperbarui.', timer: 1500, showConfirmButton: false });
            }
        })
        .finally(() => {
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-save me-1"></i> Simpan Konfigurasi Tema';
        });
    });

    // Print Functionality (IKUT POLA BARCODE UMUM - WINDOW PRINT)
    btnPrintQR.addEventListener('click', function() {
        const qrCanvas = document.querySelector('#previewQRContainer canvas');
        const qrImg = document.querySelector('#previewQRContainer img');
        
        // Pastikan QR sudah jadi gambar agar bisa diprint
        if (qrCanvas && qrImg) {
            qrImg.src = qrCanvas.toDataURL("image/png");
            qrImg.style.display = 'block';
            qrCanvas.style.display = 'none';
        }

        // Panggil print bawaan browser (CSS @media print akan handle tampilannya)
        window.print();
    });

    // Data meja untuk Cetak Semua (Pake json_encode biar aman dari error syntax)
    const daftarMejaRaw = <?= json_encode($data['meja']); ?>;
    const daftarMeja = daftarMejaRaw.map(m => ({ 
        nomor: m.nomor_meja, 
        token: m.token_qr 
    }));

    // Cetak Semua Barcode Logic (PREVIEW MODAL MODE)
    const modalBulkPrint = new bootstrap.Modal(document.getElementById('modalCetakSemua'));
    
    document.getElementById('btnCetakSemua').addEventListener('click', function() {
        if (daftarMeja.length === 0) {
            Swal.fire('Opps!', 'Belum ada meja untuk dicetak.', 'warning');
            return;
        }

        const bulkPreview = document.getElementById('bulkTicketsPreview');
        const logoUrl = document.querySelector('.preview-logo').src;
        const shopName = document.getElementById('previewShopName').textContent;
        const shopAddr = document.getElementById('previewShopAddr').textContent;

        // Bersihkan preview sebelumnya
        bulkPreview.innerHTML = '';
        
        // Render semua tiket ke modal preview
        daftarMeja.forEach((meja, index) => {
            const ticketDiv = document.createElement('div');
            ticketDiv.className = `ticket ${currentTemplate} bulk-ticket`;
            ticketDiv.style.setProperty('--theme-color', currentThemeColor);
            ticketDiv.innerHTML = `
                <div class="header-accent"></div>
                <div class="p-4 pt-5">
                    <img src="${logoUrl}" class="preview-logo mb-3" style="height: 60px;">
                    <div class="scan-label mb-4">SILAKAN SCAN</div>
                    <div id="modal-bulk-qr-${index}" class="qr-container-bulk mb-4" style="width: 200px; height: 200px; margin: 0 auto 20px auto; display: flex; align-items: center; justify-content: center; background: white; border: 2px dashed ${currentThemeColor};"></div>
                    <div class="table-info mb-3">
                        <div class="table-label small fw-bold opacity-50 mb-1">NOMOR</div>
                        <div class="table-number display-4 fw-800" style="color: ${currentThemeColor}; font-size: 3.5rem; font-weight: 800;">${meja.nomor}</div>
                    </div>
                    <div class="shop-name fw-800 mb-1" style="font-weight: 800;">${shopName}</div>
                    <div class="shop-addr small opacity-75">${shopAddr}</div>
                </div>
                <div class="footer-pattern"></div>
            `;
            bulkPreview.appendChild(ticketDiv);
            
            // Generate QR (Tunggu sebentar agar DOM siap)
            setTimeout(() => {
                new QRCode(document.getElementById("modal-bulk-qr-" + index), {
                    text: "<?= BASEURL; ?>/customer/scan/" + meja.token,
                    width: 180,
                    height: 180,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.H
                });
            }, 100);
        });

        modalBulkPrint.show();
    });

    // Konfirmasi Cetak Semua
    document.getElementById('btnKonfirmasiCetakSemua').addEventListener('click', function() {
        document.body.classList.add('is-bulk-printing');
        window.print();
        document.body.classList.remove('is-bulk-printing');
    });
});

function konfirmasiHapusMeja(url) {
    Swal.fire({
        title: 'Hapus Meja?',
        text: "Meja ini akan dihapus permanen dan QR Code tidak bisa digunakan lagi.",
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

<style>
    .fw-800 { font-weight: 800; }
    .hover-up { transition: all 0.3s ease; }
    .hover-up:hover { transform: translateY(-8px); }
    .cursor-pointer { cursor: pointer; }
    
    .template-opt, .shape-opt { transition: 0.3s; }
    .template-opt:hover, .shape-opt:hover { border-color: #A30D11 !important; background: rgba(163, 13, 17, 0.05); }
    .template-opt.active, .shape-opt.active { border-color: #A30D11 !important; background: rgba(163, 13, 17, 0.1); box-shadow: 0 5px 15px rgba(163, 13, 17, 0.1); }
    
    .color-opt { width: 32px; height: 32px; border-radius: 50%; border: 3px solid white; box-shadow: 0 0 0 1px #dee2e6; cursor: pointer; transition: 0.3s; }
    .color-opt:hover { transform: scale(1.1); }
    .color-opt.active { box-shadow: 0 0 0 2px #A30D11; }
    
    .meja-number-wrapper { width: 80px; height: 80px; background: #f8f9fa; border-radius: 24px; display: flex; flex-direction: column; justify-content: center; align-items: center; border: 2px solid #eee; transition: 0.3s; }
    .card-meja:hover .meja-number-wrapper { border-color: #A30D11; background: #A30D11; color: white; box-shadow: 0 10px 20px rgba(163, 13, 17, 0.2); }
    .meja-number { font-size: 32px; font-weight: 800; line-height: 1; }
    .meja-label { font-size: 9px; font-weight: 700; letter-spacing: 2px; opacity: 0.5; }
    
    .status-indicator { width: 10px; height: 10px; border-radius: 50%; border: 2px solid white; }
    .form-control-premium { border: 2px solid #f0f0f0; border-radius: 12px; padding: 10px 15px; transition: 0.3s; }
    .form-control-premium:focus { border-color: #A30D11; box-shadow: 0 5px 15px rgba(163, 13, 17, 0.1); }

    /* Ticket Preview Styles */
    .ticket { background: white; width: 100%; max-width: 350px; border-radius: 35px; text-align: center; position: relative; overflow: hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.1); border: 1px solid #eee; }
    .header-accent { position: absolute; top: 0; left: 0; right: 0; height: 10px; background: var(--theme-color); }
    .preview-logo { height: 50px; }
    .scan-label { display: inline-block; background: var(--theme-color); color: white; padding: 6px 15px; border-radius: 100px; font-weight: 800; font-size: 11px; letter-spacing: 1px; }
    .qr-container { display: flex; align-items: center; justify-content: center; width: 220px; height: 220px; background: white; border: 2px dashed var(--theme-color); margin: 0 auto 20px auto; position: relative; transition: all 0.3s ease; overflow: hidden; }
    .qr-container canvas, .qr-container img { display: block !important; margin: 0 auto; max-width: 100% !important; height: auto !important; }
    .qr-container img[style*="display: none"] { display: none !important; }
    .qr-container canvas[style*="display: none"] { display: none !important; }
    .footer-pattern { position: absolute; bottom: -10px; left: 0; right: 0; height: 20px; background: radial-gradient(circle, var(--theme-color) 3px, transparent 4px); background-size: 12px 12px; opacity: 0.1; }

    /* Template Variants */
    .ticket.classic { border: 5px double var(--theme-color); border-radius: 0; }
    .ticket.classic .header-accent { display: none; }
    .ticket.vibrant { background: linear-gradient(135deg, #ffffff, #fff5f5); }
    .ticket.vibrant .scan-label { background: linear-gradient(90deg, #ff4757, #ff6b81); }
    .ticket.premium { background: #1a1a1a; color: white; border-color: #333; }
    .ticket.premium .shop-name, .ticket.premium .shop-addr { color: white !important; }
    .ticket.premium .table-label { color: rgba(255,255,255,0.6) !important; }
    .ticket.premium .scan-label { background: #d4af37; color: black; }
    .ticket.luxury { border: 1px solid #d4af37; box-shadow: 0 0 20px rgba(212, 175, 55, 0.15); }
    .ticket.luxury .scan-label { background: #d4af37; }
    .ticket.minimalist { border-radius: 0; border: 2px solid #000; box-shadow: none; }
    .ticket.minimalist .header-accent { height: 20px; background: #000; }

    /* Print Styles - REPLICATED FROM BARCODE UMUM PATTERN */
    @media print {
        /* Sembunyikan segalanya secara default saat print */
        body * { visibility: hidden !important; }
        
        /* MODE 1: Cetak Satu Barcode (dari Modal Personalisasi) */
        body:not(.is-bulk-printing) #modalQRPreview, 
        body:not(.is-bulk-printing) #modalQRPreview *, 
        body:not(.is-bulk-printing) #previewCard, 
        body:not(.is-bulk-printing) #previewCard * { 
            visibility: visible !important; 
        }

        body:not(.is-bulk-printing) .modal-backdrop { display: none !important; }
        body:not(.is-bulk-printing) .modal { position: absolute !important; left: 0 !important; top: 0 !important; display: block !important; }
        body:not(.is-bulk-printing) #previewCard {
            position: fixed !important;
            left: 50% !important; top: 50% !important;
            transform: translate(-50%, -50%) scale(1.5) !important;
        }

        /* MODE 2: Cetak Semua (dari Modal Preview Bulk) */
        body.is-bulk-printing #modalCetakSemua,
        body.is-bulk-printing #modalCetakSemua *,
        body.is-bulk-printing #bulkTicketsPreview,
        body.is-bulk-printing #bulkTicketsPreview * {
            visibility: visible !important;
        }
        
        body.is-bulk-printing .modal { position: absolute !important; left: 0 !important; top: 0 !important; display: block !important; width: 100% !important; height: auto !important; overflow: visible !important; }
        body.is-bulk-printing .modal-dialog { max-width: 100% !important; width: 100% !important; margin: 0 !important; }
        body.is-bulk-printing .modal-body { padding: 0 !important; background: white !important; }
        
        body.is-bulk-printing .bulk-ticket {
            page-break-after: always !important;
            margin: 30px auto !important;
            display: block !important;
            border: 1px solid #eee !important;
            box-shadow: none !important;
        }

        /* Hilangkan elemen UI Modal (Header, Footer, Tombol Close) saat print */
        .modal-header, .modal-footer, .btn-close, .col-md-6:last-child, .badge, .modal-backdrop { display: none !important; }
        .modal-content { border: none !important; box-shadow: none !important; background: transparent !important; }

        /* Paksa warna latar belakang muncul */
        * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
        @page { margin: 10mm; size: portrait; }
    }

    /* Bulk Preview Responsiveness (Desktop & Mobile) */
    .modal-xl {
        max-width: 1300px !important;
    }
    
    #bulkTicketsPreview {
        display: grid !important;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)) !important;
        gap: 15px !important;
        width: 100% !important;
        padding: 5px !important;
        margin: 0 auto !important;
    }
    
    .bulk-ticket {
        width: 100% !important;
        max-width: 350px !important;
        margin: 0 auto !important;
        height: fit-content !important;
    }

    @media (max-width: 992px) {
        #bulkTicketsPreview {
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)) !important;
        }
        .bulk-ticket {
            max-width: 300px !important;
        }
    }

    @media (max-width: 576px) {
        #bulkTicketsPreview {
            grid-template-columns: 1fr !important;
        }
        .bulk-ticket {
            max-width: 100% !important;
        }
        .modal-body { padding: 1.5rem !important; }
    }

    .card-glow { position: absolute; width: 120px; height: 120px; border-radius: 50%; filter: blur(40px); z-index: 0; pointer-events: none; }
    .danger-glow { background: #A30D11; top: -40px; right: -40px; }
    .primary-glow { background: #0d6efd; top: -40px; right: -40px; }
    .white-glow { background: white; top: -20px; right: -20px; }
</style>
