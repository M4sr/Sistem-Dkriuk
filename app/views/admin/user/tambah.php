
    <!-- Header Area -->
    <div class="row align-items-center mb-4 g-3">
        <div class="col-md-7 d-flex align-items-center">
            <a href="<?= BASEURL; ?>/admin/user" class="btn btn-white shadow-sm rounded-circle me-3 flex-shrink-0" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-arrow-left text-muted"></i>
            </a>
            <div>
                <h4 class="fw-bold mb-1">Tambah Baru</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0" style="font-size: 12px;">
                        <li class="breadcrumb-item"><a href="<?= BASEURL; ?>/admin/user" class="text-muted text-decoration-none">Manajemen Admin</a></li>
                        <li class="breadcrumb-item active text-danger fw-bold" aria-current="page">Tambah Admin</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-md-5 text-md-end">
            <div class="d-flex gap-2 justify-content-md-end">
                <a href="<?= BASEURL; ?>/admin/user" class="btn btn-white shadow-sm px-4 fw-bold rounded-3 w-100 w-md-auto d-flex justify-content-center align-items-center">Batal</a>
                <button type="submit" form="formTambahUser" class="btn btn-danger shadow-sm px-4 fw-bold rounded-3 w-100 w-md-auto d-flex justify-content-center align-items-center">Simpan</button>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Main Form -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4 border-bottom pb-3"><i class="fas fa-user-plus me-2 text-danger"></i> Informasi Akun Baru</h5>
                    <form action="<?= BASEURL; ?>/admin/proses_tambah_user" method="post" id="formTambahUser">
                        
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="nama" id="inputNama" class="form-control rounded-3 py-2" placeholder="Contoh: Ahmad Subarjo" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Username <span class="text-danger">*</span></label>
                                <input type="text" name="username" id="inputUsername" class="form-control rounded-3 py-2" placeholder="Untuk login (kecil semua)" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold">Peran (Role) Hak Akses <span class="text-danger">*</span></label>
                            <select name="role" id="inputRole" class="form-select rounded-3 py-2">
                                <?php foreach($data['roles'] as $role) : ?>
                                <option value="<?= $role['nama_role']; ?>"><?= $role['nama_role']; ?> (<?= $role['id'] == 1 ? 'Akses Penuh' : 'Custom'; ?>)</option>
                                <?php endforeach; ?>
                            </select>
                            <div class="form-text small text-muted">Setiap role memiliki batasan fitur yang berbeda sesuai pengaturan di menu Role Akses.</div>
                        </div>

                        <div class="alert alert-danger bg-opacity-10 border-0 rounded-4 p-3 mb-0">
                            <div class="d-flex">
                                <div class="me-3">
                                    <i class="fas fa-lock fs-4 text-danger"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1 text-danger">Password Login</h6>
                                    <p class="small mb-2 text-muted">Password ini akan digunakan oleh admin untuk login pertama kali.</p>
                                    <input type="password" name="password" class="form-control rounded-3 py-2" placeholder="Masukkan password default" required>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar Preview -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4 text-center">
                    <div id="previewInitials" class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center fw-bold text-white shadow-sm" style="width: 100px; height: 100px; background: linear-gradient(135deg, #A30D11 0%, #D82D33 100%); font-size: 40px;">
                        ?
                    </div>
                    <h5 id="previewNama" class="fw-bold mb-1 text-muted">Nama Admin</h5>
                    <span id="previewRole" class="badge rounded-pill px-3 py-1 fw-bold bg-light text-dark" style="font-size: 10px;">
                        Admin Toko
                    </span>
                    <hr class="my-4 text-muted opacity-25">
                    <div class="text-start small text-muted">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Username</span>
                            <span id="previewUsername" class="fw-bold text-dark">-</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Dibuat Pada</span>
                            <span class="fw-bold text-dark"><?= date('d/m/Y'); ?></span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Status</span>
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2 py-1" style="font-size: 9px;">Baru</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 bg-light bg-opacity-50 border border-dashed">
                <div class="card-body p-4 text-center">
                    <i class="fas fa-info-circle text-muted fs-4 mb-2"></i>
                    <p class="small text-muted mb-0">Pastikan data yang Anda masukkan sudah benar sebelum menekan tombol simpan.</p>
                </div>
            </div>
        </div>
    </div>

<script>
    // Live Preview Logic
    document.getElementById('inputNama').addEventListener('input', function(e) {
        const val = e.target.value;
        document.getElementById('previewNama').innerText = val || 'Nama Admin';
        document.getElementById('previewNama').classList.toggle('text-muted', !val);
        
        // Initials
        if(val) {
            document.getElementById('previewInitials').innerText = val.charAt(0).toUpperCase();
        } else {
            document.getElementById('previewInitials').innerText = '?';
        }
    });

    document.getElementById('inputUsername').addEventListener('input', function(e) {
        document.getElementById('previewUsername').innerText = e.target.value ? '@' + e.target.value : '-';
    });

    document.getElementById('inputRole').addEventListener('change', function(e) {
        const role = e.target.value.toLowerCase();
        const preview = document.getElementById('previewRole');
        
        // Ambil teks dari option yang dipilih
        const selectedText = e.target.options[e.target.selectedIndex].text.split(' (')[0];
        preview.innerText = selectedText;

        // Logika Warna JS
        if(role.includes('super') || role.includes('admin')) {
            preview.className = 'badge rounded-pill px-3 py-1 fw-bold bg-danger text-white';
        } else if(role.includes('kasir') || role.includes('finance')) {
            preview.className = 'badge rounded-pill px-3 py-1 fw-bold bg-primary text-white';
        } else if(role.includes('manager') || role.includes('owner')) {
            preview.className = 'badge rounded-pill px-3 py-1 fw-bold bg-purple text-white';
        } else if(role.includes('pelayan') || role.includes('waiter')) {
            preview.className = 'badge rounded-pill px-3 py-1 fw-bold bg-success text-white';
        } else {
            preview.className = 'badge rounded-pill px-3 py-1 fw-bold bg-light text-dark border';
        }
    });
</script>

<style>
    .border-dashed {
        border: 2px dashed #e5e7eb !important;
    }
</style>
