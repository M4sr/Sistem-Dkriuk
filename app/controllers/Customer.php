<?php

class Customer extends Controller
{
    public function index()
    {
        // Redirect ke Home jika akses langsung tanpa scan
        header('Location: ' . BASEURL . '/home');
        exit;
    }

    public function scan($token = null)
    {
        if ($token === null) {
            header('Location: ' . BASEURL . '/home');
            exit;
        }

        $meja = $this->model('Meja_model')->getMejaByToken($token);

        if ($meja) {
            // Simpan info meja ke session (Tanpa Login)
            $_SESSION['customer_meja_id'] = $meja['id'];
            $_SESSION['customer_nomor_meja'] = $meja['nomor_meja'];

            // Redirect ke halaman daftar menu
            header('Location: ' . BASEURL . '/customer/menu');
            exit;
        } else {
            // Meja tidak ditemukan atau token salah
            echo "<script>
                alert('QR Code tidak valid atau sudah kadaluarsa. Silakan scan ulang QR yang ada di meja.');
                window.location.href = '" . BASEURL . "/home';
            </script>";
            exit;
        }
    }

    public function menu()
    {
        if (!isset($_SESSION['customer_meja_id'])) {
            // Jika masuk ke menu tanpa scan QR
            header('Location: ' . BASEURL . '/home');
            exit;
        }

        $data['judul'] = 'Menu Kami';
        $data['nomor_meja'] = $_SESSION['customer_nomor_meja'];
        $data['kategori'] = $this->model('Kategori_model')->getAllKategori();
        $data['produk'] = $this->model('Produk_model')->getAllProduk();

        $this->view('customer/menu', $data);
    }
}
