<?php

class Model_welcome extends CI_Model
{
    public function getAllPohon()
    {
        $query = $this->db->get("pohon_tbl");
        return $query->result();
    }
}
