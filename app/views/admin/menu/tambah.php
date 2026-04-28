
<div class="container-fluid px-4 py-2">
    <!-- Header -->
    <div class="d-flex align-items-center mb-4">
        <a href="<?= BASEURL; ?>/admin/menu" class="text-muted text-decoration-none small d-flex align-items-center">
            <i class="fas fa-arrow-left me-2"></i> Kembali
        </a>
    </div>

    <div class="mb-4">
        <h3 class="fw-bold text-dark">Tambah Menu</h3>
        <p class="text-muted small">Tambahkan menu makanan atau minuman baru ke dalam sistem.</p>
    </div>

    <form action="<?= BASEURL; ?>/admin/proses_tambah_menu" method="POST" enctype="multipart/form-data">
        <div class="row g-4">
            <!-- Left Side: Form -->
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm p-4" style="border-radius: 20px;">
                    
                    <!-- Section: Informasi Menu -->
                    <div class="mb-5">
                        <h6 class="fw-bold mb-4">Informasi Menu</h6>
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="form-label small fw-bold">Nama Menu <span class="text-danger">*</span></label>
                                <input type="text" name="nama" class="form-control bg-light border-0 py-2 px-3" placeholder="Contoh: Ayam Crispy Original" required style="border-radius: 10px;">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Kategori <span class="text-danger">*</span></label>
                                <select name="kategori_id" class="form-select bg-light border-0 py-2 px-3" required style="border-radius: 10px;">
                                    <option value="">Pilih kategori</option>
                                    <?php foreach($data['kategori'] as $k) : ?>
                                        <option value="<?= $k['id']; ?>"><?= $k['nama']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold">Deskripsi Menu</label>
                                <textarea name="deskripsi" class="form-control bg-light border-0 py-2 px-3" rows="3" placeholder="Contoh: Ayam goreng crispy dengan bumbu original khas GFC." style="border-radius: 10px;"></textarea>
                                <div class="text-end text-muted small mt-1" style="font-size: 10px;">0/150</div>
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
                                    <input type="number" name="harga" class="form-control bg-transparent border-0 py-2" placeholder="0" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Harga Coret (Opsional)</label>
                                <div class="input-group bg-light border-0 rounded-3">
                                    <span class="input-group-text bg-transparent border-0 text-muted">Rp</span>
                                    <input type="number" name="harga_coret" class="form-control bg-transparent border-0 py-2" placeholder="0">
                                </div>
                                <div class="text-muted small mt-1" style="font-size: 10px;">Isi jika menu sedang diskon atau promo.</div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Satuan / Porsi</label>
                                <input type="text" name="satuan" class="form-control bg-light border-0 py-2 px-3" placeholder="Contoh: Porsi, Cup, Botol, dll" style="border-radius: 10px;" value="Porsi">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold d-block">Status Menu</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" name="status" id="statusSwitch" checked style="width: 40px; height: 20px; cursor: pointer;">
                                    <label class="form-check-label ms-2 fw-bold" for="statusSwitch">Aktif</label>
                                </div>
                                <div class="text-muted small mt-1" style="font-size: 10px;">Nonaktifkan jika menu tidak tersedia sementara.</div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Stok Awal</label>
                                <input type="number" name="stok" class="form-control bg-light border-0 py-2 px-3" placeholder="0" style="border-radius: 10px;" value="100">
                            </div>
                        </div>
                    </div>

                    <!-- Section: Gambar Menu -->
                    <div class="mb-5">
                        <h6 class="fw-bold mb-4">Gambar Menu</h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="upload-box border-dashed rounded-4 p-4 text-center bg-light" style="border: 2px dashed #ddd; cursor: pointer; position: relative;" onclick="document.getElementById('fotoInput').click()">
                                    <i class="fas fa-cloud-upload-alt fs-2 text-muted mb-2"></i>
                                    <div class="fw-bold small mb-1">Upload Gambar</div>
                                    <div class="text-muted small" style="font-size: 10px;">PNG, JPG atau WEBP<br>Maks. 2MB</div>
                                    <input type="file" name="foto" id="fotoInput" class="d-none" onchange="previewImage(this)">
                                    <img id="imgPreview" class="position-absolute top-0 start-0 w-100 h-100 rounded-4 d-none" style="object-fit: cover;">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="bg-primary bg-opacity-10 rounded-4 p-3 h-100 d-flex align-items-center">
                                    <div class="small">
                                        <div class="fw-bold text-primary mb-2"><i class="fas fa-info-circle me-1"></i> Tips gambar yang baik</div>
                                        <ul class="list-unstyled text-muted mb-0" style="font-size: 11px;">
                                            <li class="mb-1"><i class="fas fa-check-circle text-success me-1"></i> Gunakan foto dengan pencahayaan baik</li>
                                            <li class="mb-1"><i class="fas fa-check-circle text-success me-1"></i> Latar belakang tidak terlalu ramai</li>
                                            <li class="mb-1"><i class="fas fa-check-circle text-success me-1"></i> Rasio 1:1 atau 4:3 lebih disarankan</li>
                                            <li><i class="fas fa-check-circle text-success me-1"></i> Ukuran maksimal 2MB</li>
                                        </ul>
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
                                    <option value="Best Seller">Best Seller</option>
                                    <option value="Promo">Promo</option>
                                    <option value="New">New</option>
                                    <option value="Rekomendasi">Rekomendasi</option>
                                </select>
                                <div class="text-muted small mt-1" style="font-size: 10px;">Contoh: Best Seller, Promo, New</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Catatan Tambahan</label>
                                <textarea name="catatan_tambahan" class="form-control bg-light border-0 py-2 px-3" rows="2" placeholder="Contoh: Tidak pedas, ekstra sambal, dll" style="border-radius: 10px;"></textarea>
                                <div class="text-end text-muted small mt-1" style="font-size: 10px;">0/100</div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="<?= BASEURL; ?>/admin/menu" class="btn btn-light rounded-3 px-4 fw-bold">Batal</a>
                        <button type="submit" class="btn btn-danger rounded-3 px-4 fw-bold shadow-sm" style="background: #A30D11;">Simpan Menu</button>
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
