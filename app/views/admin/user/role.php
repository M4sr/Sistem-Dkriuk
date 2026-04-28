
    <!-- Header Area -->
    <div class="row align-items-center mb-4 g-3">
        <div class="col-md-8">
            <h4 class="fw-bold mb-1">Role & Hak Akses</h4>
            <p class="text-muted small mb-0">Atur batasan akses untuk setiap tingkatan administrator</p>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="<?= BASEURL; ?>/admin/tambah_role" class="btn btn-danger rounded-3 px-4 fw-bold shadow-sm w-100 w-md-auto d-inline-flex justify-content-center align-items-center">
                <i class="fas fa-plus-circle me-2"></i> Tambah Role Baru
            </a>
        </div>
    </div>

    <div class="row g-4">
        <?php foreach($data['roles'] as $role) : 
            $perms = $this->model('Role_model')->getPermissionsByRoleId($role['id']);
            $all_perms = $this->model('Role_model')->getAllPermissions();
            $icon = ($role['id'] == 1) ? 'user-shield' : 'user-tie';
            $color = ($role['id'] == 1) ? 'danger' : 'primary';
        ?>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 border-start border-4 border-<?= $color; ?>">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-<?= $color; ?> bg-opacity-10 text-<?= $color; ?> rounded-3 p-3 me-3">
                                <i class="fas fa-<?= $icon; ?> fs-4"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-0"><?= $role['nama_role']; ?></h5>
                                <span class="badge bg-<?= $color; ?> rounded-pill px-2 py-1 mt-1" style="font-size: 9px;"><?= $role['id'] == 1 ? 'Default' : 'Custom'; ?> Role</span>
                            </div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm rounded-circle shadow-sm" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v text-muted"></i>
                            </button>
                            <ul class="dropdown-menu border-0 shadow-sm rounded-3">
                                <li><a class="dropdown-item py-2" href="<?= BASEURL; ?>/admin/edit_role/<?= $role['id']; ?>"><i class="fas fa-edit me-2 text-primary"></i> Edit Izin</a></li>
                                <?php if($role['id'] > 2): ?>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item py-2 text-danger" href="javascript:void(0)" onclick="konfirmasiHapus('<?= BASEURL; ?>/admin/hapus_role/<?= $role['id']; ?>')"><i class="fas fa-trash-alt me-2"></i> Hapus Role</a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                    
                    <h6 class="fw-bold mb-3 small text-muted text-uppercase">Izin Akses</h6>
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        <?php foreach($all_perms as $p): 
                            $is_allowed = in_array($p['id'], $perms);
                        ?>
                        <span class="badge bg-light text-dark border py-2 px-3 rounded-pill small <?= !$is_allowed ? 'opacity-50 text-decoration-line-through' : ''; ?>">
                            <i class="fas <?= $is_allowed ? 'fa-check-circle text-success' : 'fa-times-circle text-danger'; ?> me-1"></i> 
                            <?= $p['judul_menu']; ?>
                        </span>
                        <?php endforeach; ?>
                    </div>

                    <p class="text-muted small mb-0 mt-auto"><?= $role['deskripsi']; ?></p>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Permission Info Section -->
    <div class="mt-5">
        <div class="card border-0 shadow-sm rounded-4 bg-light bg-opacity-50 border border-dashed p-4">
            <div class="row align-items-center">
                <div class="col-md-1 text-center">
                    <i class="fas fa-shield-alt text-muted fs-1"></i>
                </div>
                <div class="col-md-11">
                    <h6 class="fw-bold mb-1">Pentingnya Role Akses</h6>
                    <p class="text-muted small mb-0">Role akses memastikan keamanan data dengan membatasi siapa saja yang bisa mengubah konfigurasi sistem atau melihat laporan keuangan rahasia perusahaan.</p>
                </div>
            </div>
        </div>
    </div>


<style>
    .border-dashed {
        border: 2px dashed #e5e7eb !important;
    }
</style>
