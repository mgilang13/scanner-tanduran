<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Manajemenpohon extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Mpohon');
        $this->load->model('Muser');
        if (!$this->session->userdata("petugas")) {
            $this->session->set_flashdata('pesan', 'Anda harus login');
            redirect('', 'refresh');
        }
    }

    public function index()
    {
        $data['title'] = 'Manajemen Pohon';
        $data['pohon'] = $this->Mpohon->tampil_pohon();
        $this->load->view('header', $data);
        $this->load->view('petugas/navbar', $data);
        $this->load->view('petugas/manajemenpohon/datapohon', $data);
        $this->load->view('footer');
    }

    public function tambah()
    {
        //gunakan lib form_validation untuk me required
        //$this->form_validation->set_rules('id_pohon', 'ID Pohon', 'required');
        $this->form_validation->set_rules('no_pohon', 'No Pohon', 'required');
        $this->form_validation->set_rules('jenis_pohon', 'Jenis Pohon', 'required');
        $this->form_validation->set_rules('tinggi_pohon', 'Tinggi Pohon', 'required');
        $this->form_validation->set_rules('diameter', 'diameter', 'required');
        //dapatkan inputan dari formulir

        $inputan = $this->input->post();
        //jk ada inputan dari formulir
        // jk validation benar 
        if ($this->form_validation->run() == TRUE) {
            //Mbarang jalankan fungsi simpan_barang($inputan)
            $this->Mpohon->simpan_pohon($inputan);
            //tampilkan purchasing/managemenbarang/index
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah!');
            redirect('petugas/manajemenpohon', 'refresh');
        }
        // selain itu gagal  
        else {
            $data['gagal'] = validation_errors();
        }
        $data['no_pohon'] = $this->Mpohon->no_pohon();
        /*$data['kategori'] = $this->Mkategori->tampil_kategori();
        $data['supplier'] = $this->Msupplier->tampil_supplier();*/

        $data['title'] = 'Tambah Pohon';
        $this->load->view('header', $data);
        $this->load->view('petugas/navbar', $data);
        $this->load->view('petugas/manajemenpohon/tambahpohon', $data);
        $this->load->view('footer');
    }

    public function tambahBanyak()
    {
        $this->form_validation->set_rules('jumlah_pohon', 'Jumlah Pohon', 'required');

        $inputan = $this->input->post();

        if ($this->form_validation->run() == TRUE) {
            for ($i = 1; $i <= $inputan['jumlah_pohon']; $i++) {
                $no_pohon = $this->Mpohon->no_pohon();
                $data = array(
                    'no_pohon' => $no_pohon
                );

                $this->Mpohon->simpan_banyak_pohon($data);
            }
            redirect('petugas/manajemenpohon', 'refresh');
        }

        $data['title'] = 'Tambah Banyak Pohon';
        $this->load->view('header', $data);
        $this->load->view('petugas/navbar', $data);
        $this->load->view('petugas/manajemenpohon/tambahBanyakPohon', $data);
        $this->load->view('footer');
    }

    public function downloadBanyakQR()
    {

        $data['pohon'] = $this->Mpohon->tampil_pohon();

        $this->form_validation->set_rules('first_list', 'FL', 'required');
        $this->form_validation->set_rules('last_list', 'LL', 'required');

        $inputan = $this->input->post();


        if ($this->form_validation->run() == TRUE) {
            $data['ranged_data'] = $this->Mpohon->download_banyak_qr($inputan);
            $data['jumlah_data'] = count($data['ranged_data']);
        }

        $data['title'] = 'Download Banyak QR';
        $this->load->view('header', $data);
        $this->load->view('petugas/navbar', $data);
        $this->load->view('petugas/manajemenpohon/downloadBanyakQR', $data);
        $this->load->view('footer');
    }

    public function detail($id_pohon)
    {
        $data['pohon'] = $this->Mpohon->detail_pohon($id_pohon);
        $data['title'] = 'Detail Pohon';
        $this->load->view('header', $data);
        $this->load->view('petugas/navbar', $data);
        $this->load->view('petugas/manajemenpohon/detailpohon', $data);
        $this->load->view('footer');
    }


    public function ubah($id_pohon)
    {
        $inputan = $this->input->post();
        // jk submit maka lakukan

        if ($inputan) {
            //mengambil detail dari Model Mbarang
            $detail = $this->Mpohon->detail_pohon($id_pohon);

            //jika ada inputan ada maka jalankan validasi 
            if ($inputan['no_pohon'] == $detail['no_pohon']) {
                $this->form_validation->set_rules('no_pohon', 'No Pohon', 'required');
            } else {
                $this->form_validation->set_rules('no_pohon', 'No Pohon', 'required|is_unique[pohon.no_pohon]');
            }
            //jika ada inputan ada maka jalankan validasi 
            $this->form_validation->set_rules('no_pohon', 'No Pohon', 'required');
            $this->form_validation->set_rules('jenis_pohon', 'Jenis Pohon', 'required');
            $this->form_validation->set_rules('tinggi_pohon', 'Tinggi Pohon', 'required');
            $this->form_validation->set_rules('diameter', 'Diameter', 'required');

            // jalankan validasi jika benar
            if ($this->form_validation->run() == TRUE) {
                //jalankan method ubah user data dari formulir berdasarkan id pada url 
                $this->Mpohon->ubah_pohon($inputan, $id_pohon);
                $this->session->set_flashdata('pesan', 'Data berhasil diubah!');
                redirect('petugas/manajemenpohon', 'refresh');
            }
            // jika salah maka 
            $data['gagal'] = validation_errors();
        }

        $data["datapohon"] = $this->Mpohon->detail_pohon($id_pohon);
        $data['title'] = 'Ubah Data Pohon';

        $this->load->view('header', $data);
        $this->load->view('petugas/navbar', $data);
        $this->load->view('petugas/manajemenpohon/editpohon', $data);
        $this->load->view('footer');
    }

    public function hapus()
    {
        $idnya = $this->input->post("id_pohon");
        $this->Mpohon->hapus_pohon($idnya);
    }
}
