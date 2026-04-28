<?php

class Kontak extends Controller {
    public function index() {
        $data['judul'] = 'Kontak Kami';
        $data['pengaturan'] = $this->model('Pengaturan_model')->getAll();
        
        $this->view('templates/header', $data);
        $this->view('templates/navbar', $data);
        $this->view('kontak/index', $data);
        $this->view('templates/footer', $data);
    }
}
