<?php

class Profile extends Controller {
    public function index() {
        header('Location: ' . BASEURL . '/profile/pesanan');
        exit;
    }

    public function pesanan() {
        $data['judul'] = 'Riwayat Pesanan';
        
        $keyword = '';
        if (isset($_POST['keyword'])) {
            $keyword = $_POST['keyword'];
            $_SESSION['last_search_keyword'] = $keyword;
        } elseif (isset($_SESSION['last_search_keyword'])) {
            $keyword = $_SESSION['last_search_keyword'];
        }

        if (!empty($keyword)) {
            $data['pesanan'] = $this->model('Pesanan_model')->searchPesanan($keyword);
            $data['keyword'] = $keyword;
        } else {
            $data['pesanan'] = [];
            $data['keyword'] = '';
        }

        $data['pengaturan'] = $this->model('Pengaturan_model')->getMappedSettings();

        $this->view('templates/header', $data);
        $this->view('templates/navbar', $data);
        $this->view('profile/pesanan', $data);
        $this->view('templates/footer', $data);
    }

    public function detail($id) {
        $data['judul'] = 'Detail Pesanan';
        $data['pesanan'] = $this->model('Pesanan_model')->getPesananById($id);
        $data['detail'] = $this->model('Pesanan_model')->getDetailPesanan($id);
        $data['pengaturan'] = $this->model('Pengaturan_model')->getMappedSettings();
        $data['pembayaran'] = $this->model('Pembayaran_model')->getPembayaranByPesananId($id);
        
        // Cek apakah pesanan ini milik user (berdasarkan keyword di session)
        if (!isset($_SESSION['last_search_keyword']) || 
           ($_SESSION['last_search_keyword'] !== $data['pesanan']['no_telp'] && 
            $_SESSION['last_search_keyword'] !== $data['pesanan']['kode_pesanan'])) {
            // Jika bukan miliknya, arahkan balik ke list
            header('Location: ' . BASEURL . '/profile/pesanan');
            exit;
        }

        $this->view('templates/header', $data);
        $this->view('templates/navbar', $data);
        $this->view('profile/detail', $data);
        $this->view('templates/footer', $data);
    }

    public function bayar() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $pesanan_id = $_POST['pesanan_id'];
            $total_harga = $_POST['total_harga'];

            // Handle Upload Foto
            $foto = $_FILES['bukti_foto']['name'];
            $tmp = $_FILES['bukti_foto']['tmp_name'];
            
            // Generate nama file unik
            $ext = pathinfo($foto, PATHINFO_EXTENSION);
            $nama_file_baru = 'PROOF-' . time() . '-' . rand(1000, 9999) . '.' . $ext;
            $path = "assets/img/bukti_pembayaran/" . $nama_file_baru;

            if(move_uploaded_file($tmp, $path)) {
                $dataPembayaran = [
                    'pesanan_id' => $pesanan_id,
                    'jumlah_bayar' => $total_harga,
                    'bukti_foto' => $nama_file_baru
                ];

                if($this->model('Pembayaran_model')->tambahPembayaran($dataPembayaran) > 0) {
                    Flasher::setFlash('Bukti pembayaran berhasil dikirim. Tunggu verifikasi admin.', 'success');
                } else {
                    Flasher::setFlash('Gagal mengirim bukti pembayaran.', 'danger');
                }
            } else {
                Flasher::setFlash('Gagal mengupload file.', 'danger');
            }

            header('Location: ' . BASEURL . '/profile/detail/' . $pesanan_id);
            exit;
        }
    }
}
