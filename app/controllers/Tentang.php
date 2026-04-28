<?php

class Tentang extends Controller {
    public function index() {
        $data['judul'] = 'Tentang Kami';
        $data['pengaturan'] = $this->model('Pengaturan_model')->getAll();
        
        $this->view('templates/header', $data);
        $this->view('templates/navbar', $data);
        $this->view('tentang/index', $data);
        $this->view('templates/footer', $data);
    }
}
