<?php

class Menu extends Controller {
    public function index($kategori_id = null) {
        $data['judul'] = 'Menu Kami';
        $data['pengaturan'] = $this->model('Pengaturan_model')->getAll();
        $data['kategori'] = $this->model('Kategori_model')->getAllKategori();
        
        // Jika kategori_id null, ambil kategori pertama
        if ($kategori_id == null && !empty($data['kategori'])) {
            $kategori_id = (int)$data['kategori'][0]['id'];
        } else {
            $kategori_id = (int)$kategori_id;
        }
        
        $data['active_kategori'] = $kategori_id;
        
        // Ambil info kategori aktif
        $data['kategori_info'] = null;
        foreach($data['kategori'] as $k) {
            if ($k['id'] == $kategori_id) {
                $data['kategori_info'] = $k;
                break;
            }
        }

        // Ambil produk berdasarkan kategori
        $data['produk'] = $this->model('Produk_model')->getProdukByKategori($kategori_id);
        
        // die(print_r($data['produk']));
        
        $this->view('templates/header', $data);
        $this->view('templates/navbar', $data);
        $this->view('menu/index', $data);
        $this->view('templates/footer', $data);
    }
}
