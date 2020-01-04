<?php

class Model_lembur extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /* get the brand data */

    public function getLemburData($id = null) {
        if ($id) {
            $sql = "SELECT * FROM lembur where id = ?";
            $query = $this->db->query($sql, array($id));
            return $query->row_array();
        }

        $sql = "SELECT a.*,status_desc FROM lembur a INNER JOIN status_approval b on a.status = b.id ORDER BY a.id DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    // public function getActiveProductData()
    // {
    // 	$sql = "SELECT * FROM marketing WHERE availability = ? ORDER BY id DESC";
    // 	$query = $this->db->query($sql, array(1));
    // 	return $query->result_array();
    // }

    public function create($data) {
        if ($data) {
            $insert = $this->db->insert('lembur', $data);
            return ($insert == true) ? true : false;
        }
    }

    public function update($data, $id) {
        if ($data && $id) {
            $this->db->where('id', $id);
            $update = $this->db->update('lembur', $data);
            return ($update == true) ? true : false;
        }
    }

    public function remove($id) {
        if ($id) {
            $this->db->where('id', $id);
            $delete = $this->db->delete('lembur');
            return ($delete == true) ? true : false;
        }
    }

    public function countTotalLembur() {
        $sql = "SELECT * FROM lembur";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function getWorkorderData($id = NULL) {
        if ($id) {
            $sql = "SELECT id, wo_name FROM marketing where id = ?";
            $query = $this->db->query($sql, array($id));
            return $query->row_array();
        }
        $sql = "SELECT id, wo_name FROM marketing ORDER BY id DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function approve($id, $data) {
        if ($id and $data) {
            $this->db->where('id', $id);
            $update = $this->db->update('lembur', $data);
            return ($update == true) ? true : false;
        }
    }
    
    public function dashboardLembur($year = NULL) {
        $sql = "select a.id,b.status_desc from lembur a inner join status_approval b on a.status = b.id";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getNumberCOT() {
        $sql = "select report_cot from report_count";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    
    public function updateNumberCOT($data) {
        if ($data){
            $this->db->where('id', 0);
            $update = $this->db->update('report_count', $data);
            return ($update == true) ? true : false;
        }
    }
}
