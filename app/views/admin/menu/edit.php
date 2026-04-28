
<div class="container-fluid px-4 py-2">
    <!-- Header -->
    <div class="d-flex align-items-center mb-4">
        <a href="<?= BASEURL; ?>/admin/menu" class="text-muted text-decoration-none small d-flex align-items-center">
            <i class="fas fa-arrow-left me-2"></i> Kembali
        </a>
    </div>

    <div class="mb-4">
        <h3 class="fw-bold text-dark">Edit Menu</h3>
        <p class="text-muted small">Perbarui informasi menu makanan atau minuman Anda.</p>
    </div>

    <?php $p = $data['produk']; ?>
    <form action="<?= BASEURL; ?>/admin/proses_edit_menu" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $p['id']; ?>">
        
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm p-4" style="border-radius: 20px;">
                    
                    <!-- Section: Informasi Menu -->
                    <div class="mb-5">
                        <h6 class="fw-bold mb-4">Informasi Menu</h6>
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="form-label small fw-bold">Nama Menu <span class="text-danger">*</span></label>
                                <input type="text" name="nama" class="form-control bg-light border-0 py-2 px-3" placeholder="Contoh: Ayam Crispy Original" required style="border-radius: 10px;" value="<?= $p['nama']; ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Kategori <span class="text-danger">*</span></label>
                                <select name="kategori_id" class="form-select bg-light border-0 py-2 px-3" required style="border-radius: 10px;">
                                    <option value="">Pilih kategori</option>
                                    <?php foreach($data['kategori'] as $k) : ?>
                                        <option value="<?= $k['id']; ?>" <?= ($p['kategori_id'] == $k['id']) ? 'selected' : ''; ?>><?= $k['nama']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold">Deskripsi Menu</label>
                                <textarea name="deskripsi" class="form-control bg-light border-0 py-2 px-3" rows="3" placeholder="Contoh: Ayam goreng crispy dengan bumbu original khas GFC." style="border-radius: 10px;"><?= $p['deskripsi']; ?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Section: Harga & Status -->
                    <div class="mb-5">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Harga <span class="text-danger">*</span></label>
                                <div class="input-group bg-light border-0 rounded-3">
                                    <span class="input-group-text bg-transparent border-0 text-muted">Rp</span>
                                    <input type="number" name="harga" class="form-control bg-transparent border-0 py-2" placeholder="0" required value="<?= (int)$p['harga']; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Harga Coret (Opsional)</label>
                                <div class="input-group bg-light border-0 rounded-3">
                                    <span class="input-group-text bg-transparent border-0 text-muted">Rp</span>
                                    <input type="number" name="harga_coret" class="form-control bg-transparent border-0 py-2" placeholder="0" value="<?= (int)$p['harga_coret']; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Satuan / Porsi</label>
                                <input type="text" name="satuan" class="form-control bg-light border-0 py-2 px-3" placeholder="Contoh: Porsi, Cup, Botol, dll" style="border-radius: 10px;" value="<?= $p['satuan']; ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold d-block">Status Menu</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" name="status" id="statusSwitch" <?= ($p['status'] == 'aktif') ? 'checked' : ''; ?> style="width: 40px; height: 20px; cursor: pointer;">
                                    <label class="form-check-label ms-2 fw-bold" for="statusSwitch">Aktif</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Stok</label>
                                <input type="number" name="stok" class="form-control bg-light border-0 py-2 px-3" placeholder="0" style="border-radius: 10px;" value="<?= $p['stok']; ?>">
                            </div>
                        </div>
                    </div>

                    <!-- Section: Gambar Menu -->
                    <div class="mb-5">
                        <h6 class="fw-bold mb-4">Gambar Menu</h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="upload-box border-dashed rounded-4 p-4 text-center bg-light" style="border: 2px dashed #ddd; cursor: pointer; position: relative; height: 150px;" onclick="document.getElementById('fotoInput').click()">
                                    <?php if(!empty($p['foto']) && file_exists('assets/img/produk/' . $p['foto'])): ?>
                                        <img id="imgPreview" src="<?= BASEURL; ?>/assets/img/produk/<?= $p['foto']; ?>" class="position-absolute top-0 start-0 w-100 h-100 rounded-4" style="object-fit: cover;">
                                    <?php else: ?>
                                        <i class="fas fa-cloud-upload-alt fs-2 text-muted mb-2"></i>
                                        <div class="fw-bold small mb-1">Ubah Gambar</div>
                                        <img id="imgPreview" class="position-absolute top-0 start-0 w-100 h-100 rounded-4 d-none" style="object-fit: cover;">
                                    <?php endif; ?>
                                    <input type="file" name="foto" id="fotoInput" class="d-none" onchange="previewImage(this)">
                                </div>
                                <div class="text-center mt-2 small text-muted" style="font-size: 10px;">Klik gambar untuk mengganti foto.</div>
                            </div>
                            <div class="col-md-8">
                                <div class="bg-primary bg-opacity-10 rounded-4 p-3 h-100 d-flex align-items-center">
                                    <div class="small text-muted" style="font-size: 11px;">
                                        Kosongkan jika tidak ingin mengubah foto produk.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section: Informasi Tambahan -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-4">Informasi Tambahan (Opsional)</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Label / Badge</label>
                                <select name="label_badge" class="form-select bg-light border-0 py-2 px-3" style="border-radius: 10px;">
                                    <option value="">Pilih label</option>
                                    <option value="Best Seller" <?= ($p['label_badge'] == 'Best Seller') ? 'selected' : ''; ?>>Best Seller</option>
                                    <option value="Promo" <?= ($p['label_badge'] == 'Promo') ? 'selected' : ''; ?>>Promo</option>
                                    <option value="New" <?= ($p['label_badge'] == 'New') ? 'selected' : ''; ?>>New</option>
                                    <option value="Rekomendasi" <?= ($p['label_badge'] == 'Rekomendasi') ? 'selected' : ''; ?>>Rekomendasi</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Catatan Tambahan</label>
                                <textarea name="catatan_tambahan" class="form-control bg-light border-0 py-2 px-3" rows="2" placeholder="Contoh: Tidak pedas, ekstra sambal, dll" style="border-radius: 10px;"><?= $p['catatan_tambahan']; ?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="<?= BASEURL; ?>/admin/menu" class="btn btn-light rounded-3 px-4 fw-bold">Batal</a>
                        <button type="submit" class="btn btn-danger rounded-3 px-4 fw-bold shadow-sm" style="background: #A30D11;">Simpan Perubahan</button>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var preview = document.getElementById('imgPreview');
            preview.src = e.target.result;
            preview.classList.remove('d-none');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

<style>
    .form-control:focus, .form-select:focus {
        box-shadow: none;
        background-color: #f1f3f5 !important;
    }
    .form-switch .form-check-input:checked {
        background-color: #27AE60;
        border-color: #27AE60;
    }
    .upload-box:hover {
        background-color: #f1f3f5 !important;
        border-color: #A30D11 !important;
    }
</style>
