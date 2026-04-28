<?php
// Global settings fetch for sidebar logo & store name
$db_nav = new Database();
$db_nav->query("SELECT * FROM pengaturan");
$raw_settings = $db_nav->resultSet();
$global_settings = [];
foreach($raw_settings as $row) {
    $global_settings[$row['nama_key']] = $row['nilai_value'];
}
$site_logo = !empty($global_settings['logo']) ? BASEURL . '/assets/img/logo/' . $global_settings['logo'] : '';
$site_name = $global_settings['nama_toko'] ?? 'SI Fried Chicken';
$db_nav->query("SELECT COUNT(*) as total FROM pesanan WHERE status_pesanan != 'selesai' AND status_pesanan != 'dibatalkan'");
$active_orders = $db_nav->single()['total'] ?? 0;

$db_nav->query("SELECT COUNT(*) as total FROM meja");
$total_meja = $db_nav->single()['total'] ?? 0;

$db_nav->query("SELECT COUNT(*) as total FROM produk");
$total_menu = $db_nav->single()['total'] ?? 0;

$db_nav->query("SELECT COUNT(*) as total FROM users");
$total_users = $db_nav->single()['total'] ?? 0;

$db_nav->query("SELECT COUNT(*) as total FROM pembayaran WHERE status = 'pending'");
$pending_payments = $db_nav->single()['total'] ?? 0;

// Real-time Permissions Fetch
$user_role = $_SESSION['user_role'] ?? '';
$user_permissions = [];

if ($user_role === 'Owner') {
    // Owner gets all permissions
    $user_permissions = ['dashboard_view', 'menu_manage', 'order_manage', 'payment_manage', 'report_view', 'settings_manage', 'user_manage'];
} else {
    // Fetch from database for other roles
    $db_nav->query('SELECT p.nama_permission 
                      FROM permissions p 
                      JOIN role_permissions rp ON p.id = rp.permission_id 
                      JOIN roles r ON r.id = rp.role_id 
                      WHERE r.nama_role = :role_name');
    $db_nav->bind('role_name', $user_role);
    $perm_results = $db_nav->resultSet();
    foreach($perm_results as $p) {
        $user_permissions[] = $p['nama_permission'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - <?= $data['judul']; ?></title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --sidebar-color: #A30D11;
            --sidebar-hover: #8B0A0D;
            --bg-light: #F8F9FA;
            --primary-red: #A30D11;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-light);
            overflow-x: hidden;
        }

        /* Sidebar Styles */
        #sidebar-wrapper {
            height: 100vh;
            width: 260px;
            background-color: var(--sidebar-color);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1040; /* Di atas navbar (1030) tapi di bawah modal (1050) */
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .sidebar-heading {
            padding: 1.5rem 0.5rem;
            color: white;
            text-align: center;
            flex-shrink: 0;
            overflow: hidden;
            white-space: nowrap;
        }

        .sidebar-heading h5,
        .sidebar-heading small,
        .sidebar-heading div {
            transition: 0.3s;
        }

        .list-group {
            overflow-y: auto;
            flex-grow: 1;
        }

        .list-group::-webkit-scrollbar {
            width: 5px;
        }

        .list-group::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        .list-group-item {
            background-color: transparent;
            color: rgba(255, 255, 255, 0.7);
            border: none;
            padding: 12px 25px;
            font-size: 15px;
            font-weight: 500;
            transition: 0.3s;
            display: flex;
            align-items: center;
        }

        .list-group-item:hover {
            background-color: var(--sidebar-hover);
            color: white;
        }

        .list-group-item.active {
            background-color: white !important;
            color: var(--primary-red) !important;
            border-radius: 12px;
            margin: 5px 15px;
            padding: 12px 20px;
            width: auto;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .list-group-item.active i {
            color: var(--primary-red) !important;
        }

        .list-group-item i {
            margin-right: 15px;
            width: 20px;
            text-align: center;
        }

        .sidebar-group-label {
            padding: 20px 25px 10px;
            font-size: 10px;
            font-weight: 800;
            color: rgba(255, 255, 255, 0.4);
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        /* Dropdown Sidebar Styles */
        .sidebar-dropdown-btn {
            cursor: pointer;
            width: 100%;
            border: none;
            text-align: left;
            outline: none;
            background: transparent;
            transition: 0.3s;
        }

        .sidebar-submenu {
            background: rgba(0, 0, 0, 0.1);
            padding-left: 15px;
            overflow: hidden;
            max-height: 0;
            transition: max-height 0.3s ease-out;
        }

        .sidebar-submenu.show {
            max-height: 200px; /* Sesuaikan dengan jumlah item */
        }

        .sidebar-submenu .list-group-item {
            padding: 10px 25px;
            font-size: 13px;
            opacity: 0.8;
        }

        .sidebar-submenu .list-group-item:hover {
            opacity: 1;
        }

        .dropdown-arrow {
            transition: transform 0.3s;
        }

        .sidebar-submenu .list-group-item.active-submenu {
            color: white !important;
            opacity: 1;
            font-weight: 700;
            background: rgba(255, 255, 255, 0.05);
            border-left: 3px solid white;
        }

        /* Main Content Styles */
        #page-content-wrapper {
            margin-left: 260px;
            width: calc(100% - 260px);
            min-height: 100vh;
            position: relative;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Toggle & Responsive Styles */
        #menu-toggle {
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: #f8f9fa;
            transition: 0.3s;
            border: none;
            color: #555;
            margin-right: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        #menu-toggle:hover {
            background: #eee;
            color: var(--primary-red);
        }

        /* Desktop State (Always Visible) */
        @media (min-width: 993px) {
            #sidebar-wrapper {
                left: 0;
                width: 260px;
            }

            #page-content-wrapper {
                margin-left: 260px;
                width: calc(100% - 260px);
            }
        }


        /* Mobile Styles (Full hide ONLY on phones) */
        @media (max-width: 768px) {
            #sidebar-wrapper {
                left: -260px;
            }

            #page-content-wrapper {
                margin-left: 0;
                width: 100%;
            }

            #wrapper.toggled #sidebar-wrapper {
                left: 0;
                width: 280px;
                border-radius: 0 30px 30px 0;
                box-shadow: 10px 0 30px rgba(0,0,0,0.2);
            }

            /* Overlay dengan Efek Blur */
            #sidebar-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.2); /* Lebih transparan */
                backdrop-filter: blur(3px); /* Blur lebih halus */
                -webkit-backdrop-filter: blur(3px);
                z-index: 1039; /* Di bawah sidebar (1040) tapi di atas konten */
                display: none;
            }

            #wrapper.toggled #sidebar-overlay {
                display: block;
            }
        }

        .navbar {
            background: white;
            padding: 15px 30px;
            border-bottom: 1px solid #eee;
            position: sticky;
            top: 0;
            z-index: 1030;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.03);
            margin-bottom: 25px;
        }

        .stat-card {
            padding: 20px;
        }

        /* Main Content Styles */
        #page-content-wrapper {
            margin-left: 260px;
            width: calc(100% - 260px);
            min-height: 100vh;
            position: relative;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Toggle & Responsive Styles */
        #menu-toggle {
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: #f8f9fa;
            transition: 0.3s;
            border: none;
            color: #555;
            margin-right: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        #menu-toggle:hover {
            background: #eee;
            color: var(--primary-red);
        }

        /* Desktop Toggle behavior */
        #wrapper.toggled #sidebar-wrapper {
            left: -260px;
        }

        #wrapper.toggled #page-content-wrapper {
            margin-left: 0;
            width: 100%;
        }

        /* Mobile Styles (Phone) */
        @media (max-width: 992px) {
            #sidebar-wrapper {
                left: -260px;
            }

            #page-content-wrapper {
                margin-left: 0;
                width: 100%;
            }

            #wrapper.toggled #sidebar-wrapper {
                left: 0;
            }

            /* Overlay when sidebar is open on mobile */
            #wrapper.toggled::after {
                content: "";
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
            }
        }

        /* Card Variations */
        .stat-card {
            padding: 24px;
            border-radius: 20px;
            border: 1px solid rgba(0, 0, 0, 0.03);
            margin-bottom: 25px;
            display: flex;
            align-items: center;
        }

        .stat-icon {
            width: 65px;
            height: 65px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-right: 20px;
            flex-shrink: 0;
        }

        /* Premium Stat Cards System */
        .stat-card-premium {
            background: #fff;
            border-radius: 20px;
            padding: 1.25rem;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(0,0,0,0.05);
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            height: 100%;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
            cursor: pointer;
        }

        .stat-card-premium:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);
            border-color: rgba(0,0,0,0.01);
        }

        .icon-box-premium {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            position: relative;
            z-index: 2;
        }

        /* Box Colors */
        .box-red { background: rgba(163, 13, 17, 0.1); color: #A30D11; }
        .box-orange { background: rgba(242, 153, 74, 0.1); color: #F2994A; }
        .box-blue { background: rgba(47, 128, 237, 0.1); color: #2F80ED; }
        .box-purple { background: rgba(155, 81, 224, 0.1); color: #9B51E0; }
        .box-green { background: rgba(39, 174, 96, 0.1); color: #27AE60; }
        .box-dark-red { background: rgba(0,0,0,0.05); color: #666; }

        .stat-label-new {
            font-size: 0.8rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-sublabel {
            font-size: 0.7rem;
            margin-top: -3px;
        }

        .stat-value-new {
            font-size: 1.75rem;
            font-weight: 800;
            line-height: 1;
            letter-spacing: -1px;
        }

        .stat-badge {
            font-size: 0.65rem;
            padding: 4px 8px;
            border-radius: 20px;
            font-weight: 700;
        }

        /* Badge Colors */
        .badge-red { background: #A30D11; color: #fff; }
        .badge-orange { background: #F2994A; color: #fff; }
        .badge-blue { background: #2F80ED; color: #fff; }
        .badge-purple { background: #9B51E0; color: #fff; }
        .badge-green { background: #27AE60; color: #fff; }
        .badge-gray { background: #f0f0f0; color: #999; }

        /* Card Glow Effects */
        .card-glow {
            position: absolute;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            top: -50px;
            right: -50px;
            filter: blur(40px);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .stat-card-premium:hover .card-glow {
            opacity: 0.15;
        }

        .red-glow { background: #A30D11; }
        .orange-glow { background: #F2994A; }
        .blue-glow { background: #2F80ED; }
        .purple-glow { background: #9B51E0; }
        .green-glow { background: #27AE60; }
        .gray-glow { background: #999; }

        /* Pagination Premium System */
        .pagination-premium {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
            gap: 8px;
            align-items: center;
        }

        .page-btn {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #fff;
            border: 1px solid rgba(0,0,0,0.05);
            color: #444;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .page-btn:hover:not(.disabled) {
            background: #f8f9fa;
            border-color: #A30D11;
            color: #A30D11;
            transform: translateY(-2px);
        }

        .page-btn.active {
            background: #A30D11;
            color: #fff;
            border-color: #A30D11;
            box-shadow: 0 4px 10px rgba(163, 13, 17, 0.3);
        }

        .page-btn.disabled {
            opacity: 0.5;
            cursor: not-allowed;
            background: #f8f9fa;
        }

        .page-btn-dots {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
            font-weight: bold;
        }

        /* Selected state */
        .card-all {
            background: linear-gradient(145deg, #fff, rgba(163, 13, 17, 0.02));
            border-left: 4px solid #A30D11 !important;
        }

        .admin-profile {
            background: rgba(255, 255, 255, 0.1);
            padding: 15px;
            border-radius: 15px;
            margin: 20px 15px;
            display: flex;
            align-items: center;
            color: white;
        }

        .admin-profile img {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            margin-right: 12px;
        }

        .admin-info span {
            display: block;
            font-size: 14px;
            font-weight: 600;
        }

        .admin-info small {
            font-size: 11px;
            opacity: 0.7;
        }

    </style>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <div class="sidebar-heading px-3 text-center">
                <div class="mb-2 mx-auto" style="width: 160px; height: 100px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                    <img src="<?= $site_logo; ?>" class="img-fluid" style="max-height: 100%; object-fit: contain;" alt="Logo" onerror="this.src='https://ui-avatars.com/api/?name=<?= urlencode($site_name); ?>&background=fff&color=A30D11&size=256'">
                </div>
                <h5 class="m-0 fw-bold text-truncate px-2" title="<?= $site_name; ?>"><?= strtoupper($site_name); ?></h5>
                <div class="mt-1" style="font-size: 11px; opacity: 0.6; letter-spacing: 1.5px;">ADMIN PANEL</div>
            </div>

            <div class="list-group list-group-flush mt-3">
                <!-- Group: MAIN -->
                <div class="sidebar-group-label">MENU UTAMA</div>
                <?php if(in_array('dashboard_view', $user_permissions)) : ?>
                <a href="<?= BASEURL; ?>/admin/dashboard"
                    class="list-group-item list-group-item-action <?= $data['judul'] == 'Dashboard' ? 'active' : ''; ?>">
                    <i class="fas fa-th-large"></i> <span>Dashboard</span>
                </a>
                <?php endif; ?>
                <?php if(in_array('order_manage', $user_permissions)) : ?>
                <a href="<?= BASEURL; ?>/admin/pesanan"
                    class="list-group-item list-group-item-action <?= $data['judul'] == 'Daftar Pesanan' ? 'active' : ''; ?>">
                    <i class="fas fa-shopping-cart"></i> <span>Pesanan</span>
                    <?php if($active_orders > 0): ?>
                    <span class="badge rounded-pill bg-white text-danger ms-auto"><?= $active_orders; ?></span>
                    <?php endif; ?>
                </a>
                <?php endif; ?>

                <!-- Group: OPERATIONS -->
                <div class="sidebar-group-label mt-4">OPERASIONAL</div>
                <?php if(in_array('order_manage', $user_permissions)) : ?>
                <div class="sidebar-dropdown">
                    <a href="javascript:void(0)" class="list-group-item list-group-item-action sidebar-dropdown-btn d-flex align-items-center <?= (in_array($data['judul'], ['Meja Barcode', 'Barcode Umum'])) ? 'active' : ''; ?>" 
                       data-bs-toggle="collapse" data-bs-target="#submenuBarcode" aria-expanded="<?= (in_array($data['judul'], ['Meja Barcode', 'Barcode Umum'])) ? 'true' : 'false'; ?>">
                        <i class="fas fa-qrcode"></i> <span>Manajemen Barcode</span>
                        <i class="fas fa-chevron-down ms-auto small dropdown-arrow"></i>
                    </a>
                    <div class="collapse sidebar-submenu <?= (in_array($data['judul'], ['Meja Barcode', 'Barcode Umum'])) ? 'show' : ''; ?>" id="submenuBarcode">
                        <a href="<?= BASEURL; ?>/admin/meja" class="list-group-item list-group-item-action <?= $data['judul'] == 'Meja Barcode' ? 'active-submenu' : ''; ?>">
                            <i class="fas fa-table"></i> <span>Meja Barcode</span>
                            <span class="badge rounded-pill bg-white text-danger ms-auto"><?= $total_meja; ?></span>
                        </a>
                        <a href="<?= BASEURL; ?>/admin/barcode_umum" class="list-group-item list-group-item-action <?= $data['judul'] == 'Barcode Umum' ? 'active-submenu' : ''; ?>">
                            <i class="fas fa-qrcode"></i> <span>Barcode Umum</span>
                        </a>
                    </div>
                </div>
                <?php endif; ?>
                <?php if(in_array('payment_manage', $user_permissions)) : ?>
                <a href="<?= BASEURL; ?>/admin/pembayaran"
                    class="list-group-item list-group-item-action <?= $data['judul'] == 'Daftar Pembayaran' ? 'active' : ''; ?>">
                    <i class="fas fa-wallet"></i> <span>Pembayaran</span>
                    <?php if($pending_payments > 0): ?>
                    <span class="badge rounded-pill bg-white text-danger ms-auto"><?= $pending_payments; ?></span>
                    <?php endif; ?>
                </a>
                <?php endif; ?>
                <?php if(in_array('menu_manage', $user_permissions)) : ?>
                <a href="<?= BASEURL; ?>/admin/menu"
                    class="list-group-item list-group-item-action <?= $data['judul'] == 'Daftar Menu' ? 'active' : ''; ?>">
                    <i class="fas fa-utensils"></i> <span>Menu</span>
                    <span class="badge rounded-pill bg-white text-danger ms-auto"><?= $total_menu; ?></span>
                </a>
                <a href="<?= BASEURL; ?>/admin/kategori"
                    class="list-group-item list-group-item-action <?= $data['judul'] == 'Kategori Produk' ? 'active' : ''; ?>">
                    <i class="fas fa-tags"></i> <span>Kategori</span>
                </a>
                <?php endif; ?>

                <!-- Group: ANALYTICS -->
                <div class="sidebar-group-label mt-4">ANALITIK</div>
                <?php if(in_array('report_view', $user_permissions)) : ?>
                <a href="<?= BASEURL; ?>/admin/laporan"
                    class="list-group-item list-group-item-action <?= $data['judul'] == 'Laporan Penjualan' ? 'active' : ''; ?>">
                    <i class="fas fa-file-alt"></i> <span>Laporan</span>
                </a>
                <?php endif; ?>

                <!-- Group: SYSTEM -->
                <div class="sidebar-group-label mt-4">SISTEM</div>
                <?php if(in_array('settings_manage', $user_permissions)) : ?>
                <a href="<?= BASEURL; ?>/admin/pengaturan"
                    class="list-group-item list-group-item-action <?= $data['judul'] == 'Pengaturan Toko' ? 'active' : ''; ?>">
                    <i class="fas fa-cog"></i> <span>Pengaturan</span>
                </a>
                <?php endif; ?>
                <?php if(in_array('user_manage', $user_permissions)) : ?>
                <div class="sidebar-dropdown">
                    <a href="javascript:void(0)" class="list-group-item list-group-item-action sidebar-dropdown-btn d-flex align-items-center <?= (in_array($data['judul'], ['Manajemen Admin', 'Role Akses'])) ? 'active' : ''; ?>" 
                       data-bs-toggle="collapse" data-bs-target="#submenuManajemen" aria-expanded="<?= (in_array($data['judul'], ['Manajemen Admin', 'Role Akses'])) ? 'true' : 'false'; ?>">
                        <i class="fas fa-user-shield"></i> <span>Manajemen</span>
                        <i class="fas fa-chevron-down ms-auto small dropdown-arrow"></i>
                    </a>
                    <div class="collapse sidebar-submenu <?= (in_array($data['judul'], ['Manajemen Admin', 'Role Akses'])) ? 'show' : ''; ?>" id="submenuManajemen">
                        <a href="<?= BASEURL; ?>/admin/user" class="list-group-item list-group-item-action <?= $data['judul'] == 'Manajemen Admin' ? 'active-submenu' : ''; ?>">
                            <i class="fas fa-users-cog"></i> <span>Pengguna</span>
                            <span class="badge rounded-pill bg-white text-danger ms-auto"><?= $total_users; ?></span>
                        </a>
                        <a href="<?= BASEURL; ?>/admin/role" class="list-group-item list-group-item-action <?= $data['judul'] == 'Role Akses' ? 'active-submenu' : ''; ?>">
                            <i class="fas fa-user-lock"></i> <span>Role Akses</span>
                        </a>
                    </div>
                </div>
                <?php endif; ?>
                <div class="mt-4 mb-3 border-top border-white border-opacity-10 mx-4"></div>
                <a href="javascript:void(0)" onclick="confirmLogout()" class="list-group-item list-group-item-action mb-4">
                    <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
                </a>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                function confirmLogout() {
                    Swal.fire({
                        title: 'Logout?',
                        text: "Apakah Anda yakin ingin keluar dari sistem?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#A30D11',
                        cancelButtonColor: '#6e7881',
                        confirmButtonText: 'Ya, Logout!',
                        cancelButtonText: 'Batal',
                        borderRadius: '15px'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "<?= BASEURL; ?>/admin/logout";
                        }
                    })
                }
            </script>

            <div class="admin-profile mt-auto">
                <img src="https://ui-avatars.com/api/?name=<?= urlencode($_SESSION['user_nama']); ?>&background=random&color=fff" alt="Admin">
                <div class="admin-info">
                    <span class="text-truncate" style="max-width: 130px;"><?= $_SESSION['user_nama']; ?></span>
                    <div class="d-flex align-items-center">
                        <small class="badge bg-white bg-opacity-25 border-0 me-2"><?= $_SESSION['user_role']; ?></small>
                        <div style="width: 8px; height: 8px; background: #52C41A; border-radius: 50%; margin-right: 5px;"></div>
                        <small style="color: #52C41A; font-weight: bold;">Online</small>
                    </div>
                </div>
            </div>
        </div>
        <div id="sidebar-overlay"></div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <!-- Header Dinamis -->
            <nav class="navbar navbar-expand-lg navbar-light py-3 px-4 bg-white border-bottom shadow-sm sticky-top">
                <div class="container-fluid p-0">
                    <div class="d-flex align-items-center">
                        <button class="btn btn-light d-lg-none me-3" id="menu-toggle">
                            <i class="fas fa-bars"></i>
                        </button>
                        <div>
                            <h4 class="fw-bold mb-0 text-dark">
                                <?= str_replace(['Daftar ', ' Produk', ' Penjualan', ' Toko', ' Manajemen '], '', $data['judul']); ?>
                            </h4>
                            <p class="text-muted small mb-0 d-none d-md-block">
                                <?php 
                                    switch($data['judul']) {
                                        case 'Dashboard': echo 'Selamat datang kembali, Admin!'; break;
                                        case 'Daftar Pesanan': echo 'Kelola semua pesanan pelanggan'; break;
                                        case 'Daftar Menu': echo 'Kelola semua menu hidangan'; break;
                                        case 'Kategori Produk': echo 'Kelola kategori produk makanan'; break;
                                        case 'Laporan Penjualan': echo 'Pantau performa penjualan Anda'; break;
                                        case 'Pengaturan Toko': echo 'Konfigurasi pengaturan sistem'; break;
                                        case 'Manajemen Admin': echo 'Kelola akun petugas admin'; break;
                                        default: echo 'Kelola data sistem Anda';
                                    }
                                ?>
                            </p>
                        </div>
                    </div>

                    <div class="ms-auto d-flex align-items-center">
                        <!-- Digital Clock & Date -->
                        <div class="d-none d-md-flex align-items-center bg-light px-3 py-2 rounded-4 me-3 border border-opacity-10 shadow-sm">
                            <div class="d-flex align-items-center me-3 pe-3 border-end">
                                <i class="far fa-clock me-2 text-danger"></i>
                                <span id="digitalClock" class="fw-800 text-dark" style="font-size: 13px; min-width: 60px;">00:00:00</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="far fa-calendar me-2 text-muted small"></i>
                                <span class="fw-bold text-muted" style="font-size: 11px;"><?= date('d M Y'); ?></span>
                            </div>
                        </div>

                        <!-- Notification Bell -->
                        <div class="dropdown">
                            <div class="position-relative bg-white p-2 rounded-4 border shadow-sm" style="cursor: pointer; width: 42px; height: 42px; display: flex; align-items: center; justify-content: center;" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="far fa-bell text-dark"></i>
                                <?php if($active_orders > 0): ?>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-white" style="font-size: 8px; padding: 4px 6px;">
                                    <?= $active_orders; ?>
                                    <span class="visually-hidden">unread orders</span>
                                </span>
                                <?php endif; ?>
                            </div>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 p-2 mt-2" style="width: 300px;">
                                <div class="px-3 py-2 border-bottom mb-2 d-flex justify-content-between align-items-center">
                                    <h6 class="fw-bold mb-0 small">Notifikasi Pesanan</h6>
                                    <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill" style="font-size: 10px;"><?= $active_orders; ?> Aktif</span>
                                </div>
                                <?php if($active_orders > 0): ?>
                                    <div class="notification-list" style="max-height: 250px; overflow-y: auto;">
                                        <a href="<?= BASEURL; ?>/admin/pesanan?status=pending" class="dropdown-item p-3 rounded-3 mb-1 bg-light">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-warning bg-opacity-10 p-2 rounded-3 me-3">
                                                    <i class="fas fa-shopping-basket text-warning"></i>
                                                </div>
                                                <div>
                                                    <p class="mb-0 small fw-bold">Ada <?= $active_orders; ?> Pesanan Aktif</p>
                                                    <small class="text-muted">Segera proses pesanan pelanggan!</small>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="p-2 border-top mt-2">
                                        <a href="<?= BASEURL; ?>/admin/pesanan" class="btn btn-light btn-sm w-100 fw-bold rounded-pill" style="font-size: 11px;">Lihat Semua Pesanan</a>
                                    </div>
                                <?php else: ?>
                                    <div class="text-center py-4">
                                        <i class="fas fa-check-circle text-success fs-3 mb-2 opacity-25"></i>
                                        <p class="small text-muted mb-0">Semua pesanan sudah beres!</p>
                                    </div>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="container-fluid p-4">
                <!-- Konten akan muncul di sini -->

                <script>
                    const menuToggle = document.getElementById("menu-toggle");
                    const wrapper = document.getElementById("wrapper");
                    const overlay = document.getElementById("sidebar-overlay");

                    menuToggle.addEventListener("click", function (e) {
                        e.preventDefault();
                        wrapper.classList.toggle("toggled");
                    });

                    overlay.addEventListener("click", function () {
                        wrapper.classList.remove("toggled");
                    });

                    // Digital Clock Script
                    function updateClock() {
                        const now = new Date();
                        const hours = String(now.getHours()).padStart(2, '0');
                        const minutes = String(now.getMinutes()).padStart(2, '0');
                        const seconds = String(now.getSeconds()).padStart(2, '0');
                        
                        const clockElement = document.getElementById('digitalClock');
                        if(clockElement) {
                            clockElement.textContent = `${hours}:${minutes}:${seconds}`;
                        }
                    }

                    setInterval(updateClock, 1000);
                    updateClock(); // Initial call
                </script>