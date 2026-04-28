<!-- Header Area -->
<div class="row align-items-center mb-4 g-3">
    <div class="col-md-8">
        <h4 class="fw-bold mb-1">Barcode Umum (Non-Meja)</h4>
        <p class="text-muted small mb-0">QR Code untuk pemesanan umum seperti Take Away atau Delivery</p>
    </div>
    <div class="col-md-4 text-md-end">
        <button class="btn btn-outline-danger rounded-3 fw-bold shadow-sm w-100" onclick="printBarcode()"
            style="max-width: 200px;">
            <i class="fas fa-print me-2"></i> Cetak Barcode
        </button>
    </div>
</div>

<div class="row g-4">
    <!-- Preview Column -->
    <div class="col-lg-5">
        <div class="sticky-lg-top" style="top: 100px;">
            <div id="barcodeTemplateContainer"
                class="card border-0 shadow-lg rounded-5 overflow-hidden text-center p-5 template-modern">
                <!-- Dynamic Template Header -->
                <div class="template-header mb-4">
                    <img src="<?= BASEURL; ?>/assets/img/logo/<?= $data['pengaturan']['logo']; ?>"
                        class="img-fluid mb-3 logo-preview" style="max-height: 80px;" alt="Logo"
                        onerror="this.src='https://ui-avatars.com/api/?name=<?= urlencode($data['pengaturan']['nama_toko']); ?>&background=A30D11&color=fff&size=128'">
                    <h5 class="fw-bold text-dark mb-0 shop-name"><?= strtoupper($data['pengaturan']['nama_toko']); ?>
                    </h5>
                    <p class="text-muted small mb-0 shop-address"><?= $data['pengaturan']['alamat_toko']; ?></p>
                </div>

                <!-- QR Container -->
                <div id="qrWrapper" class="qr-main-container bg-white rounded-4 p-3 mb-4 border mx-auto shadow-sm"
                    style="width: 220px; height: 220px; position: relative; transition: all 0.3s ease;">
                    <div id="qrcode-umum"
                        class="w-100 h-100 d-flex align-items-center justify-content-center overflow-hidden">
                        <!-- QR will be generated here -->
                    </div>
                </div>

                <!-- Template Footer -->
                <div class="template-footer">
                    <div
                        class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-4 py-2 fw-bold mb-3 scan-text">
                        <i class="fas fa-qrcode me-2"></i> SCAN UNTUK PESAN
                    </div>
                    <p class="text-muted small px-3 footer-note">Nikmati kemudahan memesan hidangan favorit Anda
                        langsung dari smartphone.</p>
                </div>
            </div>

            <div class="mt-4 text-center">
                <button class="btn btn-dark w-100 rounded-pill py-3 fw-bold shadow-sm" id="btnDownload">
                    <i class="fas fa-download me-2"></i> Download Image (.PNG)
                </button>
                <p class="text-muted small mt-2">Kualitas HD, siap cetak untuk flyer atau banner.</p>
            </div>
        </div>
    </div>

    <!-- Customization Column -->
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
            <h6 class="fw-bold mb-4 border-bottom pb-2"><i class="fas fa-magic me-2 text-danger"></i> Personalisasi
                Barcode</h6>

            <!-- Template Style -->
            <div class="mb-4">
                <label class="form-label small fw-800 text-muted mb-3">PILIH TEMPLATE</label>
                <div class="row g-3">
                    <div class="col-4 col-md-3">
                        <div class="p-2 rounded-4 text-center border cursor-pointer template-opt active"
                            data-template="modern">
                            <div class="bg-light rounded-3 mb-2 py-3"><i class="fas fa-th-large fs-5 text-dark"></i>
                            </div>
                            <div class="small fw-bold" style="font-size: 10px;">Modern</div>
                        </div>
                    </div>
                    <div class="col-4 col-md-3">
                        <div class="p-2 rounded-4 text-center border cursor-pointer template-opt"
                            data-template="classic">
                            <div class="bg-danger bg-opacity-10 rounded-3 mb-2 py-3"><i
                                    class="fas fa-certificate fs-5 text-danger"></i></div>
                            <div class="small fw-bold" style="font-size: 10px;">Classic</div>
                        </div>
                    </div>
                    <div class="col-4 col-md-3">
                        <div class="p-2 rounded-4 text-center border cursor-pointer template-opt"
                            data-template="vibrant">
                            <div class="bg-warning bg-opacity-20 rounded-3 mb-2 py-3"><i
                                    class="fas fa-fire fs-5 text-warning"></i></div>
                            <div class="small fw-bold" style="font-size: 10px;">Vibrant</div>
                        </div>
                    </div>
                    <div class="col-4 col-md-3">
                        <div class="p-2 rounded-4 text-center border cursor-pointer template-opt"
                            data-template="premium">
                            <div class="bg-dark bg-opacity-80 rounded-3 mb-2 py-3"><i
                                    class="fas fa-crown fs-5 text-warning"></i></div>
                            <div class="small fw-bold" style="font-size: 10px;">Premium</div>
                        </div>
                    </div>
                    <div class="col-4 col-md-3">
                        <div class="p-2 rounded-4 text-center border cursor-pointer template-opt" data-template="retro">
                            <div class="bg-info bg-opacity-10 rounded-3 mb-2 py-3"><i
                                    class="fas fa-history fs-5 text-info"></i></div>
                            <div class="small fw-bold" style="font-size: 10px;">Retro</div>
                        </div>
                    </div>
                    <div class="col-4 col-md-3">
                        <div class="p-2 rounded-4 text-center border cursor-pointer template-opt" data-template="neon">
                            <div class="bg-success bg-opacity-10 rounded-3 mb-2 py-3"><i
                                    class="fas fa-bolt fs-5 text-success"></i></div>
                            <div class="small fw-bold" style="font-size: 10px;">Neon</div>
                        </div>
                    </div>
                    <div class="col-4 col-md-3">
                        <div class="p-2 rounded-4 text-center border cursor-pointer template-opt"
                            data-template="luxury">
                            <div class="bg-white rounded-3 mb-2 py-3 border"><i
                                    class="fas fa-gem fs-5 text-primary"></i></div>
                            <div class="small fw-bold" style="font-size: 10px;">Luxury</div>
                        </div>
                    </div>
                    <div class="col-4 col-md-3">
                        <div class="p-2 rounded-4 text-center border cursor-pointer template-opt"
                            data-template="organic">
                            <div class="bg-success bg-opacity-20 rounded-3 mb-2 py-3"><i
                                    class="fas fa-leaf fs-5 text-success"></i></div>
                            <div class="small fw-bold" style="font-size: 10px;">Organic</div>
                        </div>
                    </div>
                    <div class="col-4 col-md-3">
                        <div class="p-2 rounded-4 text-center border cursor-pointer template-opt"
                            data-template="minimalist">
                            <div class="bg-dark bg-opacity-10 rounded-3 mb-2 py-3"><i
                                    class="fas fa-minus fs-5 text-dark"></i></div>
                            <div class="small fw-bold" style="font-size: 10px;">Minimalist</div>
                        </div>
                    </div>
                    <div class="col-4 col-md-3">
                        <div class="p-2 rounded-4 text-center border cursor-pointer template-opt"
                            data-template="geometric">
                            <div class="bg-primary bg-opacity-10 rounded-3 mb-2 py-3"><i
                                    class="fas fa-shapes fs-5 text-primary"></i></div>
                            <div class="small fw-bold" style="font-size: 10px;">Geometric</div>
                        </div>
                    </div>
                    <div class="col-4 col-md-3">
                        <div class="p-2 rounded-4 text-center border cursor-pointer template-opt"
                            data-template="sunset">
                            <div class="bg-warning bg-opacity-30 rounded-3 mb-2 py-3"><i
                                    class="fas fa-sun fs-5 text-warning"></i></div>
                            <div class="small fw-bold" style="font-size: 10px;">Sunset</div>
                        </div>
                    </div>
                    <div class="col-4 col-md-3">
                        <div class="p-2 rounded-4 text-center border cursor-pointer template-opt" data-template="royal">
                            <div class="bg-primary bg-opacity-80 rounded-3 mb-2 py-3"><i
                                    class="fas fa-chess-king fs-5 text-white"></i></div>
                            <div class="small fw-bold" style="font-size: 10px;">Royal</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- QR Shape -->
            <div class="mb-4">
                <label class="form-label small fw-800 text-muted mb-3">BENTUK BARCODE</label>
                <div class="d-flex gap-3">
                    <div class="flex-fill p-3 rounded-4 border text-center cursor-pointer shape-opt active"
                        data-shape="square">
                        <i class="fas fa-square fs-5 mb-1"></i><br><span class="small fw-bold">Kotak</span>
                    </div>
                    <div class="flex-fill p-3 rounded-4 border text-center cursor-pointer shape-opt"
                        data-shape="rounded">
                        <i class="fas fa-square-full fs-5 mb-1"
                            style="border-radius: 8px; border: 2px solid;"></i><br><span
                            class="small fw-bold">Rounded</span>
                    </div>
                    <div class="flex-fill p-3 rounded-4 border text-center cursor-pointer shape-opt"
                        data-shape="circle">
                        <i class="fas fa-circle fs-5 mb-1"></i><br><span class="small fw-bold">Bulat</span>
                    </div>
                </div>
            </div>

            <!-- QR Color -->
            <div class="mb-4">
                <label class="form-label small fw-800 text-muted mb-3">WARNA BARCODE</label>
                <div class="d-flex gap-2 flex-wrap">
                    <div class="color-opt active" style="background: #000000;" data-color="#000000"></div>
                    <div class="color-opt" style="background: #A30D11;" data-color="#A30D11"></div>
                    <div class="color-opt" style="background: #2D3436;" data-color="#2D3436"></div>
                    <div class="color-opt" style="background: #0984E3;" data-color="#0984E3"></div>
                    <div class="color-opt" style="background: #00B894;" data-color="#00B894"></div>
                    <div class="color-opt" style="background: #6C5CE7;" data-color="#6C5CE7"></div>
                    <div class="ms-2">
                        <input type="color" id="customColor" class="form-control form-control-color border-0 p-0"
                            style="width: 32px; height: 32px;" title="Pilih warna kustom">
                    </div>
                </div>
            </div>

            <!-- Custom Name & Address -->
            <div class="row g-3 mb-4">
                <div class="col-md-5">
                    <label class="form-label small fw-800 text-muted mb-2">NAMA TOKO (CUSTOM)</label>
                    <input type="text" id="customShopName" name="barcode_custom_name"
                        class="form-control rounded-3 py-2"
                        value="<?= $data['pengaturan']['barcode_custom_name'] ?? $data['pengaturan']['nama_toko']; ?>"
                        placeholder="Nama di barcode...">
                </div>
                <div class="col-md-5">
                    <label class="form-label small fw-800 text-muted mb-2">ALAMAT TOKO (CUSTOM)</label>
                    <input type="text" id="customShopAddress" name="barcode_custom_address"
                        class="form-control rounded-3 py-2"
                        value="<?= $data['pengaturan']['barcode_custom_address'] ?? $data['pengaturan']['alamat_toko']; ?>"
                        placeholder="Alamat di barcode...">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" id="btnSaveBarcodeSettings"
                        class="btn btn-outline-primary w-100 rounded-3 py-2 fw-bold shadow-sm"
                        title="Simpan sebagai default">
                        <i class="fas fa-save"></i>
                    </button>
                </div>
            </div>

            <!-- Footer Text -->
            <div class="mb-0">
                <label class="form-label small fw-800 text-muted mb-2">TEKS CATATAN (FOOTER)</label>
                <textarea id="footerTextInput" class="form-control rounded-3 py-2" rows="2"
                    placeholder="Masukkan pesan singkat untuk pelanggan..."></textarea>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 p-4">
            <h6 class="fw-bold mb-4 border-bottom pb-2"><i class="fas fa-link me-2 text-danger"></i> Link Pemesanan</h6>
            <div class="input-group mb-0">
                <input type="text" id="orderLink" class="form-control rounded-start-3 bg-light border-0 py-3 fw-bold"
                    value="<?= BASEURL; ?>/customer" readonly>
                <button class="btn btn-danger rounded-end-3 px-4 shadow-sm" onclick="copyLink()">
                    <i class="fas fa-copy me-2"></i> Copy Link
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .fw-800 {
        font-weight: 800;
    }

    .cursor-pointer {
        cursor: pointer;
    }

    /* Options Styling */
    .template-opt,
    .shape-opt {
        transition: all 0.2s ease;
        background: #fff;
        border: 2px solid #eee;
    }

    .template-opt:hover,
    .shape-opt:hover {
        border-color: #A30D11;
        background: #fffafa;
    }

    .template-opt.active,
    .shape-opt.active {
        border-color: #A30D11 !important;
        background: rgba(163, 13, 17, 0.05) !important;
        color: #A30D11;
    }

    .color-opt {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: 3px solid #fff;
        box-shadow: 0 0 0 1px #eee;
        cursor: pointer;
        transition: transform 0.2s;
    }

    .color-opt:hover {
        transform: scale(1.1);
    }

    .color-opt.active {
        box-shadow: 0 0 0 2px #A30D11;
        transform: scale(1.1);
    }

    /* Template Styles */
    .template-modern {
        background: #fff;
    }

    .template-classic {
        background: #fff;
        border: 15px solid #A30D11 !important;
    }

    .template-classic .shop-name {
        color: #A30D11 !important;
    }

    .template-classic .scan-text {
        background: #A30D11 !important;
        color: #fff !important;
        opacity: 1 !important;
    }

    .template-minimalist {
        background: #f8f9fa;
    }

    .template-minimalist .template-header {
        border-bottom: 2px solid #ddd;
        padding-bottom: 20px;
    }

    .template-minimalist #qrWrapper {
        border: none !important;
        box-shadow: none !important;
        background: transparent !important;
    }

    /* New Vibrant Template */
    .template-vibrant {
        background: linear-gradient(135deg, #A30D11 0%, #D4141A 100%);
        position: relative;
        overflow: hidden;
    }

    .template-vibrant::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: radial-gradient(rgba(255, 255, 255, 0.1) 2px, transparent 2px);
        background-size: 20px 20px;
        opacity: 0.3;
    }

    .template-vibrant .shop-name,
    .template-vibrant .shop-address,
    .template-vibrant .footer-note {
        color: #fff !important;
        position: relative;
        z-index: 1;
    }

    .template-vibrant .scan-text {
        background: #fff !important;
        color: #A30D11 !important;
        opacity: 1 !important;
        position: relative;
        z-index: 1;
    }

    .template-vibrant #qrWrapper {
        border: 5px solid rgba(255, 255, 255, 0.2) !important;
        background: #fff !important;
        position: relative;
        z-index: 1;
    }

    /* New Premium Template */
    .template-premium {
        background: #1a1a1a;
        border: 2px solid #c5a059 !important;
    }

    .template-premium .shop-name {
        color: #c5a059 !important;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    .template-premium .shop-address,
    .template-premium .footer-note {
        color: #aaa !important;
    }

    .template-premium .scan-text {
        background: #c5a059 !important;
        color: #000 !important;
        opacity: 1 !important;
    }

    .template-premium #qrWrapper {
        border: 4px solid #c5a059 !important;
        background: #fff !important;
    }

    /* New Geometric Template */
    .template-geometric {
        background: #fff;
        position: relative;
    }

    .template-geometric::after {
        content: "";
        position: absolute;
        bottom: 0;
        right: 0;
        width: 150px;
        height: 150px;
        background: #A30D11;
        clip-path: polygon(100% 0, 0% 100%, 100% 100%);
        opacity: 0.1;
    }

    .template-geometric::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100px;
        height: 100px;
        background: #A30D11;
        clip-path: polygon(0 0, 100% 0, 0 100%);
        opacity: 0.1;
    }

    /* New Luxury Template */
    .template-luxury {
        background: #fff;
        border: 4px double #000 !important;
        position: relative;
    }

    .template-luxury::after {
        content: "";
        position: absolute;
        top: 10px;
        left: 10px;
        right: 10px;
        bottom: 10px;
        border: 1px solid #000;
        pointer-events: none;
    }

    .template-luxury .shop-name {
        letter-spacing: 3px;
        font-family: 'Serif', serif;
    }

    /* New Retro Template */
    .template-retro {
        background: #fdf6e3;
        border: 10px solid #2aa198 !important;
    }

    .template-retro .shop-name {
        color: #d33682 !important;
        font-family: 'Courier New', Courier, monospace;
    }

    .template-retro .scan-text {
        background: #2aa198 !important;
        color: #fff !important;
        opacity: 1 !important;
        border-radius: 0 !important;
    }

    /* New Neon Template */
    .template-neon {
        background: #000;
        box-shadow: 0 0 20px rgba(0, 255, 0, 0.2);
    }

    .template-neon .shop-name {
        color: #39FF14 !important;
        text-shadow: 0 0 10px #39FF14;
    }

    .template-neon .shop-address,
    .template-neon .footer-note {
        color: #39FF14 !important;
        opacity: 0.7;
    }

    .template-neon .scan-text {
        background: #39FF14 !important;
        color: #000 !important;
        opacity: 1 !important;
        box-shadow: 0 0 15px #39FF14;
    }

    .template-neon #qrWrapper {
        border: 2px solid #39FF14 !important;
        background: #fff !important;
    }

    /* New Organic Template */
    .template-organic {
        background: #f0f4f0;
        border: 8px solid #2d5a27 !important;
    }

    .template-organic .shop-name {
        color: #2d5a27 !important;
    }

    .template-organic .scan-text {
        background: #2d5a27 !important;
        color: #fff !important;
        opacity: 1 !important;
    }

    .template-organic #qrWrapper {
        border: 4px solid #2d5a27 !important;
    }

    /* New Sunset Template */
    .template-sunset {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }

    .template-sunset .shop-name,
    .template-sunset .shop-address,
    .template-sunset .footer-note {
        color: #fff !important;
    }

    .template-sunset .scan-text {
        background: #fff !important;
        color: #f5576c !important;
        opacity: 1 !important;
    }

    /* New Royal Template */
    .template-royal {
        background: #002366;
        border: 10px double #fff !important;
    }

    .template-royal .shop-name {
        color: #fff !important;
        font-family: 'Georgia', serif;
        border-bottom: 1px solid #fff;
        padding-bottom: 5px;
    }

    .template-royal .shop-address,
    .template-royal .footer-note {
        color: #ccc !important;
    }

    .template-royal .scan-text {
        background: #fff !important;
        color: #002366 !important;
        opacity: 1 !important;
    }

    .template-royal #qrWrapper {
        border: 4px solid #fff !important;
    }

    /* QR Shapes */
    .qr-circle {
        border-radius: 50% !important;
        overflow: hidden;
    }

    .qr-rounded {
        border-radius: 30px !important;
    }

    @media print {

        #sidebar-wrapper,
        .navbar,
        .btn-outline-danger,
        .col-lg-7,
        .mt-4 {
            display: none !important;
        }

        #page-content-wrapper {
            margin-left: 0 !important;
            padding: 0 !important;
        }

        .container-fluid {
            padding: 0 !important;
        }

        .template-classic {
            border: 20px solid #A30D11 !important;
        }

        .template-vibrant,
        .template-sunset {
            -webkit-print-color-adjust: exact;
        }

        .template-premium,
        .template-neon,
        .template-royal {
            -webkit-print-color-adjust: exact;
            background: #000 !important;
        }

        .template-royal {
            background: #002366 !important;
        }

        body {
            background: white;
        }

        .col-lg-5 {
            width: 100% !important;
            max-width: 100% !important;
        }

        #barcodeTemplateContainer {
            box-shadow: none !important;
            margin: 0 auto;
            width: 450px !important;
            border-radius: 0 !important;
        }
    }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script>
    let qrcode;
    let currentColor = "#000000";

    document.addEventListener('DOMContentLoaded', function () {
        generateQR();

        // Template Selection
        document.querySelectorAll('.template-opt').forEach(opt => {
            opt.addEventListener('click', function () {
                document.querySelectorAll('.template-opt').forEach(o => o.classList.remove('active'));
                this.classList.add('active');

                const template = this.dataset.template;
                const container = document.getElementById('barcodeTemplateContainer');
                container.classList.remove('template-modern', 'template-classic', 'template-minimalist', 'template-vibrant', 'template-premium', 'template-geometric', 'template-retro', 'template-neon', 'template-luxury', 'template-organic', 'template-sunset', 'template-royal');
                container.classList.add('template-' + template);
            });
        });

        // Shape Selection
        document.querySelectorAll('.shape-opt').forEach(opt => {
            opt.addEventListener('click', function () {
                document.querySelectorAll('.shape-opt').forEach(o => o.classList.remove('active'));
                this.classList.add('active');

                const shape = this.dataset.shape;
                const wrapper = document.getElementById('qrWrapper');
                wrapper.classList.remove('qr-circle', 'qr-rounded');
                if (shape === 'circle') wrapper.classList.add('qr-circle');
                if (shape === 'rounded') wrapper.classList.add('qr-rounded');
            });
        });

        // Color Selection
        document.querySelectorAll('.color-opt').forEach(opt => {
            opt.addEventListener('click', function () {
                document.querySelectorAll('.color-opt').forEach(o => o.classList.remove('active'));
                this.classList.add('active');
                currentColor = this.dataset.color;
                generateQR();
            });
        });

        // Custom Color
        document.getElementById('customColor').addEventListener('input', function () {
            currentColor = this.value;
            document.querySelectorAll('.color-opt').forEach(o => o.classList.remove('active'));
            generateQR();
        });

        // Save Barcode Settings via AJAX
        document.getElementById('btnSaveBarcodeSettings').addEventListener('click', function () {
            const btn = this;
            const name = document.getElementById('customShopName').value;
            const address = document.getElementById('customShopAddress').value;

            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span>';

            fetch('<?= BASEURL; ?>/admin/save_barcode_settings_ajax', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `barcode_custom_name=${encodeURIComponent(name)}&barcode_custom_address=${encodeURIComponent(address)}`
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Tersimpan!',
                            text: 'Konfigurasi identitas barcode telah diperbarui.',
                            timer: 1500,
                            showConfirmButton: false
                        });
                    } else {
                        Swal.fire('Gagal!', 'Terjadi kesalahan saat menyimpan.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error!', 'Koneksi gagal.', 'error');
                })
                .finally(() => {
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fas fa-save"></i>';
                });
        });

        // Custom Shop Name Change
        document.getElementById('customShopName').addEventListener('input', function () {
            document.querySelector('.shop-name').textContent = this.value || "<?= $data['pengaturan']['nama_toko']; ?>";
        });

        // Custom Shop Address Change
        document.getElementById('customShopAddress').addEventListener('input', function () {
            document.querySelector('.shop-address').textContent = this.value || "<?= $data['pengaturan']['alamat_toko']; ?>";
        });

        // Footer Text Change
        document.getElementById('footerTextInput').addEventListener('input', function () {
            document.querySelector('.footer-note').textContent = this.value || "Nikmati kemudahan memesan hidangan favorit Anda langsung dari smartphone.";
        });

        // Download Action
        document.getElementById('btnDownload').addEventListener('click', function () {
            const container = document.getElementById('barcodeTemplateContainer');
            html2canvas(container, {
                scale: 3,
                backgroundColor: null,
                useCORS: true
            }).then(canvas => {
                const link = document.createElement('a');
                link.download = 'Barcode_Umum_Dkriuk.png';
                link.href = canvas.toDataURL('image/png');
                link.click();
            });
        });
    });

    function generateQR() {
        const qrContainer = document.getElementById("qrcode-umum");
        qrContainer.innerHTML = "";

        const orderUrl = document.getElementById('orderLink').value;
        qrcode = new QRCode(qrContainer, {
            text: orderUrl,
            width: 200,
            height: 200,
            colorDark: currentColor,
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });
    }

    function copyLink() {
        const copyText = document.getElementById("orderLink");
        copyText.select();
        navigator.clipboard.writeText(copyText.value);
        Swal.fire({ icon: 'success', title: 'Link Disalin!', showConfirmButton: false, timer: 1000, borderRadius: '15px' });
    }

    function printBarcode() {
        window.print();
    }
</script>