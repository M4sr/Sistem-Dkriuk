<?php

class Checkout extends Controller {
    public function index() {
        $data['judul'] = 'Checkout Pesanan';
        $data['pengaturan'] = $this->model('Pengaturan_model')->getAll();
        $data['meja'] = $this->model('Meja_model')->getAllMeja();
        $data['metode_pembayaran'] = $this->model('Pembayaran_model')->getActiveMetode();
        
        $this->view('templates/header', $data);
        $this->view('templates/navbar', $data);
        $this->view('checkout/index', $data);
        $this->view('templates/footer', $data);
    }

    public function proses() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cart = json_decode($_POST['cart_data'], true);
            
            if (empty($cart)) {
                header('Location: ' . BASEURL . '/menu');
                exit;
            }

            // Simpan pesanan ke database
            $pesanan_id = $this->model('Pesanan_model')->tambahPesanan($_POST, $cart);

            if ($pesanan_id) {
                // Bersihkan flash message jika ada (untuk mencegah pesan error basi muncul di halaman sukses)
                if(isset($_SESSION['flash'])) unset($_SESSION['flash']);
                
                // Redirect ke halaman sukses / pembayaran
                header('Location: ' . BASEURL . '/checkout/pembayaran/' . $pesanan_id);
                exit;
            } else {
                // Error handling (produk tidak valid / dihapus admin)
                Flasher::setFlash('Gagal checkout! Beberapa menu di keranjang Anda mungkin sudah tidak tersedia.', 'danger');
                header('Location: ' . BASEURL . '/menu?clear_cart=true');
                exit;
            }
        }
    }

    public function pembayaran($id) {
        $data['judul'] = 'Pembayaran';
        $data['pesanan'] = $this->model('Pesanan_model')->getPesananById($id);
        $data['detail'] = $this->model('Pesanan_model')->getDetailPesanan($id);
        $data['pengaturan'] = $this->model('Pengaturan_model')->getAll();
        
        $metode = $this->model('Pembayaran_model')->getMetodeByNama($data['pesanan']['metode_bayar']);
        // Fallback jika tidak ketemu berdasarkan nama (mungkin pesanan lama pakai tipe)
        if (!$metode) {
            $db = new Database; 
            $db->query("SELECT * FROM metode_pembayaran WHERE tipe = :tipe AND is_active = 1 LIMIT 1");
            $db->bind('tipe', $data['pesanan']['metode_bayar']);
            $metode = $db->single();
        }
        $data['metode_pilihan'] = $metode;

        $this->view('templates/header', $data);
        $this->view('templates/navbar', $data);
        $this->view('checkout/pembayaran', $data);
        $this->view('templates/footer', $data);
    }

    public function konfirmasi_pembayaran() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $pesanan_id = $_POST['pesanan_id'];
            $jumlah_bayar = $_POST['jumlah_bayar'];
            $bukti_foto = '';

            if (isset($_FILES['bukti_foto']) && $_FILES['bukti_foto']['error'] == 0) {
                $namaFile = $_FILES['bukti_foto']['name'];
                $tmpName = $_FILES['bukti_foto']['tmp_name'];
                $ekstensi = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
                $namaFileBaru = 'bukti_' . uniqid() . '.' . $ekstensi;
                
                // Pastikan folder ada
                if (!file_exists('assets/img/bukti_pembayaran')) {
                    mkdir('assets/img/bukti_pembayaran', 0777, true);
                }

                if (move_uploaded_file($tmpName, 'assets/img/bukti_pembayaran/' . $namaFileBaru)) {
                    $bukti_foto = $namaFileBaru;
                }
            }

            if (!empty($bukti_foto)) {
                $data = [
                    'pesanan_id' => $pesanan_id,
                    'jumlah_bayar' => $jumlah_bayar,
                    'bukti_foto' => $bukti_foto
                ];

                if ($this->model('Pembayaran_model')->tambahPembayaran($data) > 0) {
                    header('Location: ' . BASEURL . '/checkout/pembayaran/' . $pesanan_id . '?status=success');
                    exit;
                }
            }
            
            header('Location: ' . BASEURL . '/checkout/pembayaran/' . $pesanan_id . '?status=error');
            exit;
        }
    }
}
