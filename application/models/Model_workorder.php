<?php

class Model_workorder extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /* get the brand data */

    public function getWorkorderData($id = null) {
        if ($id) {
            $sql = "SELECT * FROM marketing where id = ?";
            $query = $this->db->query($sql, array($id));
            return $query->row_array();
        }

        $sql = "SELECT a.*,status_desc FROM marketing a INNER JOIN status_approval b on a.status_approval = b.id ORDER BY bobot DESC";
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
            $insert = $this->db->insert('marketing', $data);
            return ($insert == true) ? true : false;
        }
    }

    public function update($data, $id) {
        if ($data && $id) {
            $this->db->where('id', $id);
            $update = $this->db->update('marketing', $data);
            return ($update == true) ? true : false;
        }
    }

    public function remove($id) {
        if ($id) {
            $this->db->where('id', $id);
            $delete = $this->db->delete('marketing');
            return ($delete == true) ? true : false;
        }
    }

    public function countTotalWorkorder() {
        $sql = "SELECT * FROM marketing";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function approve($id, $data) {
        if ($id and $data) {
            $this->db->where('id', $id);
            $update = $this->db->update('marketing', $data);
            return ($update == true) ? true : false;
        }
    }

    public function getApprovedWorkorderData() {
        $sql = "SELECT a.*,status_desc FROM marketing a INNER JOIN status_approval b on a.status_approval = b.id "
                . "WHERE a.status_approval = 1 ORDER BY a.id DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function done($id, $evidence) {
        if ($id) {
            $data = array(
                'done' => 1,
                'evidence' => $evidence
            );
            $this->db->where('id', $id);
            $update = $this->db->update('marketing', $data);
            return ($update == true) ? true : false;
        }
    }

    public function getWorkorderDataBulk($id = NULL) {
        if ($id) {
            $sql = "SELECT * FROM marketing WHERE id IN  ?";
            $query = $this->db->query($sql, array($id));
            return $query->result_array();
        }
    }

    public function dashboardWorkorder($year = NULL) {
        $sql = "select a.id, case when done = 1 then 'Done' else b.status_desc end status from marketing a left join status_approval b on a.status_approval = b.id group by a.id";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function dashboardMix($year = NULL) {
        $sql = "select 'Overtime' as status, count(id) jumlah from lembur where status = 1 UNION ALL select 'Workorder' as status, count(id) jumlah from marketing where status_approval = 1 or done = 1";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getNumberCWO() {
        $sql = "select report_cwo from report_count";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    
    public function updateNumberCWO($data) {
        if ($data){
            $this->db->where('id', 0);
            $update = $this->db->update('report_count', $data);
            return ($update == true) ? true : false;
        }
    }
    public function getNumberCMIX() {
        $sql = "select report_cmix from report_count";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    
    public function updateNumberCMIX($data) {
        if ($data){
            $this->db->where('id', 0);
            $update = $this->db->update('report_count', $data);
            return ($update == true) ? true : false;
        }
    }
    
    public function cekWo($wo_number) {
        if ($wo_number) {
            $sql = "SELECT count(*) jumlah FROM marketing WHERE nomor_wo =  ?";
            $query = $this->db->query($sql, array($wo_number));
            return $query->row_array();
        }
    }
}
