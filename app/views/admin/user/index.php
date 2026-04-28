
    <!-- Header -->
    <div class="row align-items-center mb-4 g-3">
        <div class="col-md-8">
            <h4 class="fw-bold mb-1">Manajemen Admin</h4>
            <p class="text-muted small mb-0">Kelola hak akses dan staf administrator toko</p>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="<?= BASEURL; ?>/admin/tambah_user" class="btn btn-danger rounded-3 px-4 fw-bold shadow-sm w-100 w-md-auto d-inline-flex justify-content-center align-items-center">
                <i class="fas fa-user-plus me-2"></i> Tambah Admin
            </a>
        </div>
    </div>

    <!-- User Cards List -->
    <div class="row g-4">
        <?php foreach($data['users'] as $user) : 
            $initials = strtoupper(substr($user['nama'], 0, 1));
            $role_name = strtolower($user['role']);
            
            // Logika Warna Badge Dinamis
            if (strpos($role_name, 'owner') !== false) {
                $badge_class = 'bg-purple text-white';
            } elseif (strpos($role_name, 'super') !== false || strpos($role_name, 'admin') !== false) {
                $badge_class = 'bg-danger text-white';
            } elseif (strpos($role_name, 'kasir') !== false || strpos($role_name, 'finance') !== false) {
                $badge_class = 'bg-primary text-white';
            } elseif (strpos($role_name, 'manager') !== false) {
                $badge_class = 'bg-info text-white';
            } elseif (strpos($role_name, 'pelayan') !== false || strpos($role_name, 'waiter') !== false) {
                $badge_class = 'bg-success text-white';
            } else {
                $badge_class = 'bg-light text-dark border';
            }
        ?>
        <div class="col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden position-relative h-100">
                <div class="p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-white shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #A30D11 0%, #D82D33 100%); font-size: 24px;">
                            <?= $initials; ?>
                        </div>
                        <div class="ms-3">
                            <h6 class="fw-bold mb-0 text-dark"><?= $user['nama']; ?></h6>
                            <p class="text-muted small mb-1">@<?= $user['username']; ?></p>
                            <span class="badge rounded-pill px-3 py-1 fw-bold <?= $badge_class; ?>" style="font-size: 9px;">
                                <?= $user['role']; ?>
                            </span>
                        </div>
                        <div class="ms-auto">
                            <div class="dropdown">
                                <button class="btn btn-light btn-sm rounded-circle shadow-sm" type="button" data-bs-toggle="dropdown" style="width: 32px; height: 32px;">
                                    <i class="fas fa-ellipsis-v text-muted"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm rounded-3">
                                    <li><a class="dropdown-item py-2" href="<?= BASEURL; ?>/admin/edit_user/<?= $user['id']; ?>"><i class="fas fa-edit me-2 text-primary"></i> Edit Admin</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item py-2 text-danger" href="javascript:void(0)" onclick="konfirmasiHapus('<?= BASEURL; ?>/admin/hapus_user/<?= $user['id']; ?>')"><i class="fas fa-trash-alt me-2"></i> Hapus Admin</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-light rounded-3 p-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted small">Status</span>
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2 py-1" style="font-size: 9px;">Aktif</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted small">Bergabung Sejak</span>
                            <span class="fw-bold small text-dark"><?= date('d M Y', strtotime($user['created_at'])); ?></span>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 py-3 text-center">
                    <button class="btn btn-outline-danger btn-sm w-100 rounded-pill fw-bold border-2 btn-lihat-log" 
                            data-id="<?= $user['id']; ?>" 
                            data-nama="<?= $user['nama']; ?>"
                            style="font-size: 11px;">
                        Lihat Log Aktivitas
                    </button>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

<!-- Modal Log Aktivitas -->
<div class="modal fade" id="modalLogAktivitas" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 p-4">
                <h5 class="modal-title fw-bold"><i class="fas fa-history me-2 text-danger"></i> Jejak Digital: <span id="logAdminName" class="text-danger"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div id="logContainer" class="p-4" style="max-height: 400px; overflow-y: auto;">
                    <!-- Logs will be loaded here -->
                    <div class="text-center py-5" id="logLoading">
                        <div class="spinner-border text-danger" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2 text-muted small">Menarik data dari server...</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 p-4 pt-0">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const logModal = new bootstrap.Modal(document.getElementById('modalLogAktivitas'));
    const logContainer = document.getElementById('logContainer');
    const logAdminName = document.getElementById('logAdminName');
    const logLoading = document.getElementById('logLoading');

    document.querySelectorAll('.btn-lihat-log').forEach(button => {
        button.addEventListener('click', function() {
            const adminId = this.getAttribute('data-id');
            const adminNama = this.getAttribute('data-nama');
            
            logAdminName.textContent = adminNama;
            logContainer.innerHTML = '';
            logContainer.appendChild(logLoading);
            logLoading.classList.remove('d-none');
            
            logModal.show();

            fetch(`<?= BASEURL; ?>/admin/get_log_ajax/${adminId}`)
                .then(response => response.json())
                .then(data => {
                    logLoading.classList.add('d-none');
                    logContainer.innerHTML = '';
                    
                    if (data.length === 0) {
                        logContainer.innerHTML = `
                            <div class="text-center py-5">
                                <i class="fas fa-ghost fs-1 text-muted opacity-25 mb-3"></i>
                                <p class="text-muted small">Belum ada aktivitas yang tercatat untuk pengguna ini.</p>
                            </div>`;
                        return;
                    }

                    const list = document.createElement('div');
                    list.className = 'activity-timeline';
                    
                    data.forEach(log => {
                        const item = document.createElement('div');
                        item.className = 'd-flex mb-4 position-relative';
                        
                        const time = new Date(log.created_at);
                        const formattedTime = time.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
                        const formattedDate = time.toLocaleDateString('id-ID', { day: '2-digit', month: 'short' });

                        item.innerHTML = `
                            <div class="flex-shrink-0 me-3 text-center" style="width: 50px;">
                                <div class="fw-bold small text-dark">${formattedTime}</div>
                                <div class="text-muted" style="font-size: 9px;">${formattedDate}</div>
                            </div>
                            <div class="flex-grow-1 ps-3 border-start border-2 border-danger border-opacity-10">
                                <div class="p-3 bg-light rounded-4 shadow-sm border-0 mb-1">
                                    <p class="mb-0 small fw-bold text-dark">${log.aktivitas}</p>
                                </div>
                            </div>
                        `;
                        list.appendChild(item);
                    });
                    
                    logContainer.appendChild(list);
                })
                .catch(error => {
                    console.error('Error fetching logs:', error);
                    logContainer.innerHTML = '<div class="alert alert-danger">Gagal memuat data log.</div>';
                });
        });
    });
});
</script>

<style>
    .bg-purple { background-color: #6f42c1 !important; }
    .activity-timeline::before {
        content: '';
        position: absolute;
        left: 65px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #f1f5f9;
        z-index: 0;
    }
</style>
