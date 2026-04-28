<?php 
$logo = !empty($data['pengaturan']['logo']) ? BASEURL . '/assets/img/logo/' . $data['pengaturan']['logo'] : 'https://ui-avatars.com/api/?name=DK&background=fff&color=A30D11'; 
?>

<!-- Mobile Top Header -->
<div class="mobile-top-header">
    <a href="<?= BASEURL; ?>">
        <img src="<?= $logo; ?>" alt="Logo" style="height: 35px;">
    </a>
    <a href="<?= BASEURL; ?>/checkout" class="position-relative text-white">
        <i class="fas fa-shopping-basket fs-4"></i>
        <span id="navCartBadgeMobile" class="badge bg-white text-danger rounded-pill position-absolute top-0 start-100 translate-middle d-none" style="font-size: 0.6rem;">0</span>
    </a>
</div>

<!-- Bottom Navigation Bar (Mobile) -->
<div class="bottom-nav">
    <a href="<?= BASEURL; ?>" class="bottom-nav-item <?= in_array($data['judul'], ['Beranda', 'Selamat Datang']) ? 'active' : ''; ?>">
        <i class="fas fa-home"></i>
        <span>Home</span>
    </a>
    <a href="<?= BASEURL; ?>/menu" class="bottom-nav-item <?= in_array($data['judul'], ['Menu', 'Menu Kami']) ? 'active' : ''; ?>">
        <i class="fas fa-hamburger"></i>
        <span>Menu</span>
    </a>
    <a href="<?= BASEURL; ?>/profile/pesanan" class="bottom-nav-item <?= in_array($data['judul'], ['Riwayat Pesanan', 'Detail Pesanan']) ? 'active' : ''; ?>">
        <i class="fas fa-receipt"></i>
        <span>Lacak</span>
    </a>
    <a href="<?= BASEURL; ?>/kontak" class="bottom-nav-item <?= $data['judul'] == 'Kontak Kami' ? 'active' : ''; ?>">
        <i class="fas fa-headset"></i>
        <span>Bantuan</span>
    </a>
</div>

<!-- Navbar Desktop -->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="<?= BASEURL; ?>">
            <img src="<?= $logo; ?>" alt="Logo" style="height: 45px;">
        </a>
            <button class="navbar-toggler border-0 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link <?= in_array($data['judul'], ['Beranda', 'Selamat Datang']) ? 'active' : ''; ?>" href="<?= BASEURL; ?>">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link <?= in_array($data['judul'], ['Menu', 'Menu Kami']) ? 'active' : ''; ?>" href="<?= BASEURL; ?>/menu">Menu</a></li>
                    <li class="nav-item"><a class="nav-link <?= in_array($data['judul'], ['Riwayat Pesanan', 'Detail Pesanan']) ? 'active' : ''; ?>" href="<?= BASEURL; ?>/profile/pesanan">Lacak Pesanan</a></li>
                    <li class="nav-item"><a class="nav-link <?= $data['judul'] == 'Tentang Kami' ? 'active' : ''; ?>" href="<?= BASEURL; ?>/tentang">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link <?= $data['judul'] == 'Kontak Kami' ? 'active' : ''; ?>" href="<?= BASEURL; ?>/kontak">Kontak</a></li>
                </ul>
                <div class="d-flex align-items-center">
                    <a href="<?= BASEURL; ?>/checkout" class="btn btn-checkout d-flex align-items-center">
                        <i class="fas fa-shopping-basket me-2"></i> <span id="navCartBadge" class="badge bg-danger rounded-pill me-1 d-none">0</span> Checkout
                    </a>
                </div>
            </div>
        </div>
    </nav>
