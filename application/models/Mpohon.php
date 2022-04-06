 <?php

    defined('BASEPATH') or exit('No direct script access allowed');

    class Mpohon extends CI_Model
    {

        function tampil_pohon()
        {
            //$this->db->join('supplier', 'supplier.id_supplier = barang.id_supplier', 'left');
            //$this->db->join('kategori', 'kategori.id_kategori = barang.id_kategori', 'left');
            $ambil = $this->db->get('pohon');
            return $ambil->result_array();
        }

        function no_pohon()
        {
            $this->db->select('RIGHT(pohon.no_pohon,3) as no_pohon', FALSE);
            $this->db->order_by('no_pohon', 'DESC');
            $this->db->limit(1);

            $query = $this->db->get('pohon');
            if ($query->num_rows() <> 0) {
                $data = $query->row();
                $kode = intval($data->no_pohon) + 1;
            } else {
                $kode = 1;
            }

            $batas = str_pad($kode, 6, "0", STR_PAD_LEFT);
            $kodetampil = "DRADI-" . $batas;
            return $kodetampil;
        }

        function simpan_pohon($inputan)
        {
            $no_pohon = $inputan['no_pohon'];
            $jenis_pohon = $inputan['jenis_pohon'];
            $tinggi_pohon = $inputan['tinggi_pohon'];
            $diameter = $inputan['diameter'];
            //$catatan = $inputan['catatan'];

            $this->db->where('no_pohon', $no_pohon);
            $this->db->where('jenis_pohon', $jenis_pohon);
            $this->db->where('tinggi_pohon', $tinggi_pohon);
            $this->db->where('diameter', $diameter);
            //$this->db->where('catatan', $catatan);

            $pohon = $this->db->get('pohon')->row_array();
            if (empty($pohon)) {
                $this->db->insert('pohon', $inputan);
                return 'sukses';
            } else {
                return 'gagal';
            }
        }


        function simpan_banyak_pohon($data)
        {
            $no_pohon = $data['no_pohon'];

            $this->db->where('no_pohon', $no_pohon);

            $pohon = $this->db->get('pohon')->row_array();
            if (empty($pohon)) {
                $this->db->insert("pohon", $data);
                return "sukses";
            } else {
                return "gagal";
            }
        }

        function detail_pohon($id_pohon)
        {
            //$this->db->join('kategori', 'kategori.id_kategori = barang.id_kategori', 'left');
            //$this->db->join('supplier', 'supplier.id_supplier = barang.id_supplier', 'left');
            $this->db->where('id_pohon', $id_pohon);
            $ambil = $this->db->get('pohon');
            return $ambil->row_array();
        }

        function download_banyak_qr($inputan)
        {
            $first_list = $inputan['first_list'];
            $last_list = $inputan['last_list'];

            $this->db->where('no_pohon >=', $first_list);
            $this->db->where('no_pohon <=', $last_list);

            $ranged_data = $this->db->get('pohon')->result_array();
            return $ranged_data;
        }

        function ubah_pohon($inputan, $id_pohon)
        {
            $this->db->where('jenis_pohon', $inputan['jenis_pohon']);
            $this->db->where('tinggi_pohon', $inputan['tinggi_pohon']);
            $this->db->where('diameter', $inputan['diameter']);
            $this->db->where('catatan', $inputan['catatan']);

            $pohon = $this->db->get('pohon')->row_array();
            if (empty($pohon)) {
                $this->db->where('id_pohon', $id_pohon);
                $this->db->update('pohon', $inputan);
                return 'sukses';
            } else {
                return 'gagal';
            }
        }

        function hapus_pohon($id_pohon)
        {
            $this->db->where('id_pohon', $id_pohon);
            $this->db->delete('pohon');
        }
        function hitung_pohon()
        {
            $this->db->select('id_pohon');
            $this->db->from('pohon');
            $query = $this->db->get();
            $total = $query->num_rows();
            return $total;
        }
    }
