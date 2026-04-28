<?php

class Pesanan_model
{
    private $table = 'pesanan';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllPesanan()
    {
        $this->db->query("SELECT p.*, m.nomor_meja 
                          FROM " . $this->table . " p 
                          LEFT JOIN meja m ON p.meja_id = m.id 
                          ORDER BY p.created_at DESC");
        return $this->db->resultSet();
    }

    public function getPesananById($id)
    {
        $this->db->query("SELECT p.*, m.nomor_meja 
                          FROM " . $this->table . " p 
                          LEFT JOIN meja m ON p.meja_id = m.id 
                          WHERE p.id = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function searchPesanan($keyword)
    {
        $this->db->query("SELECT p.*, m.nomor_meja, 
                          (SELECT pr.foto FROM detail_pesanan dp JOIN produk pr ON dp.produk_id = pr.id WHERE dp.pesanan_id = p.id LIMIT 1) as foto_produk,
                          (SELECT COUNT(*) FROM detail_pesanan WHERE pesanan_id = p.id) as total_item
                          FROM " . $this->table . " p 
                          LEFT JOIN meja m ON p.meja_id = m.id 
                          WHERE p.no_telp = :keyword OR p.kode_pesanan = :keyword
                          ORDER BY p.created_at DESC");
        $this->db->bind('keyword', $keyword);
        return $this->db->resultSet();
    }

    public function getDetailPesanan($pesanan_id)
    {
        $this->db->query("SELECT dp.*, pr.nama, pr.foto 
                          FROM detail_pesanan dp 
                          JOIN produk pr ON dp.produk_id = pr.id 
                          WHERE dp.pesanan_id = :pesanan_id");
        $this->db->bind('pesanan_id', $pesanan_id);
        return $this->db->resultSet();
    }

    public function updateStatus($id, $status)
    {
        $query = "UPDATE " . $this->table . " SET status_pesanan = :status";

        if ($status == 'diproses') {
            $query .= ", waktu_diproses = CURRENT_TIMESTAMP";
        } elseif ($status == 'selesai') {
            $query .= ", waktu_selesai = CURRENT_TIMESTAMP, status_bayar = 'lunas'";
        }

        $query .= " WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('status', $status);
        $this->db->bind('id', $id);
        $this->db->execute();

        // 6. Jika status selesai atau dibatalkan, bebaskan meja (jika ada)
        if ($status == 'selesai' || $status == 'dibatalkan') {
            $pesanan = $this->getPesananById($id);
            if ($pesanan && !empty($pesanan['meja_id'])) {
                $this->db->query("UPDATE meja SET status = 'tersedia' WHERE id = :meja_id");
                $this->db->bind('meja_id', $pesanan['meja_id']);
                $this->db->execute();
            }
        }

        return $this->db->rowCount();
    }

    public function updateStatusBayar($id, $status)
    {
        $this->db->query("UPDATE " . $this->table . " SET status_bayar = :status WHERE id = :id");
        $this->db->bind('status', $status);
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getFilterPesanan($filters, $limit = null, $offset = null)
    {
        $query = "SELECT p.*, m.nomor_meja 
                  FROM " . $this->table . " p 
                  LEFT JOIN meja m ON p.meja_id = m.id 
                  WHERE 1=1";

        if (!empty($filters['search'])) {
            $query .= " AND (p.kode_pesanan LIKE :search OR p.nama_pelanggan LIKE :search)";
        }
        if (!empty($filters['status'])) {
            $query .= " AND p.status_pesanan = :status";
        }
        if (!empty($filters['tipe'])) {
            $query .= " AND p.tipe_pesanan = :tipe";
        }
        if (!empty($filters['bayar'])) {
            $query .= " AND p.metode_bayar = :bayar";
        }
        if (!empty($filters['range_date'])) {
            $dates = explode(' to ', $filters['range_date']);
            if (count($dates) == 2) {
                $query .= " AND DATE(p.created_at) BETWEEN :start AND :end";
            }
        }

        // Sorting
        $allowedSort = ['created_at', 'nama_pelanggan', 'total_harga', 'kode_pesanan', 'status_pesanan'];
        $sort = isset($filters['sort']) && in_array($filters['sort'], $allowedSort) ? $filters['sort'] : 'created_at';
        $order = isset($filters['order']) && in_array(strtolower($filters['order']), ['asc', 'desc']) ? $filters['order'] : 'desc';

        $query .= " ORDER BY p.{$sort} {$order}";

        if ($limit !== null && $offset !== null) {
            $query .= " LIMIT :limit OFFSET :offset";
        }

        $this->db->query($query);

        if (!empty($filters['search'])) {
            $this->db->bind('search', "%{$filters['search']}%");
        }
        if (!empty($filters['status'])) {
            $this->db->bind('status', $filters['status']);
        }
        if (!empty($filters['tipe'])) {
            $this->db->bind('tipe', $filters['tipe']);
        }
        if (!empty($filters['bayar'])) {
            $this->db->bind('bayar', $filters['bayar']);
        }
        if (!empty($filters['range_date'])) {
            $dates = explode(' to ', $filters['range_date']);
            if (count($dates) == 2) {
                $this->db->bind('start', $dates[0]);
                $this->db->bind('end', $dates[1]);
            }
        }

        if ($limit !== null && $offset !== null) {
            $this->db->bind('limit', (int) $limit);
            $this->db->bind('offset', (int) $offset);
        }

        return $this->db->resultSet();
    }

    public function getCountFilterPesanan($filters)
    {
        $query = "SELECT COUNT(*) as total FROM " . $this->table . " p WHERE 1=1";

        if (!empty($filters['search'])) {
            $query .= " AND (p.kode_pesanan LIKE :search OR p.nama_pelanggan LIKE :search)";
        }
        if (!empty($filters['status'])) {
            $query .= " AND p.status_pesanan = :status";
        }
        if (!empty($filters['tipe'])) {
            $query .= " AND p.tipe_pesanan = :tipe";
        }
        if (!empty($filters['bayar'])) {
            $query .= " AND p.metode_bayar = :bayar";
        }
        if (!empty($filters['range_date'])) {
            $dates = explode(' to ', $filters['range_date']);
            if (count($dates) == 2) {
                $query .= " AND DATE(p.created_at) BETWEEN :start AND :end";
            }
        }

        $this->db->query($query);

        if (!empty($filters['search'])) {
            $this->db->bind('search', "%{$filters['search']}%");
        }
        if (!empty($filters['status'])) {
            $this->db->bind('status', $filters['status']);
        }
        if (!empty($filters['tipe'])) {
            $this->db->bind('tipe', $filters['tipe']);
        }
        if (!empty($filters['bayar'])) {
            $this->db->bind('bayar', $filters['bayar']);
        }
        if (!empty($filters['range_date'])) {
            $dates = explode(' to ', $filters['range_date']);
            if (count($dates) == 2) {
                $this->db->bind('start', $dates[0]);
                $this->db->bind('end', $dates[1]);
            }
        }

        return $this->db->single()['total'];
    }

    public function getTotalCount()
    {
        $this->db->query("SELECT COUNT(*) as total FROM " . $this->table);
        return $this->db->single()['total'];
    }

    public function getTotalRevenue()
    {
        $this->db->query("SELECT SUM(total_harga) as total FROM " . $this->table . " WHERE status_bayar = 'lunas'");
        return $this->db->single()['total'] ?? 0;
    }

    public function getMenuSold()
    {
        $this->db->query("SELECT SUM(qty) as total FROM detail_pesanan dp JOIN pesanan p ON dp.pesanan_id = p.id WHERE p.status_bayar = 'lunas'");
        return $this->db->single()['total'] ?? 0;
    }

    public function getCountByStatus($status)
    {
        $this->db->query("SELECT COUNT(*) as total FROM " . $this->table . " WHERE status_pesanan = :status");
        $this->db->bind('status', $status);
        return $this->db->single()['total'];
    }

    public function getRecentOrders($limit)
    {
        $this->db->query("SELECT p.*, m.nomor_meja 
                          FROM " . $this->table . " p 
                          LEFT JOIN meja m ON p.meja_id = m.id 
                          ORDER BY p.created_at DESC LIMIT :limit");
        $this->db->bind('limit', $limit);
        return $this->db->resultSet();
    }

    public function getRevenueLast7Days()
    {
        $this->db->query("SELECT DATE(created_at) as tanggal, SUM(total_harga) as total 
                          FROM " . $this->table . " 
                          WHERE status_bayar = 'lunas' 
                          AND created_at >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
                          GROUP BY DATE(created_at)
                          ORDER BY tanggal ASC");
        return $this->db->resultSet();
    }

    public function getBestSellingMenu($limit)
    {
        $this->db->query("SELECT pr.id, pr.nama AS nama, pr.foto, pr.harga, pr.deskripsi, SUM(dp.qty) as total_terjual, SUM(dp.subtotal) as total_pendapatan 
                          FROM detail_pesanan dp 
                          JOIN produk pr ON dp.produk_id = pr.id 
                          JOIN pesanan p ON dp.pesanan_id = p.id
                          WHERE p.status_bayar = 'lunas'
                          GROUP BY pr.id, pr.nama, pr.foto, pr.harga, pr.deskripsi 
                          ORDER BY total_terjual DESC LIMIT :limit");
        $this->db->bind('limit', $limit);
        $result = $this->db->resultSet();

        // Fallback: Jika belum ada pesanan yang lunas, tampilkan produk aktif secara random/terbaru
        if (empty($result)) {
            $this->db->query("SELECT id, nama, foto, harga, deskripsi, 0 as total_terjual, 0 as total_pendapatan FROM produk WHERE status = 'aktif' ORDER BY id DESC LIMIT :limit");
            $this->db->bind('limit', $limit);
            return $this->db->resultSet();
        }

        return $result;
    }

    public function getOrderStatusStats()
    {
        $this->db->query("SELECT status_pesanan, COUNT(*) as jumlah 
                          FROM " . $this->table . " 
                          GROUP BY status_pesanan");
        return $this->db->resultSet();
    }

    public function getRevenueByCategory()
    {
        $this->db->query("SELECT k.nama as kategori, SUM(dp.subtotal) as total 
                          FROM detail_pesanan dp 
                          JOIN produk pr ON dp.produk_id = pr.id 
                          JOIN kategori k ON pr.kategori_id = k.id
                          JOIN pesanan p ON dp.pesanan_id = p.id
                          WHERE p.status_bayar = 'lunas'
                          GROUP BY k.id");
        return $this->db->resultSet();
    }

    public function getPembayaranByPesananId($pesanan_id)
    {
        $this->db->query("SELECT * FROM pembayaran WHERE pesanan_id = :pesanan_id ORDER BY created_at DESC");
        $this->db->bind('pesanan_id', $pesanan_id);
        return $this->db->single();
    }

    public function getReportData($filters)
    {
        // Query untuk list pesanan
        $list = $this->getFilterPesanan($filters);

        // Query untuk stats
        $queryStats = "SELECT SUM(total_harga) as revenue, COUNT(*) as orders 
                       FROM " . $this->table . " 
                       WHERE status_pesanan != 'dibatalkan'";

        if (!empty($filters['status'])) {
            $queryStats .= " AND status_pesanan = :status";
        }
        if (!empty($filters['bayar'])) {
            $queryStats .= " AND metode_bayar = :bayar";
        }
        if (!empty($filters['range_date'])) {
            $dates = explode(' to ', $filters['range_date']);
            if (count($dates) == 2) {
                $queryStats .= " AND DATE(created_at) BETWEEN :start AND :end";
            }
        }

        $this->db->query($queryStats);
        if (!empty($filters['status']))
            $this->db->bind('status', $filters['status']);
        if (!empty($filters['bayar']))
            $this->db->bind('bayar', $filters['bayar']);
        if (!empty($filters['range_date'])) {
            $dates = explode(' to ', $filters['range_date']);
            if (count($dates) == 2) {
                $this->db->bind('start', $dates[0]);
                $this->db->bind('end', $dates[1]);
            }
        }

        $stats = $this->db->single();

        return [
            'list' => $list,
            'total_revenue' => $stats['revenue'] ?? 0,
            'total_orders' => $stats['orders'] ?? 0
        ];
    }

    public function tambahPesanan($data, $cart)
    {
        // 0. Ambil Pengaturan untuk Ongkir
        $db_pengaturan = new Database;
        $db_pengaturan->query("SELECT nilai_value FROM pengaturan WHERE nama_key = 'ongkir_per_km' LIMIT 1");
        $pengaturan_ongkir = $db_pengaturan->single();
        $ongkir_setting = $pengaturan_ongkir ? (float)$pengaturan_ongkir['nilai_value'] : 0;

        // 0. Validasi Produk di Keranjang
        $valid_cart = [];
        foreach ($cart as $item) {
            $this->db->query("SELECT id FROM produk WHERE id = :id");
            $this->db->bind('id', $item['id']);
            $produk = $this->db->single();
            if ($produk) {
                $valid_cart[] = $item;
            }
        }

        if (empty($valid_cart)) {
            return false;
        }
        
        $cart = $valid_cart;

        // 1. Generate Kode Pesanan
        $kode = 'DKR-' . strtoupper(substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5));

        // 2. Hitung Total & Ongkir
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['harga'] * $item['qty'];
        }

        $ongkir = ($data['tipe_pesanan'] == 'delivery') ? $ongkir_setting : 0;
        $total = $subtotal + $ongkir;

        // 3. Simpan Pesanan Utama
        $query = "INSERT INTO " . $this->table . " (meja_id, nama_pelanggan, no_telp, alamat_pengantaran, lat, lng, tipe_pesanan, kode_pesanan, total_harga, ongkir, metode_bayar, catatan, status_pesanan, status_bayar) 
                  VALUES (:meja_id, :nama_pelanggan, :no_telp, :alamat_pengantaran, :lat, :lng, :tipe_pesanan, :kode_pesanan, :total_harga, :ongkir, :metode_bayar, :catatan, 'pending', 'belum')";

        $this->db->query($query);

        $meja_id = ($data['tipe_pesanan'] == 'dine-in' && !empty($data['meja_id'])) ? $data['meja_id'] : null;

        $this->db->bind('meja_id', $meja_id);
        $this->db->bind('nama_pelanggan', $data['nama_pelanggan'] ?? '');
        $this->db->bind('no_telp', $data['no_telp'] ?? '');
        $this->db->bind('alamat_pengantaran', $data['alamat_pengantaran'] ?? '');

        $lat = !empty($data['lat']) ? $data['lat'] : null;
        $lng = !empty($data['lng']) ? $data['lng'] : null;

        $this->db->bind('lat', $lat);
        $this->db->bind('lng', $lng);
        $this->db->bind('tipe_pesanan', $data['tipe_pesanan'] ?? 'dine-in');
        $this->db->bind('kode_pesanan', $kode);
        $this->db->bind('total_harga', $total);
        $this->db->bind('ongkir', $ongkir);
        $this->db->bind('metode_bayar', $data['metode_bayar']);
        $this->db->bind('catatan', $data['catatan'] ?? '');

        $this->db->execute();
        $pesanan_id = $this->db->lastInsertId();

        // 4. Simpan Detail Pesanan
        if ($pesanan_id) {
            foreach ($cart as $item) {
                $queryDetail = "INSERT INTO detail_pesanan (pesanan_id, produk_id, qty, harga_satuan, subtotal) 
                                VALUES (:pesanan_id, :produk_id, :qty, :harga_satuan, :subtotal)";
                $this->db->query($queryDetail);
                $this->db->bind('pesanan_id', $pesanan_id);
                $this->db->bind('produk_id', $item['id']);
                $this->db->bind('qty', $item['qty']);
                $this->db->bind('harga_satuan', $item['harga']);
                $this->db->bind('subtotal', $item['harga'] * $item['qty']);
                $this->db->execute();
            }

            if ($data['tipe_pesanan'] == 'dine-in' && !empty($data['meja_id'])) {
                $this->db->query("UPDATE meja SET status = 'terpakai' WHERE id = :meja_id");
                $this->db->bind('meja_id', $data['meja_id']);
                $this->db->execute();
            }

            $this->db->query("INSERT INTO pembayaran (pesanan_id, jumlah_bayar, bukti_foto, status) 
                             VALUES (:pesanan_id, :jumlah_bayar, '', 'pending')");
            $this->db->bind('pesanan_id', $pesanan_id);
            $this->db->bind('jumlah_bayar', $total);
            $this->db->execute();
        }

        return $pesanan_id;
    }
}
