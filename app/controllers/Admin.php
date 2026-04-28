<?php

class Admin extends Controller
{
    public function __construct()
    {
        // Cek session untuk semua method KECUALI login dan proses_login
        $url = $this->parseURL();
        $method = isset($url[1]) ? $url[1] : 'index';

        if ($method !== 'login' && $method !== 'proses_login') {
            if (!isset($_SESSION['admin_login'])) {
                header('Location: ' . BASEURL . '/admin/login');
                exit;
            }

            // Real-time Role Access Check (Owner always bypass)
            if ($_SESSION['user_role'] !== 'Owner') {
                $permissions = $this->model('Role_model')->getPermissionsByRoleName($_SESSION['user_role']);

                // Mapping method ke permission name
                $mapping = [
                    'dashboard' => 'dashboard_view',
                    'index' => 'dashboard_view',
                    'menu' => 'menu_manage',
                    'tambah_menu' => 'menu_manage',
                    'edit_menu' => 'menu_manage',
                    'kategori' => 'menu_manage',
                    'pesanan' => 'order_manage',
                    'detail_pesanan' => 'order_manage',
                    'pembayaran' => 'payment_manage',
                    'verifikasi_pembayaran' => 'payment_manage',
                    'barcode_umum' => 'order_manage',
                    'laporan' => 'report_view',
                    'pengaturan' => 'settings_manage',
                    'proses_update_pengaturan' => 'settings_manage',
                    'user' => 'user_manage',
                    'role' => 'user_manage',
                    'tambah_user' => 'user_manage',
                    'edit_user' => 'user_manage',
                    'tambah_role' => 'user_manage',
                    'edit_role' => 'user_manage'
                ];

                if (isset($mapping[$method])) {
                    if (!in_array($mapping[$method], $permissions)) {
                        // Tampilkan halaman akses ditolak yang keren
                        $data['judul'] = 'Akses Ditolak';
                        $this->view('admin/templates/header', $data);
                        $this->view('admin/forbidden', $data);
                        $this->view('admin/templates/footer', $data);
                        exit;
                    }
                }
            }
        }
    }

    private function parseURL()
    {
        $url = [];
        if (isset($_GET['url'])) {
            $url = trim($_GET['url'], '/');
        } else {
            // Fallback ke REQUEST_URI jika .htaccess tidak mem-passing parameter 'url'
            $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            
            // Cari base path (folder project)
            $script_name = dirname($_SERVER['SCRIPT_NAME']);
            $script_name = str_replace('\\', '/', $script_name);
            $script_name = rtrim($script_name, '/');
            
            if ($script_name !== '' && strpos($uri, $script_name) === 0) {
                $uri = substr($uri, strlen($script_name));
            }
            
            $url = trim($uri, '/');
        }

        if (!empty($url)) {
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            $url = array_filter($url);
            return array_values($url);
        }
        
        return [];
    }

    public function login()
    {
        if (isset($_SESSION['admin_login'])) {
            header('Location: ' . BASEURL . '/admin/dashboard');
            exit;
        }
        $data['judul'] = 'Login Admin';
        $data['pengaturan'] = $this->model('Pengaturan_model')->getAll();
        $this->view('admin/login', $data);
    }

    public function proses_login()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $this->model('User_model')->getUserByUsername($username);

        if ($user) {
            // Verifikasi password yang sudah di-hash
            if (password_verify($password, $user['password'])) {
                // Simpan detail user ke session
                $_SESSION['admin_login'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_nama'] = $user['nama'];
                $_SESSION['user_username'] = $user['username'];
                $_SESSION['user_role'] = $user['role'];

                $this->model('Log_model')->addLog('Telah masuk ke sistem (Login)');

                header('Location: ' . BASEURL . '/admin/dashboard');
                exit;
            } else {
                header('Location: ' . BASEURL . '/admin/login?error=wrong_pass');
                exit;
            }
        } else {
            header('Location: ' . BASEURL . '/admin/login?error=not_found');
            exit;
        }
    }

    public function logout()
    {
        unset($_SESSION['admin_login']);
        session_destroy();
        header('Location: ' . BASEURL . '/admin/login');
        exit;
    }

    public function index()
    {
        $this->dashboard();
    }

    public function dashboard()
    {
        $data['judul'] = 'Dashboard';
        $model = $this->model('Pesanan_model');

        // Stats Utama
        $data['stats'] = [
            'revenue' => $model->getTotalRevenue(),
            'orders' => $model->getTotalCount(),
            'menu_sold' => $model->getMenuSold(),
            'pending' => $model->getCountByStatus('pending'),
            'diproses' => $model->getCountByStatus('diproses'),
            'selesai' => $model->getCountByStatus('selesai'),
            'dibatalkan' => $model->getCountByStatus('dibatalkan')
        ];

        // Pesanan Terbaru (5)
        $data['recent_orders'] = $model->getRecentOrders(5);

        // Data Grafik Pendapatan (7 hari terakhir)
        $data['revenue_chart'] = $model->getRevenueLast7Days();

        // ANALITIK BARU
        $data['best_selling'] = $model->getBestSellingMenu(5);
        $data['status_stats'] = $model->getOrderStatusStats();
        $data['category_revenue'] = $model->getRevenueByCategory();

        $this->view('admin/templates/header', $data);
        $this->view('admin/dashboard/index', $data);
        $this->view('admin/templates/footer', $data);
    }

    public function menu()
    {
        $data['judul'] = 'Daftar Menu';

        // Filter
        $filters = [
            'search' => isset($_GET['search']) ? $_GET['search'] : '',
            'kategori' => isset($_GET['kategori']) ? $_GET['kategori'] : '',
            'status' => isset($_GET['status']) ? $_GET['status'] : '',
            'sort' => isset($_GET['sort']) ? $_GET['sort'] : 'terbaru'
        ];

        $produkModel = $this->model('Produk_model');
        $data['produk'] = $produkModel->getFilterProduk($filters);
        $data['kategori'] = $this->model('Kategori_model')->getAllKategori();

        // Stats
        $data['stats'] = [
            'total' => $produkModel->getTotalCount(),
            'aktif' => $produkModel->getCountByStatus('aktif'),
            'nonaktif' => $produkModel->getCountByStatus('nonaktif'),
            'total_kategori' => count($data['kategori'])
        ];

        $this->view('admin/templates/header', $data);
        $this->view('admin/menu/index', $data);
        $this->view('admin/templates/footer', $data);
    }

    public function kategori()
    {
        $data['judul'] = 'Kategori Produk';

        // Filter
        $filters = [
            'search' => isset($_GET['search']) ? $_GET['search'] : '',
            'status' => isset($_GET['status']) ? $_GET['status'] : ''
        ];

        $model = $this->model('Kategori_model');
        $data['kategori'] = $model->getAllKategoriWithCount($filters);

        // Stats
        $data['stats'] = [
            'total' => $model->getTotalCount(),
            'aktif' => $model->getCountByStatus('aktif'),
            'nonaktif' => $model->getCountByStatus('nonaktif')
        ];

        $this->view('admin/templates/header', $data);
        $this->view('admin/kategori/index', $data);
        $this->view('admin/templates/footer', $data);
    }

    public function pesanan()
    {
        $data['judul'] = 'Daftar Pesanan';

        // Ambil filter dari GET
        $filters = [
            'search' => isset($_GET['search']) ? $_GET['search'] : '',
            'status' => isset($_GET['status']) ? $_GET['status'] : '',
            'tipe' => isset($_GET['tipe']) ? $_GET['tipe'] : '',
            'bayar' => isset($_GET['bayar']) ? $_GET['bayar'] : '',
            'range_date' => isset($_GET['range_date']) ? $_GET['range_date'] : '',
            'sort' => isset($_GET['sort']) ? $_GET['sort'] : 'created_at',
            'order' => isset($_GET['order']) ? $_GET['order'] : 'desc'
        ];

        // Pagination
        $limit = 10;
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        // Ambil data dari Model
        $model = $this->model('Pesanan_model');
        $data['pesanan'] = $model->getFilterPesanan($filters, $limit, $offset);
        $totalRecords = $model->getCountFilterPesanan($filters);

        $data['pagination'] = [
            'total_records' => $totalRecords,
            'total_pages' => ceil($totalRecords / $limit),
            'current_page' => $page,
            'limit' => $limit
        ];

        // Statistik untuk Stat Cards
        $data['stats'] = [
            'total' => $model->getTotalCount(),
            'pending' => $model->getCountByStatus('pending'),
            'proses' => $model->getCountByStatus('diproses'),
            'selesai' => $model->getCountByStatus('selesai'),
            'batal' => $model->getCountByStatus('dibatalkan')
        ];

        $this->view('admin/templates/header', $data);
        $this->view('admin/pesanan/index', $data);
        $this->view('admin/templates/footer', $data);
    }

    public function laporan()
    {
        $data['judul'] = 'Laporan Penjualan';

        $filters = [
            'range_date' => isset($_GET['range_date']) ? $_GET['range_date'] : date('Y-m-01') . ' to ' . date('Y-m-t'),
            'status' => isset($_GET['status']) ? $_GET['status'] : '',
            'bayar' => isset($_GET['bayar']) ? $_GET['bayar'] : ''
        ];

        $report = $this->model('Pesanan_model')->getReportData($filters);
        $data['laporan'] = $report['list'];
        $data['stats'] = [
            'revenue' => $report['total_revenue'],
            'orders' => $report['total_orders']
        ];
        $data['kategori'] = $this->model('Kategori_model')->getAllKategori();
        $data['metode_pembayaran'] = $this->model('Pembayaran_model')->getAllMetode();

        $this->view('admin/templates/header', $data);
        $this->view('admin/laporan/index', $data);
        $this->view('admin/templates/footer', $data);
    }

    public function cetak_laporan()
    {
        $data['judul'] = 'Cetak Laporan Penjualan';

        $filters = [
            'range_date' => isset($_GET['range_date']) ? $_GET['range_date'] : date('Y-m-01') . ' to ' . date('Y-m-t'),
            'status' => isset($_GET['status']) ? $_GET['status'] : '',
            'bayar' => isset($_GET['bayar']) ? $_GET['bayar'] : ''
        ];

        $report = $this->model('Pesanan_model')->getReportData($filters);
        $data['laporan'] = $report['list'];
        $data['stats'] = [
            'revenue' => $report['total_revenue'],
            'orders' => $report['total_orders']
        ];
        $data['filters'] = $filters;
        $data['pengaturan'] = $this->model('Pengaturan_model')->getAll();

        $this->view('admin/laporan/cetak', $data);
    }

    public function pengaturan()
    {
        $data['judul'] = 'Pengaturan Toko';
        $data['pengaturan'] = $this->model('Pengaturan_model')->getAll();
        $data['metode_pembayaran'] = $this->model('Pembayaran_model')->getAllMetode();
        $data['banners'] = $this->model('Banner_model')->getAllBanner();

        $this->view('admin/templates/header', $data);
        $this->view('admin/pengaturan/index', $data);
        $this->view('admin/templates/footer', $data);
    }

    public function tambah_banner()
    {
        $data = $_POST;
        $data['gambar'] = '';

        if (!empty($_FILES['gambar_banner']['name'])) {
            $namaFile = $_FILES['gambar_banner']['name'];
            $tmpName = $_FILES['gambar_banner']['tmp_name'];
            $ekstensiGambar = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));

            if (in_array($ekstensiGambar, ['jpg', 'jpeg', 'png', 'webp'])) {
                $namaFileBaru = 'banner_' . uniqid() . '.' . $ekstensiGambar;
                if (!file_exists('assets/img/banner')) {
                    mkdir('assets/img/banner', 0777, true);
                }
                move_uploaded_file($tmpName, 'assets/img/banner/' . $namaFileBaru);
                $data['gambar'] = $namaFileBaru;
            }
        }

        if ($this->model('Banner_model')->tambahBanner($data) > 0) {
            header('Location: ' . BASEURL . '/admin/pengaturan?msg=success#tampilan');
            exit;
        }
    }

    public function hapus_banner($id)
    {
        $banner = $this->model('Banner_model')->getBannerById($id);
        if ($banner && !empty($banner['gambar']) && file_exists('assets/img/banner/' . $banner['gambar'])) {
            unlink('assets/img/banner/' . $banner['gambar']);
        }

        if ($this->model('Banner_model')->hapusBanner($id) > 0) {
            header('Location: ' . BASEURL . '/admin/pengaturan?msg=success#tampilan');
            exit;
        }
    }

    public function toggle_banner_ajax($id)
    {
        if ($this->model('Banner_model')->toggleActive($id) > 0) {
            $banner = $this->model('Banner_model')->getBannerById($id);
            echo json_encode(['status' => 'success', 'is_active' => $banner['is_active']]);
        } else {
            echo json_encode(['status' => 'error']);
        }
        exit;
    }

    public function tambah_metode_pembayaran()
    {
        $data = $_POST;
        $data['logo_qr'] = '';

        if (!empty($_FILES['logo_qr']['name'])) {
            $namaFile = $_FILES['logo_qr']['name'];
            $tmpName = $_FILES['logo_qr']['tmp_name'];
            $ekstensiGambar = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));

            if (in_array($ekstensiGambar, ['jpg', 'jpeg', 'png'])) {
                $namaFileBaru = 'qr_' . uniqid() . '.' . $ekstensiGambar;
                if (!file_exists('assets/img/pembayaran')) {
                    mkdir('assets/img/pembayaran', 0777, true);
                }
                move_uploaded_file($tmpName, 'assets/img/pembayaran/' . $namaFileBaru);
                $data['logo_qr'] = $namaFileBaru;
            }
        }

        if ($this->model('Pembayaran_model')->tambahMetode($data) > 0) {
            header('Location: ' . BASEURL . '/admin/pengaturan?msg=success#pembayaran');
            exit;
        }
    }

    public function hapus_metode_pembayaran($id)
    {
        if ($this->model('Pembayaran_model')->deleteMetode($id) > 0) {
            header('Location: ' . BASEURL . '/admin/pengaturan?msg=success#pembayaran');
            exit;
        }
    }

    public function toggle_metode_ajax($id)
    {
        if ($this->model('Pembayaran_model')->toggleActive($id) > 0) {
            $metode = $this->model('Pembayaran_model')->getMetodeById($id);
            echo json_encode(['status' => 'success', 'is_active' => $metode['is_active']]);
        } else {
            echo json_encode(['status' => 'error']);
        }
        exit;
    }

    public function toggle_metode_pembayaran($id)
    {
        if ($this->model('Pembayaran_model')->toggleActive($id) > 0) {
            header('Location: ' . BASEURL . '/admin/pengaturan?msg=success#pembayaran');
            exit;
        }
    }

    public function edit_metode_pembayaran()
    {
        $data = $_POST;

        // Handle QRIS Image Update
        if (!empty($_FILES['logo_qr']['name'])) {
            $namaFile = $_FILES['logo_qr']['name'];
            $tmpName = $_FILES['logo_qr']['tmp_name'];
            $ekstensiGambar = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));

            if (in_array($ekstensiGambar, ['jpg', 'jpeg', 'png'])) {
                $namaFileBaru = 'qr_' . uniqid() . '.' . $ekstensiGambar;
                if (!file_exists('public/assets/img/pembayaran')) {
                    mkdir('public/assets/img/pembayaran', 0777, true);
                }
                move_uploaded_file($tmpName, 'public/assets/img/pembayaran/' . $namaFileBaru);
                $data['logo_qr'] = $namaFileBaru;

                // Hapus file lama jika ada
                $old = $this->model('Pembayaran_model')->getMetodeById($data['id']);
                if (!empty($old['logo_qr']) && file_exists('assets/img/pembayaran/' . $old['logo_qr'])) {
                    unlink('assets/img/pembayaran/' . $old['logo_qr']);
                }
            }
        } else {
            // Keep old logo
            $old = $this->model('Pembayaran_model')->getMetodeById($data['id']);
            $data['logo_qr'] = $old['logo_qr'];
        }

        if ($this->model('Pembayaran_model')->updateMetode($data) >= 0) {
            header('Location: ' . BASEURL . '/admin/pengaturan?msg=success#pembayaran');
            exit;
        }
    }

    public function proses_update_pengaturan()
    {
        $data = $_POST;

        // Handle Logo Upload
        if (!empty($_FILES['logo_toko']['name'])) {
            $namaFile = $_FILES['logo_toko']['name'];
            $ukuranFile = $_FILES['logo_toko']['size'];
            $error = $_FILES['logo_toko']['error'];
            $tmpName = $_FILES['logo_toko']['tmp_name'];

            // Cek ekstensi
            $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
            $ekstensiGambar = explode('.', $namaFile);
            $ekstensiGambar = strtolower(end($ekstensiGambar));

            if (in_array($ekstensiGambar, $ekstensiGambarValid)) {
                if ($ukuranFile < 2000000) {
                    $namaFileBaru = uniqid();
                    $namaFileBaru .= '.' . $ekstensiGambar;

                    move_uploaded_file($tmpName, 'assets/img/logo/' . $namaFileBaru);
                    $data['logo'] = $namaFileBaru;

                    // Hapus logo lama jika ada
                    $old = $this->model('Pengaturan_model')->getAll();
                    if (!empty($old['logo']) && file_exists('assets/img/logo/' . $old['logo'])) {
                        unlink('assets/img/logo/' . $old['logo']);
                    }
                }
            }
        }

        // Handle QRIS Image Upload
        if (!empty($_FILES['qris_image_file']['name'])) {
            $namaFile = $_FILES['qris_image_file']['name'];
            $tmpName = $_FILES['qris_image_file']['tmp_name'];
            $ekstensiGambar = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));

            if (in_array($ekstensiGambar, ['jpg', 'jpeg', 'png'])) {
                $namaFileBaru = 'qris_' . uniqid() . '.' . $ekstensiGambar;
                if (!file_exists('assets/img/pembayaran')) {
                    mkdir('assets/img/pembayaran', 0777, true);
                }
                move_uploaded_file($tmpName, 'assets/img/pembayaran/' . $namaFileBaru);
                $data['qris_image'] = $namaFileBaru;
            }
        }
        // Handle Banner Hero Upload
        if (!empty($_FILES['banner_hero']['name'])) {
            $namaFile = $_FILES['banner_hero']['name'];
            $tmpName = $_FILES['banner_hero']['tmp_name'];
            $ekstensiGambar = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));

            if (in_array($ekstensiGambar, ['jpg', 'jpeg', 'png', 'webp'])) {
                $namaFileBaru = 'banner_' . uniqid() . '.' . $ekstensiGambar;
                if (!file_exists('assets/img/banner')) {
                    mkdir('assets/img/banner', 0777, true);
                }
                move_uploaded_file($tmpName, 'assets/img/banner/' . $namaFileBaru);
                $data['banner_hero'] = $namaFileBaru;

                // Hapus banner lama jika ada
                $old = $this->model('Pengaturan_model')->getAll();
                if (!empty($old['banner_hero']) && file_exists('assets/img/banner/' . $old['banner_hero'])) {
                    unlink('assets/img/banner/' . $old['banner_hero']);
                }
            }
        }

        // Handle Password Update (if filled)
        if (!empty($_POST['new_password'])) {
            if ($_POST['new_password'] === $_POST['confirm_password']) {
                $password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
                $this->model('User_model')->updatePassword($_SESSION['user_id'], $password);
            }
        }

        // Clean data from non-setting keys before multiple update
        $exclude = ['new_password', 'confirm_password', 'logo_toko', 'qris_image_file', 'banner_hero'];
        foreach ($exclude as $key) {
            unset($data[$key]);
        }

        if ($this->model('Pengaturan_model')->updateMultiple($data)) {
            $this->model('Log_model')->addLog('Memperbarui pengaturan sistem/profil');
            header('Location: ' . BASEURL . '/admin/pengaturan?msg=success');
            exit;
        } else {
            header('Location: ' . BASEURL . '/admin/pengaturan?msg=error');
            exit;
        }
    }

    public function user()
    {
        $data['judul'] = 'Manajemen Admin';
        $data['users'] = $this->model('User_model')->getAllUser();
        $this->view('admin/templates/header', $data);
        $this->view('admin/user/index', $data);
        $this->view('admin/templates/footer', $data);
    }

    public function role()
    {
        $data['judul'] = 'Role Akses';
        $data['roles'] = $this->model('Role_model')->getAllRoles();

        $this->view('admin/templates/header', $data);
        $this->view('admin/user/role', $data);
        $this->view('admin/templates/footer', $data);
    }

    public function tambah_role()
    {
        $data['judul'] = 'Tambah Role Akses';
        $data['permissions'] = $this->model('Role_model')->getAllPermissions();

        $this->view('admin/templates/header', $data);
        $this->view('admin/user/tambah_role', $data);
        $this->view('admin/templates/footer', $data);
    }

    public function proses_tambah_role()
    {
        if ($this->model('Role_model')->tambahDataRole($_POST) > 0) {
            header('Location: ' . BASEURL . '/admin/role?msg=success');
            exit;
        } else {
            header('Location: ' . BASEURL . '/admin/role?msg=error');
            exit;
        }
    }

    public function edit_role($id)
    {
        $data['judul'] = 'Edit Role Akses';
        $data['role'] = $this->model('Role_model')->getRoleById($id);
        $data['permissions'] = $this->model('Role_model')->getAllPermissions();
        $data['role_permissions'] = $this->model('Role_model')->getPermissionsByRoleId($id);

        $this->view('admin/templates/header', $data);
        $this->view('admin/user/edit_role', $data);
        $this->view('admin/templates/footer', $data);
    }

    public function proses_edit_role()
    {
        if ($this->model('Role_model')->ubahDataRole($_POST) >= 0) {
            header('Location: ' . BASEURL . '/admin/role?msg=success');
            exit;
        } else {
            header('Location: ' . BASEURL . '/admin/role?msg=error');
            exit;
        }
    }

    public function hapus_role($id)
    {
        if ($this->model('Role_model')->hapusDataRole($id) > 0) {
            header('Location: ' . BASEURL . '/admin/role?msg=success');
            exit;
        } else {
            header('Location: ' . BASEURL . '/admin/role?msg=error');
            exit;
        }
    }

    public function tambah_user()
    {
        $data['judul'] = 'Tambah Admin Baru';
        $data['roles'] = $this->model('Role_model')->getAllRoles();

        $this->view('admin/templates/header', $data);
        $this->view('admin/user/tambah', $data);
        $this->view('admin/templates/footer', $data);
    }

    public function proses_tambah_user()
    {
        if ($this->model('User_model')->tambahDataUser($_POST) > 0) {
            header('Location: ' . BASEURL . '/admin/user?msg=success');
            exit;
        } else {
            header('Location: ' . BASEURL . '/admin/user?msg=error');
            exit;
        }
    }

    public function edit_user($id)
    {
        $data['judul'] = 'Edit Data Admin';
        $data['user'] = $this->model('User_model')->getUserById($id);
        $data['roles'] = $this->model('Role_model')->getAllRoles();

        $this->view('admin/templates/header', $data);
        $this->view('admin/user/edit', $data);
        $this->view('admin/templates/footer', $data);
    }

    public function proses_edit_user()
    {
        if ($this->model('User_model')->ubahDataUser($_POST) >= 0) {
            header('Location: ' . BASEURL . '/admin/user?msg=success');
            exit;
        } else {
            header('Location: ' . BASEURL . '/admin/user?msg=error');
            exit;
        }
    }

    public function hapus_user($id)
    {
        if ($this->model('User_model')->hapusDataUser($id) > 0) {
            header('Location: ' . BASEURL . '/admin/user?msg=success');
            exit;
        } else {
            header('Location: ' . BASEURL . '/admin/user?msg=error');
            exit;
        }
    }

    public function tambah_menu()
    {
        $data['judul'] = 'Tambah Menu Baru';
        $data['kategori'] = $this->model('Kategori_model')->getAllKategori();

        $this->view('admin/templates/header', $data);
        $this->view('admin/menu/tambah', $data);
        $this->view('admin/templates/footer', $data);
    }

    public function proses_tambah_menu()
    {
        // Upload Foto
        $foto = '';
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $namaFile = $_FILES['foto']['name'];
            $tmpName = $_FILES['foto']['tmp_name'];
            $ekstensi = pathinfo($namaFile, PATHINFO_EXTENSION);
            $namaFileBaru = uniqid() . '.' . $ekstensi;

            if (move_uploaded_file($tmpName, 'assets/img/produk/' . $namaFileBaru)) {
                $foto = $namaFileBaru;
            }
        }

        $data = [
            'kategori_id' => $_POST['kategori_id'],
            'nama' => $_POST['nama'],
            'deskripsi' => $_POST['deskripsi'],
            'harga' => $_POST['harga'],
            'harga_coret' => !empty($_POST['harga_coret']) ? $_POST['harga_coret'] : null,
            'foto' => $foto,
            'stok' => $_POST['stok'],
            'satuan' => $_POST['satuan'],
            'status' => isset($_POST['status']) ? 'aktif' : 'nonaktif',
            'label_badge' => $_POST['label_badge'],
            'catatan_tambahan' => $_POST['catatan_tambahan']
        ];

        if ($this->model('Produk_model')->tambahDataProduk($data) > 0) {
            $this->model('Log_model')->addLog('Menambah menu baru: ' . $data['nama']);
            header('Location: ' . BASEURL . '/admin/menu?msg=success');
            exit;
        } else {
            header('Location: ' . BASEURL . '/admin/menu?msg=error');
            exit;
        }
    }

    public function hapus_menu($id)
    {
        $produk = $this->model('Produk_model')->getProdukById($id);
        $result = $this->model('Produk_model')->hapusDataProduk($id);

        if ($result > 0) {
            // Hapus foto fisik jika database berhasil dihapus
            if (!empty($produk['foto'])) {
                if (file_exists('img/' . $produk['foto'])) {
                    unlink('img/' . $produk['foto']);
                }
                if (file_exists('assets/img/produk/' . $produk['foto'])) {
                    unlink('assets/img/produk/' . $produk['foto']);
                }
            }

            $this->model('Log_model')->addLog('Menghapus menu ID: ' . $id);
            header('Location: ' . BASEURL . '/admin/menu?msg=success');
            exit;
        } else {
            header('Location: ' . BASEURL . '/admin/menu?msg=error');
            exit;
        }
    }

    public function edit_menu($id)
    {
        $data['judul'] = 'Edit Menu';
        $data['produk'] = $this->model('Produk_model')->getProdukById($id);
        $data['kategori'] = $this->model('Kategori_model')->getAllKategori();

        $this->view('admin/templates/header', $data);
        $this->view('admin/menu/edit', $data);
        $this->view('admin/templates/footer', $data);
    }

    public function proses_edit_menu()
    {
        $id = $_POST['id'];
        $produkLama = $this->model('Produk_model')->getProdukById($id);
        $foto = $produkLama['foto'];

        // Upload Foto Baru jika ada
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $namaFile = $_FILES['foto']['name'];
            $tmpName = $_FILES['foto']['tmp_name'];
            $ekstensi = pathinfo($namaFile, PATHINFO_EXTENSION);
            $namaFileBaru = uniqid() . '.' . $ekstensi;

            if (move_uploaded_file($tmpName, 'assets/img/produk/' . $namaFileBaru)) {
                // Hapus foto lama
                if (!empty($produkLama['foto']) && file_exists('assets/img/produk/' . $produkLama['foto'])) {
                    unlink('assets/img/produk/' . $produkLama['foto']);
                }
                $foto = $namaFileBaru;
            }
        }

        $data = [
            'id' => $id,
            'kategori_id' => $_POST['kategori_id'],
            'nama' => $_POST['nama'],
            'deskripsi' => $_POST['deskripsi'],
            'harga' => $_POST['harga'],
            'harga_coret' => !empty($_POST['harga_coret']) ? $_POST['harga_coret'] : null,
            'foto' => $foto,
            'stok' => $_POST['stok'],
            'satuan' => $_POST['satuan'],
            'status' => isset($_POST['status']) ? 'aktif' : 'nonaktif',
            'label_badge' => $_POST['label_badge'],
            'catatan_tambahan' => $_POST['catatan_tambahan']
        ];

        if ($this->model('Produk_model')->ubahDataProduk($data) >= 0) {
            $this->model('Log_model')->addLog('Mengubah detail menu: ' . $data['nama']);
            header('Location: ' . BASEURL . '/admin/menu?msg=success');
            exit;
        } else {
            header('Location: ' . BASEURL . '/admin/menu?msg=error');
            exit;
        }
    }

    public function detail_pesanan($id)
    {
        $data['judul'] = 'Detail Pesanan';
        $data['pesanan'] = $this->model('Pesanan_model')->getPesananById($id);
        $data['items'] = $this->model('Pesanan_model')->getDetailPesanan($id);
        $data['pembayaran'] = $this->model('Pembayaran_model')->getPembayaranByPesananId($id);

        $this->view('admin/templates/header', $data);
        $this->view('admin/pesanan/detail', $data);
        $this->view('admin/templates/footer', $data);
    }

    // KATEGORI CRUD
    public function tambah_kategori()
    {
        $data['judul'] = 'Tambah Kategori';
        $this->view('admin/templates/header', $data);
        $this->view('admin/kategori/tambah', $data);
        $this->view('admin/templates/footer', $data);
    }

    public function proses_tambah_kategori()
    {
        if ($this->model('Kategori_model')->tambahDataKategori($_POST) > 0) {
            $this->model('Log_model')->addLog('Menambah kategori baru: ' . $_POST['nama']);
            header('Location: ' . BASEURL . '/admin/kategori?msg=success');
            exit;
        } else {
            header('Location: ' . BASEURL . '/admin/kategori?msg=error');
            exit;
        }
    }

    public function edit_kategori($id)
    {
        $data['judul'] = 'Edit Kategori';
        $data['kategori'] = $this->model('Kategori_model')->getKategoriById($id);

        $this->view('admin/templates/header', $data);
        $this->view('admin/kategori/edit', $data);
        $this->view('admin/templates/footer', $data);
    }

    public function proses_edit_kategori()
    {
        if ($this->model('Kategori_model')->ubahDataKategori($_POST) >= 0) {
            header('Location: ' . BASEURL . '/admin/kategori?msg=success');
            exit;
        } else {
            header('Location: ' . BASEURL . '/admin/kategori?msg=error');
            exit;
        }
    }

    public function hapus_kategori($id)
    {
        if ($this->model('Kategori_model')->hapusDataKategori($id) > 0) {
            $this->model('Log_model')->addLog('Menghapus kategori ID: ' . $id);
            header('Location: ' . BASEURL . '/admin/kategori?msg=success');
            exit;
        } else {
            header('Location: ' . BASEURL . '/admin/kategori?msg=error');
            exit;
        }
    }

    public function update_status_pesanan()
    {
        if ($this->model('Pesanan_model')->updateStatus($_POST['id'], $_POST['status']) > 0) {
            $this->model('Log_model')->addLog('Mengubah status pesanan ID ' . $_POST['id'] . ' menjadi ' . $_POST['status']);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        } else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }

    public function get_log_ajax($admin_id)
    {
        $logs = $this->model('Log_model')->getLogsByAdminId($admin_id);
        header('Content-Type: application/json');
        echo json_encode($logs);
        exit;
    }

    // MEJA MANAGEMENT
    public function meja()
    {
        $data['judul'] = 'Meja Barcode';
        $data['meja'] = $this->model('Meja_model')->getAllMeja();
        $data['pengaturan'] = $this->model('Pengaturan_model')->getAll();

        $this->view('admin/templates/header', $data);
        $this->view('admin/meja/index', $data);
        $this->view('admin/templates/footer', $data);
    }

    public function proses_tambah_meja()
    {
        if ($this->model('Meja_model')->tambahDataMeja($_POST) > 0) {
            $this->model('Log_model')->addLog('Menambah meja baru nomor: ' . $_POST['nomor_meja']);
            header('Location: ' . BASEURL . '/admin/meja?msg=success');
            exit;
        } else {
            header('Location: ' . BASEURL . '/admin/meja?msg=error');
            exit;
        }
    }

    public function hapus_meja($id)
    {
        if ($this->model('Meja_model')->hapusDataMeja($id) > 0) {
            $this->model('Log_model')->addLog('Menghapus meja ID: ' . $id);
            header('Location: ' . BASEURL . '/admin/meja?msg=success');
            exit;
        } else {
            header('Location: ' . BASEURL . '/admin/meja?msg=error');
            exit;
        }
    }

    public function barcode_umum()
    {
        $data['judul'] = 'Barcode Umum';
        $data['pengaturan'] = $this->model('Pengaturan_model')->getAll();

        $this->view('admin/templates/header', $data);
        $this->view('admin/barcode/umum', $data);
        $this->view('admin/templates/footer', $data);
    }

    public function pembayaran()
    {
        $data['judul'] = 'Daftar Pembayaran';
        $data['pembayaran'] = $this->model('Pembayaran_model')->getAllPembayaran();

        $this->view('admin/templates/header', $data);
        $this->view('admin/pembayaran/index', $data);
        $this->view('admin/templates/footer', $data);
    }

    public function verifikasi_pembayaran()
    {
        $id = $_POST['id'];
        $status = $_POST['status'];
        $admin_id = $_SESSION['user_id'];

        if ($this->model('Pembayaran_model')->verifikasiPembayaran($id, $status, $admin_id)) {
            $msg = ($status == 'diterima') ? 'Pembayaran berhasil dikonfirmasi.' : 'Pembayaran ditolak.';
            $this->model('Log_model')->addLog($msg . ' ID Pembayaran: ' . $id);
            header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? BASEURL . '/admin/pembayaran'));
        } else {
            header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? BASEURL . '/admin/pembayaran'));
        }
        exit;
    }
    public function save_barcode_settings_ajax()
    {
        $data = [
            'barcode_custom_name' => $_POST['barcode_custom_name'],
            'barcode_custom_address' => $_POST['barcode_custom_address']
        ];

        if ($this->model('Pengaturan_model')->updateMultiple($data)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
        exit;
    }
}
