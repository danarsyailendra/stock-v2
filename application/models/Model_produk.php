<?php

class Model_produk extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /* get active brand infromation */

    public function getActiveProduk() {
        $sql = "SELECT * FROM produk WHERE active = ?";
        $query = $this->db->query($sql, array(1));
        return $query->result_array();
    }

    /* get the brand data */

    public function getProdukData($id = null) {
        if ($id) {
            $sql = "SELECT * FROM produk WHERE id = ?";
            $query = $this->db->query($sql, array($id));
            return $query->row_array();
        }

        $sql = "SELECT * FROM produk";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function create($data) {
        if ($data) {
            $insert = $this->db->insert('produk', $data);
            return ($insert == true) ? true : false;
        }
    }

    public function update($data, $id) {
        if ($data && $id) {
            $this->db->where('id', $id);
            $update = $this->db->update('produk', $data);
            return ($update == true) ? true : false;
        }
    }

    public function remove($id) {
        if ($id) {
            $this->db->where('id', $id);
            $delete = $this->db->delete('produk');
            return ($delete == true) ? true : false;
        }
    }

    public function getProdukDataBulk($id = NULL) {
        if ($id) {
            $sql = "SELECT * FROM produk WHERE id IN  ?";
            $query = $this->db->query($sql, array($id));
            return $query->result_array();
        }
    }

}
