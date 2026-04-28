
<?php $u = $data['user']; ?>
    <!-- Header Area -->
    <div class="row align-items-center mb-4 g-3">
        <div class="col-md-7 d-flex align-items-center">
            <a href="<?= BASEURL; ?>/admin/user" class="btn btn-white shadow-sm rounded-circle me-3 flex-shrink-0" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-arrow-left text-muted"></i>
            </a>
            <div>
                <h4 class="fw-bold mb-1">Edit Data Admin</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0" style="font-size: 12px;">
                        <li class="breadcrumb-item"><a href="<?= BASEURL; ?>/admin/user" class="text-muted text-decoration-none">Manajemen Admin</a></li>
                        <li class="breadcrumb-item active text-danger fw-bold" aria-current="page">Edit Admin</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-md-5 text-md-end">
            <div class="d-flex gap-2 justify-content-md-end">
                <a href="<?= BASEURL; ?>/admin/user" class="btn btn-white shadow-sm px-4 fw-bold rounded-3 w-100 w-md-auto d-flex justify-content-center align-items-center">Batal</a>
                <button type="submit" form="formEditUser" class="btn btn-danger shadow-sm px-4 fw-bold rounded-3 w-100 w-md-auto d-flex justify-content-center align-items-center">Simpan</button>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Main Form -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4 border-bottom pb-3"><i class="fas fa-user-edit me-2 text-danger"></i> Informasi Akun</h5>
                    <form action="<?= BASEURL; ?>/admin/proses_edit_user" method="post" id="formEditUser">
                        <input type="hidden" name="id" value="<?= $u['id']; ?>">
                        
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control rounded-3 py-2" value="<?= $u['nama']; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Username</label>
                                <input type="text" name="username" class="form-control rounded-3 py-2" value="<?= $u['username']; ?>" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold">Peran (Role) Hak Akses</label>
                            <select name="role" class="form-select rounded-3 py-2">
                                <?php foreach($data['roles'] as $role) : ?>
                                <option value="<?= $role['nama_role']; ?>" <?= ($u['role'] == $role['nama_role']) ? 'selected' : ''; ?>>
                                    <?= $role['nama_role']; ?> (<?= $role['id'] == 1 ? 'Akses Penuh' : 'Custom'; ?>)
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="form-text small text-muted">Perubahan role akan langsung mengubah hak akses fitur untuk admin ini.</div>
                        </div>

                        <div class="alert alert-warning border-0 rounded-4 p-3 mb-0">
                            <div class="d-flex">
                                <div class="me-3">
                                    <i class="fas fa-key fs-4 text-warning"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">Keamanan Password</h6>
                                    <p class="small mb-2 text-muted">Biarkan kosong jika tidak ingin mengubah password.</p>
                                    <input type="password" name="password" class="form-control rounded-3 py-2" placeholder="Masukkan password baru jika ingin mengganti">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar Info -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4 text-center">
                    <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center fw-bold text-white shadow-sm" style="width: 100px; height: 100px; background: linear-gradient(135deg, #A30D11 0%, #D82D33 100%); font-size: 40px;">
                        <?= strtoupper(substr($u['nama'], 0, 1)); ?>
                    </div>
                    <h5 class="fw-bold mb-1"><?= $u['nama']; ?></h5>
                    <?php 
                        $r_name = strtolower($u['role']);
                        $b_class = 'bg-light text-dark border';
                        if (strpos($r_name, 'super') !== false || strpos($r_name, 'admin') !== false) $b_class = 'bg-danger text-white';
                        elseif (strpos($r_name, 'kasir') !== false || strpos($r_name, 'finance') !== false) $b_class = 'bg-primary text-white';
                        elseif (strpos($r_name, 'manager') !== false || strpos($r_name, 'owner') !== false) $b_class = 'bg-purple text-white';
                        elseif (strpos($r_name, 'pelayan') !== false || strpos($r_name, 'waiter') !== false) $b_class = 'bg-success text-white';
                    ?>
                    <span class="badge rounded-pill px-3 py-1 fw-bold <?= $b_class; ?>" style="font-size: 10px;">
                        <?= $u['role']; ?>
                    </span>
                    <hr class="my-4 text-muted opacity-25">
                    <div class="text-start small text-muted">
                        <div class="d-flex justify-content-between mb-2">
                            <span>ID Admin</span>
                            <span class="fw-bold text-dark">#<?= $u['id']; ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Dibuat Pada</span>
                            <span class="fw-bold text-dark"><?= date('d/m/Y', strtotime($u['created_at'])); ?></span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Status</span>
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2 py-1" style="font-size: 9px;">Aktif</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 bg-light bg-opacity-50">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3 small"><i class="fas fa-history me-2 text-muted"></i> Riwayat Singkat</h6>
                    <ul class="list-unstyled mb-0" style="font-size: 11px;">
                        <li class="mb-3 d-flex border-start border-2 border-danger ps-3">
                            <div>
                                <div class="fw-bold text-dark">Terdaftar di sistem</div>
                                <div class="text-muted"><?= date('d M Y, H:i', strtotime($u['created_at'])); ?></div>
                            </div>
                        </li>
                        <li class="d-flex border-start border-2 border-muted ps-3">
                            <div>
                                <div class="fw-bold text-dark">Terakhir diperbarui</div>
                                <div class="text-muted"><?= date('d M Y, H:i'); ?> WIB</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
