
<?php $r = $data['role']; ?>
    <!-- Header Area -->
    <div class="row align-items-center mb-4 g-3">
        <div class="col-md-7 d-flex align-items-center">
            <a href="<?= BASEURL; ?>/admin/role" class="btn btn-white shadow-sm rounded-circle me-3 flex-shrink-0" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-arrow-left text-muted"></i>
            </a>
            <div>
                <h4 class="fw-bold mb-1">Edit Role Akses</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0" style="font-size: 12px;">
                        <li class="breadcrumb-item"><a href="<?= BASEURL; ?>/admin/role" class="text-muted text-decoration-none">Role Akses</a></li>
                        <li class="breadcrumb-item active text-danger fw-bold" aria-current="page">Edit Role</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-md-5 text-md-end">
            <div class="d-flex gap-2 justify-content-md-end">
                <a href="<?= BASEURL; ?>/admin/role" class="btn btn-white shadow-sm px-4 fw-bold rounded-3 w-100 w-md-auto d-flex justify-content-center align-items-center">Batal</a>
                <button type="submit" form="formEditRole" class="btn btn-danger shadow-sm px-4 fw-bold rounded-3 w-100 w-md-auto d-flex justify-content-center align-items-center">Simpan</button>
            </div>
        </div>
    </div>

    <form action="<?= BASEURL; ?>/admin/proses_edit_role" method="post" id="formEditRole">
        <input type="hidden" name="id" value="<?= $r['id']; ?>">
        
        <div class="row g-4">
            <!-- Role Info -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4 border-bottom pb-3"><i class="fas fa-id-card-alt me-2 text-danger"></i> Informasi Role</h5>
                        <div class="mb-4">
                            <label class="form-label small fw-bold">Nama Role <span class="text-danger">*</span></label>
                            <input type="text" name="nama_role" class="form-control rounded-3 py-2" value="<?= $r['nama_role']; ?>" required>
                        </div>
                        <div class="mb-0">
                            <label class="form-label small fw-bold">Deskripsi Tugas</label>
                            <textarea name="deskripsi" class="form-control rounded-3" rows="4"><?= $r['deskripsi']; ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 bg-light bg-opacity-50 border border-dashed p-4">
                    <h6 class="fw-bold"><i class="fas fa-history me-2"></i> Info Sistem</h6>
                    <hr class="my-2 opacity-10">
                    <div class="d-flex justify-content-between small text-muted">
                        <span>Role ID</span>
                        <span class="fw-bold text-dark">#<?= $r['id']; ?></span>
                    </div>
                    <div class="d-flex justify-content-between small text-muted mt-2">
                        <span>Terdaftar Sejak</span>
                        <span class="fw-bold text-dark"><?= date('d M Y', strtotime($r['created_at'])); ?></span>
                    </div>
                </div>
            </div>

            <!-- Permissions Checklist -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                            <h5 class="fw-bold mb-0"><i class="fas fa-tasks me-2 text-danger"></i> Daftar Izin Akses</h5>
                            <button type="button" class="btn btn-link btn-sm text-decoration-none fw-bold p-0" id="selectAll">Pilih Semua</button>
                        </div>

                        <div class="row g-3">
                            <?php foreach($data['permissions'] as $p) : 
                                $is_checked = in_array($p['id'], $data['role_permissions']);
                            ?>
                            <div class="col-md-6">
                                <div class="permission-item border rounded-3 p-3 transition-all h-100 <?= $is_checked ? 'border-danger bg-danger bg-opacity-10' : ''; ?>">
                                    <div class="form-check d-flex align-items-center justify-content-between p-0">
                                        <div class="d-flex align-items-center">
                                            <div class="icon-box bg-light rounded-2 d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                                <i class="fas fa-lock text-muted"></i>
                                            </div>
                                            <label class="form-check-label fw-bold small cursor-pointer" for="perm_<?= $p['id']; ?>">
                                                <?= $p['judul_menu']; ?>
                                            </label>
                                        </div>
                                        <input class="form-check-input ms-0 mt-0 perm-checkbox" type="checkbox" name="permissions[]" value="<?= $p['id']; ?>" id="perm_<?= $p['id']; ?>" style="width: 20px; height: 20px;" <?= $is_checked ? 'checked' : ''; ?>>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>


<script>
    document.getElementById('selectAll').addEventListener('click', function() {
        const checkboxes = document.querySelectorAll('.perm-checkbox');
        const isAllSelected = Array.from(checkboxes).every(c => c.checked);
        checkboxes.forEach(c => {
            c.checked = !isAllSelected;
            const item = c.closest('.permission-item');
            item.classList.toggle('border-danger', !isAllSelected);
            item.classList.toggle('bg-danger', !isAllSelected);
            item.classList.toggle('bg-opacity-10', !isAllSelected);
        });
        this.innerText = isAllSelected ? 'Pilih Semua' : 'Batal Pilih Semua';
    });

    // Hover effect for permission items
    document.querySelectorAll('.permission-item').forEach(item => {
        item.addEventListener('click', function(e) {
            if (e.target.type !== 'checkbox') {
                const cb = this.querySelector('input[type="checkbox"]');
                cb.checked = !cb.checked;
            }
            this.classList.toggle('border-danger', this.querySelector('input:checked'));
            this.classList.toggle('bg-danger', this.querySelector('input:checked'));
            this.classList.toggle('bg-opacity-10', this.querySelector('input:checked'));
        });
    });
</script>

<style>
    .permission-item {
        cursor: pointer;
        transition: 0.2s;
    }
    .permission-item:hover {
        border-color: #A30D11;
        background: rgba(163, 13, 17, 0.02);
    }
    .border-dashed {
        border: 2px dashed #e5e7eb !important;
    }
    .transition-all {
        transition: all 0.3s ease;
    }
</style>
