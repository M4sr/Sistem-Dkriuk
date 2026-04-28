<div class="container-fluid d-flex align-items-center justify-content-center" style="min-height: 80vh;">
    <div class="text-center p-5 shadow-sm rounded-5 bg-white" style="max-width: 600px; border: 1px solid #f1f1f1;">
        <!-- Icon/Illustration -->
        <div class="mb-4">
            <div class="d-inline-flex align-items-center justify-content-center bg-danger bg-opacity-10 rounded-circle mb-3" style="width: 120px; height: 120px;">
                <i class="fas fa-user-shield text-danger" style="font-size: 60px;"></i>
            </div>
            <h1 class="display-5 fw-800 text-dark mb-0" style="font-weight: 800;">403</h1>
            <h3 class="fw-bold text-danger">Akses Dibatasi!</h3>
        </div>

        <!-- Message -->
        <div class="mb-5">
            <p class="text-muted fs-5">Waduh! Sepertinya Anda tidak memiliki izin untuk melihat halaman ini. Silakan hubungi <strong>Owner</strong> jika Anda merasa ini adalah kesalahan.</p>
        </div>

        <!-- Buttons -->
        <div class="d-flex gap-3 justify-content-center">
            <a href="<?= BASEURL; ?>/admin/dashboard" class="btn btn-danger px-4 py-2 fw-bold rounded-3 shadow-sm">
                <i class="fas fa-home me-2"></i> Kembali ke Dashboard
            </a>
            <button onclick="history.back()" class="btn btn-light px-4 py-2 fw-bold rounded-3 border">
                <i class="fas fa-arrow-left me-2"></i> Kembali Sebelumnya
            </button>
        </div>

        <!-- Footer Note -->
        <div class="mt-5 pt-4 border-top">
            <small class="text-muted italic">Sistem Keamanan SI Fried Chicken &copy; 2026</small>
        </div>
    </div>
</div>

<style>
    body {
        background-color: #f8f9fa !important;
    }
    .fw-800 {
        font-weight: 800;
    }
</style>
