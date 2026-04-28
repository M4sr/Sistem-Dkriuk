
<div class="container-fluid px-4 py-3">
    <!-- Header Area -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <a href="<?= BASEURL; ?>/admin/kategori" class="btn btn-white shadow-sm rounded-circle me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-arrow-left text-muted"></i>
            </a>
            <div>
                <h4 class="fw-bold mb-0">Tambah Kategori</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0" style="font-size: 12px;">
                        <li class="breadcrumb-item"><a href="<?= BASEURL; ?>/admin/kategori" class="text-muted text-decoration-none">Kategori</a></li>
                        <li class="breadcrumb-item active text-danger fw-bold" aria-current="page">Tambah Kategori</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="d-flex gap-2">
            <a href="<?= BASEURL; ?>/admin/kategori" class="btn btn-white shadow-sm px-4 fw-bold rounded-3">Batal</a>
            <button type="submit" form="formTambah" class="btn btn-danger shadow-sm px-4 fw-bold rounded-3">Simpan Kategori</button>
        </div>
    </div>

    <div class="row g-4">
        <!-- Form Area -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Informasi Kategori</h5>
                    <form action="<?= BASEURL; ?>/admin/proses_tambah_kategori" method="post" id="formTambah">
                        <div class="mb-4">
                            <label class="form-label small fw-bold">Nama Kategori <span class="text-danger">*</span></label>
                            <input type="text" name="nama" id="inputNama" class="form-control rounded-3 py-2" placeholder="Contoh: Ayam Crispy" required>
                            <div class="form-text small">Nama kategori akan ditampilkan di menu utama.</div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold d-flex justify-content-between">
                                Deskripsi (Opsional)
                                <span id="charCount" class="text-muted fw-normal" style="font-size: 10px;">0/255</span>
                            </label>
                            <textarea name="deskripsi" id="inputDeskripsi" class="form-control rounded-3" rows="4" placeholder="Keterangan singkat tentang kategori ini..." maxlength="255"></textarea>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Urutan Tampil <span class="text-danger">*</span></label>
                                <input type="number" name="urutan" id="inputUrutan" class="form-control rounded-3 py-2" value="1" required>
                                <div class="form-text small">Semakin kecil angka, semakin muncul di awal.</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Status <span class="text-danger">*</span></label>
                                <select name="status" id="inputStatus" class="form-select rounded-3 py-2">
                                    <option value="aktif">Aktif</option>
                                    <option value="nonaktif">Nonaktif</option>
                                </select>
                                <div class="form-text small">Kategori aktif akan ditampilkan di aplikasi.</div>
                            </div>
                        </div>

                        <!-- Hidden Icon Input -->
                        <input type="hidden" name="ikon" id="inputIkon" value="drumstick-bite">
                    </form>
                </div>
            </div>
        </div>

        <!-- Preview Area -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Pratinjau Kategori</h5>
                    
                    <div class="text-center py-4 px-3 mb-5 rounded-4 bg-light bg-opacity-50 border border-dashed">
                        <div class="mx-auto bg-danger bg-opacity-10 text-danger rounded-circle mb-3 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                            <i id="previewIcon" class="fas fa-drumstick-bite fs-1"></i>
                        </div>
                        <h4 id="previewNama" class="fw-bold text-dark mb-2">Ayam</h4>
                        <p id="previewDeskripsi" class="text-muted small px-4 mb-3">Menu olahan ayam dengan berbagai pilihan rasa dan bumbu spesial.</p>
                        <span id="previewStatus" class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1 fw-bold" style="font-size: 10px;">Aktif</span>
                    </div>

                    <h6 class="fw-bold mb-3">Pilih Ikon Kategori</h6>
                    <p class="text-muted small mb-3">Pilih ikon yang paling mewakili kategori ini.</p>
                    
                    <div class="icon-grid d-grid gap-2" style="grid-template-columns: repeat(5, 1fr);">
                        <?php 
                        $icons = ['drumstick-bite', 'shopping-basket', 'hamburger', 'coffee', 'utensils', 'pepper-hot', 'fish', 'cheese', 'wine-bottle', 'ellipsis-h'];
                        foreach($icons as $icon) : ?>
                        <div class="icon-item border rounded-3 p-3 text-center cursor-pointer <?= ($icon == 'drumstick-bite') ? 'border-danger bg-danger bg-opacity-10 text-danger' : 'text-muted'; ?>" 
                             onclick="selectIcon('<?= $icon; ?>', this)" style="cursor: pointer; transition: 0.2s;">
                            <i class="fas fa-<?= $icon; ?> fs-5"></i>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="mt-4">
                        <button class="btn btn-outline-danger w-100 rounded-3 py-2 fw-bold" style="border-style: dashed;">
                            <i class="fas fa-upload me-2"></i> Pilih Ikon Lain
                        </button>
                        <p class="text-muted text-center mt-2 mb-0" style="font-size: 10px;">Format: FontAwesome Icon Class</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function selectIcon(iconName, element) {
        // Update Hidden Input
        document.getElementById('inputIkon').value = iconName;
        
        // Update Preview
        document.getElementById('previewIcon').className = 'fas fa-' + iconName + ' fs-1';
        
        // Update Grid Selection
        document.querySelectorAll('.icon-item').forEach(item => {
            item.classList.remove('border-danger', 'bg-danger', 'bg-opacity-10', 'text-danger');
            item.classList.add('text-muted');
        });
        element.classList.remove('text-muted');
        element.classList.add('border-danger', 'bg-danger', 'bg-opacity-10', 'text-danger');
    }

    // Live Preview Logic
    document.getElementById('inputNama').addEventListener('input', function(e) {
        document.getElementById('previewNama').innerText = e.target.value || 'Nama Kategori';
    });

    document.getElementById('inputDeskripsi').addEventListener('input', function(e) {
        const text = e.target.value;
        document.getElementById('previewDeskripsi').innerText = text || 'Keterangan singkat tentang kategori ini...';
        document.getElementById('charCount').innerText = text.length + '/255';
    });

    document.getElementById('inputStatus').addEventListener('change', function(e) {
        const status = e.target.value;
        const preview = document.getElementById('previewStatus');
        if(status === 'aktif') {
            preview.className = 'badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1 fw-bold';
            preview.innerText = 'Aktif';
        } else {
            preview.className = 'badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3 py-1 fw-bold';
            preview.innerText = 'Nonaktif';
        }
    });
</script>

<style>
    .icon-item:hover {
        background-color: rgba(163, 13, 17, 0.05);
        border-color: #A30D11;
    }
    .border-dashed {
        border: 2px dashed #e5e7eb !important;
    }
</style>
