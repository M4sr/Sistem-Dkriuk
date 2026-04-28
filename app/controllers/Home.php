<?php

class Home extends Controller {
    public function index() {
        $data['judul'] = 'Selamat Datang';
        $data['pengaturan'] = $this->model('Pengaturan_model')->getAll();
        $data['banners'] = $this->model('Banner_model')->getActiveBanners();
        $data['kategori'] = $this->model('Kategori_model')->getAllKategori();
        $data['best_seller'] = $this->model('Pesanan_model')->getBestSellingMenu(4);
        
        $this->view('templates/header', $data);
        $this->view('templates/navbar', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer', $data);
    }
}
